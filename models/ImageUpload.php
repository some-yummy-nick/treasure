<?php
/**
 * Created by PhpStorm.
 * User: Marat
 * Date: 31.08.2019
 * Time: 9:26
 */

namespace app\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png'],
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        if ($this->validate()) {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();

        }

        return false;

    }

    private function getFolder()
    {
        return YiI::getAlias('@web') . 'images/uploads/';
    }

    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExists($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }

    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    private function fileExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage !== null) {
            return file_exists(($this->getFolder() . $currentImage));
        }

        return false;

    }

    public function saveImage()
    {
        $filename = $this->generateFileName();
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}
