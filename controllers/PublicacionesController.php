<?php

namespace app\controllers;

use Yii;
use app\models\Publicacion;
use app\models\Categoria;
use app\models\TipoAnimal;
use app\models\PublicacionSearch;
use app\models\UploadForm;
use app\models\Upload;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use dektrium\user\filters\AccessRule;



/**
 * PublicacionesController implementa un CRUD de acciones para el Modelo Publicacioens
 */

class PublicacionesController extends Controller
{
    /**
    * Comportamientos de las publicaciones (permisos y accesos)
    *
    */

    public $categorias = [];


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                 ],
                'rules' => [
                    [
                        'actions' => ['index','create','update','comprobar'],
                        'roles'=>['@'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin;
                        }
                    ],
                    [
                        'actions' => ['create','update','delete'],
                        'roles'=>['@'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view','comprobar','mapa','normas'],
                        'roles'=>['?','@'],
                        'allow' => true,
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lista las publicaciones
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mustra la información completa de la publicación.
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
     * Muestra la información completa de la publicación.
     * @param integer $id, string $lat, $long string, $km integer, $ajax boolean
     * @return mixed
     */

    public function actionComprobar($lat, $long, $km = 1, $ajax = false)
    {
        $publicaciones = Publicacion::find()->all();
        $cercanos = [];

        foreach ($publicaciones as $publicacion) {
            $distancia = $this->getDistancia( $lat, $long, $publicacion->latitud, $publicacion->longitud );

            if( $distancia < $km) {
                $cercanos[] = $publicacion;
            }

        }

        $provider = new ArrayDataProvider([
            'allModels' => $cercanos,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['fecha_publicacion' => SORT_DESC],
            ],
        ]);

        if ($ajax) {
            return $this->renderPartial('comprobarPacial', [
                'provider' => $provider,
            ]);
        }

        return $this->render('comprobar', [
            'provider' => $provider,
        ]);
    }

    /**
     * Crea una nueva publicación.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publicacion();

        if ($model->load(Yii::$app->request->post())) {

            $imagen = UploadedFile::getInstance($model, 'imageFile');
            $model->usuario_id = Yii::$app->user->id;
            if ($imagen !== null) {
                $model->imageFile = $imagen;
                if ($model->save() && $model->upload()) {

                    return $this->redirect(['site/index']);
                }
            }
        } else {
            $tipos = TipoAnimal::find()->select('nombre_tipo_animal, id')->indexBy('id')->column();
            $categorias = Categoria::find()->select('nombre_categoria, id')->indexBy('id')->column();


            return $this->render('create', [
                'model' => $model,
                'tipos' => $tipos,
                'categorias' => $categorias,
            ]);
        }
    }


    /**
     * Modifica una publicación.
     *
     * @param integer $id.
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $tipos = TipoAnimal::find()->select('nombre_tipo_animal, id')->indexBy('id')->column();
            $categorias = Categoria::find()->select('nombre_categoria, id')->indexBy('id')->column();

            return $this->render('update', [
                'model' => $model,
                'tipos' => $tipos,
                'categorias' => $categorias,

            ]);
        }
    }

    /**
     * Crea un nuevo mapa.
     *
     * @param integer $id, string $long, string $lat.
     * @return mixed
     */

    public function actionMapa($id, $long, $lat)
    {
        if ($long != null && $lat != null ) {
            $model = Publicacion::findOne($id);
            $model->longitud = $long;
            $model->latitud = $lat;
            $model->update(false);


            $this->render('view', ['model' => $model]);
        }
    }
    /**
     * Borra una publicación existente.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Muestra las normas
     *
     * @return mixed
     */

    public function actionNormas()
    {
        return $this->render('normas');
    }

    /**
     * Encuentra una publicación basada en el modelo
     * @param integer $id
     * @return Publicación basada en el modelo
     * @throws NotFoundHttpException si el modelo no puede ser encontrado
     */
    protected function findModel($id)
    {
        if (($model = Publicacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Calcula la distancia entre un usuario y las publicaciones
     * Encuentra una publicación basada en el modelo
     * @param string $latitud1,string $longitud1,string $latitud2,string $longitud2
     * @return integer $d
     *
     */

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
