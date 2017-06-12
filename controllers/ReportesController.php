<?php

namespace app\controllers;

use Yii;
use app\models\Reporte;
use app\models\ReporteSearch;
use yii\web\Controller;
use yii\web\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Publicacion;
use yii\filters\AccessControl;

/**
 * ReportesController implemente un CRUD de acciones para el modelo Reporte.
 */
class ReportesController extends Controller
{
    /**
     * Comportamientos de los Reportes (accesos y permisos)
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

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles'=>['@'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista el modelo Reporte.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReporteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra la información de un Reporte.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo Reporte.
     *
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Reporte();
        $model->reportador_id = Yii::$app->user->id;
        $model->reportado_id = Publicacion::findOne($id)->usuario->id;
        $model->publicacion_id = $id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un Reporte
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Borra un Reporte
     *
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Encuentra un reporte basado en el modelo
     *
     *
     * @param integer $id
     * @return El Reporte cargado
     * @throws NotFoundHttpException si el modelo no puede ser encontrado
     */
    protected function findModel($id)
    {
        if (($model = Reporte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
