<?php
namespace app\controllers\user;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use dektrium\user\controllers\AdminController as BaseAdminController;
/**
 * AdminController implementa el CRUD de acciones para Admin.
 */
class AdminController extends BaseAdminController
{
    /**
     * Comportamiento de acciones para AdminController (acciones y permisos)
     */
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

}  ?>
