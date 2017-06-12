<?php
namespace app\controllers\user;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Publicacion;
use Yii;
use dektrium\user\controllers\ProfileController as BaseProfileController;


/**
 * ProfileController implementa un CRUD de acciones para el modelo Profile.
 */
class ProfileController extends BaseProfileController
{

    /**
     *  Muestra el perfil de un usuario
     *
     * @param integer $id
     * @return mixed
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);
        $publicaciones = Publicacion::find()->select('id, titulo')->where(['usuario_id' => $profile->user->id])->asArray()->all();

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'publicaciones' => $publicaciones,
        ]);
    }
}
