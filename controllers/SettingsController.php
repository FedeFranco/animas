<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace app\controllers;
/*use dektrium\user\Finder;
use dektrium\user\models\Profile;
use dektrium\user\models\SettingsForm;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;*/
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\SettingsForm;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
/**
 * SettingsController manages updating user settings (e.g. profile, email and password).
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */

class SettingsController extends BaseSettingsController
{

    /*use AjaxValidationTrait;
    use EventTrait;

    const EVENT_BEFORE_PROFILE_UPDATE = 'beforeProfileUpdate';

    const EVENT_AFTER_PROFILE_UPDATE = 'afterProfileUpdate';

    const EVENT_BEFORE_ACCOUNT_UPDATE = 'beforeAccountUpdate';

    const EVENT_AFTER_ACCOUNT_UPDATE = 'afterAccountUpdate';

    const EVENT_BEFORE_CONFIRM = 'beforeConfirm';

    const EVENT_AFTER_CONFIRM = 'afterConfirm';

    const EVENT_BEFORE_DISCONNECT = 'beforeDisconnect';

    const EVENT_AFTER_DISCONNECT = 'afterDisconnect';

    const EVENT_BEFORE_DELETE = 'beforeDelete';

    const EVENT_AFTER_DELETE = 'afterDelete';

    public $defaultAction = 'profile';
    protected $finder;

    public function __construct($id, $module,Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'disconnect' => ['post'],
                    'delete'     => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['profile', 'account', 'networks', 'disconnect', 'delete'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['confirm'],
                        'roles'   => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionProfile()
    {
        $model = $this->finder->findProfileById(\Yii::$app->user->identity->getId());
        if ($model == null) {
            $model = \Yii::createObject(Profile::className());
            $model->link('user', \Yii::$app->user->identity);
        }
        $event = $this->getProfileEvent($model);
        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Your profile has been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }*/

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

    /*public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);
        if ($user === null || $this->module->emailChangeStrategy == Module::STRATEGY_INSECURE) {
            throw new NotFoundHttpException();
        }
        $event = $this->getUserEvent($user);
        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);
        $user->attemptEmailChange($code);
        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);
        return $this->redirect(['account']);
    }

    public function actionNetworks()
    {
        return $this->render('networks', [
            'user' => \Yii::$app->user->identity,
        ]);
    }

    public function actionDisconnect($id)
    {
        $account = $this->finder->findAccount()->byId($id)->one();
        if ($account === null) {
            throw new NotFoundHttpException();
        }
        if ($account->user_id != \Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }
        $event = $this->getConnectEvent($account, $account->user);
        $this->trigger(self::EVENT_BEFORE_DISCONNECT, $event);
        $account->delete();
        $this->trigger(self::EVENT_AFTER_DISCONNECT, $event);
        return $this->redirect(['networks']);
    }*/

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
