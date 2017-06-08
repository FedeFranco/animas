<?php
namespace app\controllers\user;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Publicacion;
use Yii;
use dektrium\user\controllers\ProfileController as BaseProfileController;

class ProfileController extends BaseProfileController
{

    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);
        $publicaciones = Publicacion::find()->select('id, titulo')->where(['usuario_id' => $profile->user->id])->asArray()->all();
        $titulos = [];
        //var_dump($profile->user->id); die();
        /*foreach ($publicaciones as $value) {
            $titulos[] = $value['titulo'];
        }*/
        //var_dump($publicaciones[1]); die();
        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'publicaciones' => $publicaciones,
        ]);
    }
}
