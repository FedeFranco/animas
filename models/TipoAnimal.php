<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_animales".
 *
 * @property int $id
 * @property string $nombre_tipo_animal
 *
 * @property Publicaciones[] $publicaciones
 */
class TipoAnimal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_animales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_tipo_animal'], 'required'],
            [['nombre_tipo_animal'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_tipo_animal' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionTipo()
    {
        return $this->hasMany(Publicacion::className(), ['tipo_animal_id' => 'id'])->inverseOf('tipo');
    }
}
