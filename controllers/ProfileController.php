<?php
namespace app\controllers;
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use dektrium\user\controllers\ProfileController as BaseProfileController;
use Yii;
/*use dektrium\user\Finder;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;*/
/**
 * ProfileController shows users profiles.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ProfileController extends BaseProfileController
{
    /** @var Finder */
    //protected $finder;

    /*public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['index'], 'roles' => ['@']],
                    ['allow' => true, 'actions' => ['show'], 'roles' => ['?', '@']],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['show', 'id' => \Yii::$app->user->getId()]);
    }*/

    public function actionShow($id)
    {
        $id_user = Yii::$app->user->id;
        $id_url = Yii::$app->getRequest()->getQueryParam('id');

        /*if ($id_user !== $id_url) {
            $this->redirect('index');
        }*/

        $profile = $this->finder->findProfileById($id);
        if ($profile === null) {
            throw new NotFoundHttpException();
        }
        return $this->render('show', [
            'profile' => $profile,
            'id_user' => $id_user,
            'id_url' => $id_url,
        ]);
    }
}
