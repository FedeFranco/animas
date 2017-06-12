<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Publicacion;
use app\models\PublicacionSearch;
use sanex\simplefilter\SimpleFilter;

class SiteController extends Controller
{
    /**
     * Muestra el comportamiento de acciones para Index (permisos y accesos)
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Acciones
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Muestra la página principal.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Publicacion();


        $searchModel = new PublicacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'defaultPageSize' => 12,
            'pageSizeLimit' => [12, 100],
        ];
        $dataProvider->sort = ['defaultOrder' => ['fecha_publicacion' => SORT_DESC]];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * Filtra publicaciones.
     *
     * @return mixed
     */

    public function actionFiltro()
    {
        $model = new Publicacion();

        $ajaxViewFile = '@app/views/site/filtro-ajax';
        $query = new \yii\db\ActiveQuery($model);
        $query->select('titulo, categoria_id, tipo_animal_id');/*->where(['country' => 'Canada'])->orderBy(['price' => SORT_ASC]);*/
        $filter = SimpleFilter::getInstance();
        $filter->setParams([
            'model' => $model,
            'query' => $query,
            'useAjax' => true,
            'useCache' => true,
            'useDataProvider' => true,
        ]);

        return $this->render('filtro', [
            'filter' => $filter,
            'ajaxViewFile' => $ajaxViewFile
        ]);
    }

    /**
     * Logueo.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Muestra la página de contacto.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Muestra las publicaciones filtradas por una búsqueda.
     * @param string $q
     * @return mixed
     */
    public function actionPublicaciones($q = null)
    {
       if ($q !== null && $q !== '') {
           $publicaciones = Publicacion::find()->select('*')->where(['ilike', 'titulo', $q])->all();
           $json = [];
           foreach ($publicaciones as $publicacion) {
               $json[] = [
                   'id' => $publicacion->id,
                   'titulo' => $publicacion->titulo,
                   'cuerpo' => $publicacion->cuerpo

               ];
           }
           return json_encode($json);
       }
   }

   /**
    * Muestra el resultado de la búsqueda filtrada
    * @param string $q
    * @return mixed
    */
   public function actionSearch($q = null)
   {
       if ($q !== null && $q !== '') {
           $publicacionesProvider = new ActiveDataProvider([
            'query' => Publicacion::find()->where(['ilike', 'titulo', $q]),
           ]);

           $publicacionProvider = new ActiveDataProvider([
                'query' => Publicacion::find()->where(['ilike', 'cuerpo', $q]),
            ]);

           return $this->render('search', [
               'q' => $q,
               'publicacionesProvider' => $publicacionesProvider,
               'publicacionProvider' => $publicacionProvider

           ]);
       }
       return $this->refresh();
   }

  /**
   * Comprueba la posición mediante POST
   *
   * @return mixed
   */
    public function actionComprobar($pos = null)
    {
        return Json::encode(Yii::$app->request->post('pos'));
    }

    /**
     * Muestra la página "Sobre Animas".
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
