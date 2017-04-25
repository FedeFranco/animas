<?php

namespace app\models;

use Yii;
use app\models\Publicacion;

/**
 * This is the model class for table "categorias".
 *
 * @property integer $id
 * @property string $nombre_categoria
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_categoria'], 'required'],
            [['nombre_categoria'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_categoria' => 'Nombre Categoria',
        ];
    }

    public function getPublicacion()
    {
        return $this->hasMany(Publicacion::className(), ['categoria_id' => 'id'])->inverseOf('categoria');
    }
}
