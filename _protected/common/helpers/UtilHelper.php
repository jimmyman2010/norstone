<?php

namespace common\helpers;

use backend\models\FileForm;
use common\models\File;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\Html;
use yii\imagine\Image;

/**
 * Class UtilHelper
 * @package common\helpers
 */
class UtilHelper{

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
        $fileName = SlugHelper::makeSlugs($fileName);

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
        $imagine = Image::thumbnail($fileSource, $width, $height, ManipulatorInterface::THUMBNAIL_INSET);

        $info = getimagesize($fileSource);
        if($info['mime'] === 'image/jpeg') {
            $exif = exif_read_data($fileSource);
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
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
        if(is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
        return true;
    }

    /**
     * @param File $data
     * @param string $identifier
     * @param bool $linkOnly
     * @return string
     */
    public static function getPicture($data, $identifier = '', $linkOnly = false)
    {
        if($data == null) {
            $href = Yii::$app->view->theme->baseUrl . '/images/no-images/no-image-' . $identifier . '.jpg';
            $alt = '';
        }
        else {
            if (is_int($data)) {
                $data = File::findOne(['id' => $data]);
            }
            if(empty($identifier)) {
                $href = $data->show_url . $data->file_name . '.' . $data->file_ext;
            }
            else {
                $filePath = Yii::getAlias('@uploads') . $data->directory . $data->file_name . '-' . $identifier . '.' . $data->file_ext;
                if (is_file($filePath)) {
                    $href = $data->show_url . $data->file_name . '-' . $identifier . '.' . $data->file_ext;
                } else {
                    $originPath = Yii::getAlias('@uploads') . $data->directory . $data->file_name . '.' . $data->file_ext;
                    if (is_file($originPath)) {
                        $imageSize = Yii::$app->params['image_sizes'][$identifier];
                        self::generateImage($originPath, $filePath, $imageSize[0], $imageSize[1]);
                        $href = $data->show_url . $data->file_name . '-' . $identifier . '.' . $data->file_ext;
                    } else {
                        $href = Yii::$app->view->theme->baseUrl . '/images/no-images/no-image-' . $identifier . '.jpg';
                    }
                }
            }
            $alt = $data->name;
        }
        if($linkOnly) {
            return $href;
        }
        return Html::img($href, ['alt' => $alt]);
    }

    public static function formatNumber($price)
    {
        return number_format($price, 0, ',', '.');
    }
}