<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;


   public static function isUserAdmin($username)
   {
      if (static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN])){

             return true;
      } else {

             return false;
      }
   }

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
