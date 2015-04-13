<?php

namespace common\helpers;

use backend\models\FileForm;
use Imagine\Image\Box;
use Yii;
use yii\imagine\Image;

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
            $fileUrl = '/uploads/' . $mediaType . 's/' . $fileName . '/';
            $fileDir = DIRECTORY_SEPARATOR . $mediaType . 's' . DIRECTORY_SEPARATOR . $fileName . DIRECTORY_SEPARATOR;
        } else {
            $i = 0;
            do {
                $i++;
                if($i > 1)
                    $fileName = $saveName . '-' . $i;
                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName . '.' . $fileExt;
            } while(file_exists($filePath));

            $fileUrl = '/uploads/' . $mediaType . 's/';
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
     * @param int $width
     * @param int $height
     * @return Box|bool
     */
    public static function generateImage($fileSource, $fileTarget, $width = 0, $height = 0)
    {
        $tmp = getimagesize($fileSource);
        $size = new Box($tmp[0], $tmp[1]);
        if($width === 0 && $height === 0) {
            if ($size->getWidth() > Yii::$app->params['image_maximum_size'] || $size->getHeight() > Yii::$app->params['image_maximum_size']) {
                if($size->getWidth() > $size->getHeight()) {
                    $width = Yii::$app->params['image_maximum_size'];
                    $height = floor($size->getHeight()*(Yii::$app->params['image_maximum_size']/$size->getWidth()));
                } else {
                    $width = floor($size->getWidth()*(Yii::$app->params['image_maximum_size']/$size->getHeight()));
                    $height = Yii::$app->params['image_maximum_size'];
                }
            } else {
                $width = $size->getWidth();
                $height = $size->getHeight();
            }
        }
        ini_set('memory_limit', '999999999M');
        $imagine = Image::thumbnail($fileSource, $width, $height);

        $exif = exif_read_data($fileSource);
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 8:
                    $imagine->rotate(-90);
                    break;
                case 3:
                    $imagine->rotate(180);
                    break;
                case 6:
                    $imagine->rotate(90);
                    break;
            }
        }

        if ($imagine->save($fileTarget)) {
            return new Box($width, $height);
        }
        return false;
    }

    /**
     * @param string $dir
     * @return bool
     */
    public static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}