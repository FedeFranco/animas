<?php
namespace app\controllers\user;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use dektrium\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>['class'=>AccessControl::className(),
            'only'=>['index'],
            'rules'=>[
                 [
                     'allow'=>true,
                     'actions'=>['index'],
                     'roles'=>['@'],
                     'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->username === 'admin';
                        }
                 ]
            ],
        ],
        ];
    }


    public function actionDelete($id)
    {
        //var_dump($id); die();
    }
}  ?>
