<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;

    public function rules()
    {
        return [
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameRequired' => ['username', 'required', 'on' => ['register', 'create', 'connect', 'update']],
            'usernameMatch'    => ['username', 'match', 'pattern' => static::$usernameRegexp],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernameUnique'   => [
                'username',
                'unique',
                'message' => \Yii::t('user', 'This username has already been taken')
            ],

            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            'emailPattern'  => ['email', 'email'],
            'emailLength'   => ['email', 'string', 'max' => 255],
            'emailUnique'   => [
                'email',
                'unique',
                'message' => \Yii::t('user', 'This email address has already been taken')
            ],

            // password rules
            'passwordRequired' => ['password', 'required', 'on' => ['register']],
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 72, 'on' => ['register', 'create']],

            //roles rules
            ['role', 'default', 'value' => 10],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
   }

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
