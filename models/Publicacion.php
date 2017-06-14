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
     public $confirm_pub = false;
     public $imageFile;

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
            [['cuerpo', 'titulo','confirm_pub', 'latitud', 'longitud','telf_contacto'], 'required'],
            [['confirm_pub'], 'boolean'],
            [['cuerpo','categor_nom', 'latitud', 'longitud'], 'string'],
            [['categor_nom','url','imageFile','fecha_publicacion'], 'safe'],
            [['categoria_id', 'usuario_id',], 'integer'],
            [['url'],'url'],
            [['fecha_publicacion'],'date'],
            [['telf_contacto'], 'integer'],
            [['titulo'], 'string', 'max' => 50],
            ['imageFile', 'image', 'skipOnEmpty' => false, 'extensions' => ['png','jpg'],
                'minWidth' => 400, 'maxWidth' => 2000,
                'minHeight' => 200, 'maxHeight' => 20000,],
            [['tipo_animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAnimal::className(), 'targetAttribute' => ['tipo_animal_id' => 'id']],
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
            'cuerpo' => 'Descripción',
            'titulo' => 'Titulo',
            'categor_nom' => 'Categoría',
            'url' => 'Enlace',
            'imageFile' => 'Subir imagen',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'confirm_pub' => 'He leído las normas de publicación',
            'tipo_animal_id' => 'Tipo',
            'categoria_id' => 'Categoría',
            'usuario_id' => 'Usuario ID',
            'fecha_publicacion' => 'Fecha',
            'telf_contacto' => 'Contacto',
        ];
    }

    public function upload()
    {
        $model = new UploadForm;
        if (Yii::$app->request->isPost) {
            $model->imageFile = $this->imageFile;
            $model->titulo = $this->titulo;
            if ($model->upload($this->id)) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function getImagen()
    {
        $uploads = Yii::getAlias('@uploads');
        $ficheroJpg = "{$this->id}.jpg";
        $ficheroPng = "{$this->id}.png";
        $ruta1 = "$uploads/{$ficheroJpg}";
        $ruta2 = "$uploads/{$ficheroPng}";
        if (file_exists($ruta1)) {
            return "/$ruta1";
        } elseif (file_exists($ruta2)) {
            return "/$ruta2";
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id'])->inverseOf('publicacionCategoria');
    }

    public function getTipo()
    {
        return $this->hasOne(TipoAnimal::className(), ['id' => 'tipo_animal_id'])->inverseOf('publicacionTipo');
    }

    public function getReporte()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id'])->inverseOf('publicacionReporte');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id'])->inverseOf('publicaciones');
    }
}
