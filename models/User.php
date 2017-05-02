<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function getPublicaciones()
   {
       return $this->hasMany(Publicacion::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
   }

   public function getReporteReportador()
   {
      return $this->hasOne(Reporte::className(), ['reportador_id' => 'id'])->inverseOf('reportador');
   }

   public function getReporteReportado()
   {
      return $this->hasOne(Reporte::className(), ['reportado_id' => 'id'])->inverseOf('reportado'); 
   }

}
