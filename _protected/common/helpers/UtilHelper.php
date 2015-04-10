<?php

namespace common\helpers;

use backend\models\FileForm;
use Imagine\Gd\Image;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use Yii;

/**
 * Class UtilHelper
 * @package common\helpers
 */
class UtilHelper{

    /**
     * @param $text
     * @return mixed|string
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return '';
        }

        return $text;
    }

    /**
     * @param array $fileUpload
     * @param string $mediaType
     * @param int $chunk
     * @param int $chunks
     * @param bool $subFolder
     * @return FileForm|bool
     */
    public static function upload($fileUpload, $mediaType, $chunk, $chunks, $subFolder = true)
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Settings
        $targetDir =  Yii::getAlias('@uploads') . DIRECTORY_SEPARATOR . $mediaType . 's';

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Get a file name
        $fileName = $fileUpload["name"];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileName = UtilHelper::slugify($fileName);

        $saveDir = $targetDir;
        $saveName = $fileName;

        $i = 0;
        if($subFolder) {
            do {
                $i++;
                if($i > 1)
                    $fileName = $saveName . '-' . $i;
                $targetDir = $saveDir . DIRECTORY_SEPARATOR . $fileName;
            } while(file_exists($targetDir));
            // create folder
            @mkdir($targetDir);

            $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName . '.' . $fileExt;
            $fileUrl = '/uploads/' . $mediaType . 's/' . $fileName . '/' . $fileName . '.' . $fileExt;
            $fileDir = DIRECTORY_SEPARATOR . $mediaType . 's' . DIRECTORY_SEPARATOR . $fileName . DIRECTORY_SEPARATOR;
        } else {
            $i = 0;
            do {
                $i++;
                if($i > 1)
                    $fileName = $saveName . '-' . $i;
                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName . '.' . $fileExt;
            } while(file_exists($filePath));

            $fileUrl = '/uploads/' . $mediaType . 's/' . $fileName . '.' . $fileExt;
            $fileDir = DIRECTORY_SEPARATOR . $mediaType . 's' . DIRECTORY_SEPARATOR;
        }

        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : 0}');
        }

        if ($fileUpload["error"] || !is_uploaded_file($fileUpload["tmp_name"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : 0}');
        }

        // Read binary input stream and append it to temp file
        if (!$in = @fopen($fileUpload["tmp_name"], "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : 0}');
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);

            $result = new FileForm();
            $result->filePath = $filePath;
            $result->fileName = $fileName;
            $result->fileExt = $fileExt;
            $result->fileUrl = $fileUrl;
            $result->fileDir = $fileDir;
            return $result;
        }

        return false;
    }

    /**
     * @param string $fileSource
     * @param string $fileTarget
     * @param Box|null $newSize
     * @return Box|bool
     */
    public static function generateImage($fileSource, $fileTarget, $newSize = null)
    {
        $imagine = new Imagine();
        $image = $imagine->open($fileSource);
        $size = $image->getSize();
        if($newSize === null) {
            if ($size->getWidth() > Yii::$app->params['image_maximum_size'] || $size->getHeight() > Yii::$app->params['image_maximum_size']) {
                if($size->getWidth() > $size->getHeight()) {
                    $width = Yii::$app->params['image_maximum_size'];
                    $height = $size->getHeight()*(Yii::$app->params['image_maximum_size']/$size->getWidth());
                } else {
                    $width = $size->getWidth()*(Yii::$app->params['image_maximum_size']/$size->getHeight());
                    $height = Yii::$app->params['image_maximum_size'];
                }
                $newSize = new Box($width, $height);
            } else {
                $newSize = $size;
            }
        }
        $image = self::cropImage($image, $size, $newSize);
        $fileExt = pathinfo($fileSource, PATHINFO_EXTENSION);
        if ($fileExt === 'png' && $size !== $newSize) {
            $image->save($fileTarget, array('png_compression_level' => 9));
            return $size;
        }
        if($fileExt === 'jpg') {
            $image->save($fileTarget, array('jpeg_quality' => 85));
            return $size;
        }
        if($fileExt === 'gif' || $fileExt === 'bmp') {
            $image->save($fileTarget);
            return $size;
        }
        return false;
    }

    /**
     * @param Image $image
     * @param Box $size
     * @param Box $newSize
     * @return Image|\Imagine\Image\ManipulatorInterface
     */
    protected function cropImage($image, $size, $newSize){
        //we scale on the smaller dimension
        if ($size->getWidth() > $size->getHeight()) {
            $width  = $size->getWidth()*($newSize->getHeight()/$size->getHeight());
            $height =  $newSize->getHeight();
            //we center the crop in relation to the width
            $cropPoint = new Point((max($width - $newSize->getWidth(), 0))/2, 0);
        } else {
            $width  = $newSize->getWidth();
            $height =  $size->getHeight()*($newSize->getWidth()/$size->getWidth());
            //we center the crop in relation to the height
            $cropPoint = new Point(0, (max($height - $newSize->getHeight(),0))/2);
        }

        //we scale the image to make the smaller dimension fit our resize box
        $image = $image->thumbnail(new Box($width, $height));

        //and crop exactly to the box
        $image->crop($cropPoint, $newSize);
        return $image;
    }
}