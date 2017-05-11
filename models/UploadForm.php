<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Boolean;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\imagine\Image;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
        ];
    }

    /**
     * Se realiza la subida de la imagen haciendose una miniatura de 225x225
     * @return boolean true en caso de subida compledada y false en caso contrario
     */
    public function upload()
    {
        if ($this->validate()) {
        // $this->imageFile->saveAs('uploads/' . \Yii::$app->user->id . '.' . $this->imageFile->extension);
            $nombre = Yii::getAlias('@uploads/')
                . \Yii::$app->user->id . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($nombre);
            Image::thumbnail($nombre, 225, 225)
                ->save($nombre, ['quality' => 80]);
            return true;
        } else {
            return false;
        }
    }
}
