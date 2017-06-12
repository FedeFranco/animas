<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace app\controllers\user;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\SettingsForm;
use dektrium\user\controllers\SettingsController as BaseSettingsController;

/**
 * SettingsController implementa un CRUD de acciones para el modelo Setting.
 */
class SettingsController extends BaseSettingsController
{


    /**
     *  Muestra la cuenta de un usuario
     *
     *
     * @return mixed
     */
    public function actionAccount()
    {
        $this->module->enableAccountDelete = true;
        //var_dump($this->module->enableAccountDelete); die();
        $model = \Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($model);
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_ACCOUNT_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', \Yii::t('user', 'Your account details have been updated'));
            $this->trigger(self::EVENT_AFTER_ACCOUNT_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('account', [
            'model' => $model,
        ]);
    }
    /**
     *  Borra la cuenta de un usuario
     *
     *
     * @return mixed
     */

    public function actionDelete()
    {
        $this->module->enableAccountDelete = true;

        if (!$this->module->enableAccountDelete) {
            throw new NotFoundHttpException(\Yii::t('user', 'Not found'));
        }

        $user  = \Yii::$app->user->identity;
        $event = $this->getUserEvent($user);
        \Yii::$app->user->logout();
        $this->trigger(self::EVENT_BEFORE_DELETE, $event);
        $user->delete();
        $this->trigger(self::EVENT_AFTER_DELETE, $event);
        \Yii::$app->session->setFlash('info', \Yii::t('user', 'Your account has been completely deleted'));
        return $this->goHome();
    }
}
