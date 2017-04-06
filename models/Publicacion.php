<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicaciones".
 *
 * @property integer $id
 * @property string $cuerpo
 * @property string $titulo
 * @property integer $categoria_id
 * @property integer $usuario_id
 *
 * @property Categorias $categoria
 * @property User $usuario
 */
class Publicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

     public $categor_nom;

    public static function tableName()
    {
        return 'publicaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuerpo', 'titulo'], 'required'],
            [['cuerpo','categor_nom'], 'string'],
            [['categor_nom'], 'safe'],
            [['categoria_id', 'usuario_id'], 'integer'],
            [['titulo'], 'string', 'max' => 50],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuerpo' => 'Cuerpo',
            'titulo' => 'Titulo',
            'categor_nom' => 'Categoría',
            'categoria_id' => 'Categoria ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id'])->inverseOf('publicacion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id'])->inverseOf('publicaciones');
    }
}
