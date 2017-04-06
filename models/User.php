<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function getPublicaciones()
   {
       return $this->hasMany(Publicacion::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
   }

}
