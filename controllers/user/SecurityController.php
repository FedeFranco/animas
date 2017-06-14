<?php
namespace app\controllers\user;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Publicacion;
use Yii;
use \DateTime;
use dektrium\user\models\LoginForm;
use dektrium\user\controllers\SecurityController as BaseSecurityController;

/**
 * SecurityController implementa un CRUD de acciones para el modelo Security.
 */
class SecurityController extends BaseSecurityController
{

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);
        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            $fechas_pub = Publicacion::find()->select('fecha_publicacion')->where(['categoria_id' => '4'])->asArray()->all();
            $numAlerta = 0;
            foreach ($fechas_pub as $value) {

                $datetime1 = new DateTime($value['fecha_publicacion']);
                $datetime2 = new DateTime('now');
                $interval = $datetime1->diff($datetime2);
                if (intval($interval->format('%R%a')) >= -3) {
                    $numAlerta++;
                }
            }
            if ($numAlerta >= 1) {
                Yii::$app->session->setFlash('alerta', "Hay ".$numAlerta." mascotas perdidas!");
                //break;
                return $this->goBack();
            }

            return $this->goBack();
        }
        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }


    private function getDistancia( $latitud1, $longitud1, $latitud2, $longitud2 ) {
        $earth_radius = 6371;

        $dLat = deg2rad( $latitud2 - $latitud1 );
        $dLon = deg2rad( $longitud2 - $longitud1 );

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitud1)) * cos(deg2rad($latitud2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }

}
