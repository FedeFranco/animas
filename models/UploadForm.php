<?php
namespace app\models;
use Imagine\Image\Box;
use Imagine\Image\Point;
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
    /**
     * @var
     */
    public $titulo;
    public function rules()
    {
        return [
            [['titulo', 'imageFile'],'required'],
            [['titulo'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    /**
     * Se realiza la subida de la imagen haciendose una miniatura de 225x225
     * @return boolean true en caso de subida compledada y false en caso contrario
     */
    public function upload($id)
    {
        if ($this->validate()) {
            $extension = $this->imageFile->extension;
            $ruta = Yii::getAlias('@uploads/') . $id . '.' . $extension;
            if ($extension === 'gif') {
                return true;
            }
            $this->imageFile->saveAs(Yii::getAlias('@uploads/') . $id . '.' . $extension);
            $imagen = Image::getImagine()
                ->open(Yii::getAlias('@uploads/') . $id . '.' . $extension);
            $imagen->thumbnail(new Box(500, $imagen->getSize()->getHeight()))
                    ->save(Yii::getAlias('@uploads/') . $id . '.' . $extension, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }
}
