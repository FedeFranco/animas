<?php

namespace app\models;
use app\models\Publicacion;
use Yii;

/**
 * This is the model class for table "reportes".
 *
 * @property integer $id
 * @property integer $reportador_id
 * @property integer $reportado_id
 * @property integer $publicacion_id
 * @property string $cuerpo
 *
 * @property Publicaciones $publicacion
 * @property User $reportador
 * @property User $reportado
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportador_id', 'reportado_id', 'publicacion_id'], 'integer'],
            [['cuerpo'], 'required'],
            [['cuerpo'], 'string'],
            [['publicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::className(), 'targetAttribute' => ['publicacion_id' => 'id']],
            [['reportador_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reportador_id' => 'id']],
            [['reportado_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reportado_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reportador_id' => 'Reportador',
            'reportado_id' => 'Reportado',
            'publicacion_id' => 'Publicacion',
            'cuerpo' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionReporte()
    {
        return $this->hasOne(Publicacion::className(), ['id' => 'publicacion_id'])->inverseOf('reporte');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportador()
    {
        return $this->hasOne(User::className(), ['id' => 'reportador_id'])->inverseOf('reporteReportador');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportado()
    {
        return $this->hasOne(User::className(), ['id' => 'reportado_id'])->inverseOf('reporteReportado');
    }
}
