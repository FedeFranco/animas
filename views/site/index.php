<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAssetJS;
use sanex\simplefilter\SimpleFilter;

AppAssetJS::register($this);

//$url = Url::to(['site/comprobar']);

$urlPublicaciones = Url::to(['/publicaciones/view']) . '?q=%QUERY';

$url = Url::to(['/publicaciones/comprobar']);

$js = <<<JS

$('.comprobar').click(function(){
  var crd;

  var options = {
         enableHighAccuracy: true,
         timeout: 5000,
         maximumAge: 0
  };

  function success(pos) {
    crd = pos.coords;
    window.location.href = '$url&lat=' + crd.latitude + '&long=' + crd.longitude;
  };

  function error(err) {
      console.warn('ERROR(' + err.code + '): ' + err.message);
  };

  navigator.geolocation.getCurrentPosition(success, error, options);

});
JS;
$this->registerJs($js);

$this->title = 'Animas';
$this->registerCss("
  html, body {
      height: 100%;
      /*background: red;
      background: -webkit-linear-gradient(#C6E272,#86CC86, #3D8C84);
      background: -o-linear-gradient(#C6E272,#86CC86, #3D8C84);
      background: -moz-linear-gradient(#C6E272,#86CC86, #3D8C84);/
      background: linear-gradient(#C6E272,#86CC86, #3D8C84);  */

      background-color: #86CC86;
  }

  .img-banner {
    width: 100%;
    height: 150px;
  }


");
 ?>

<?php if (Yii::$app->session->hasFlash('alerta')): ?>
  <div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="icon fa fa-check"></i>Atención!</h4>
    <?= Yii::$app->session->getFlash('alerta') ?>
  </div>
<?php endif; ?>

<div class="site-index">
    <?php $form = ActiveForm::begin(['id' => 'comprobar-form', 'method' => 'post']); ?>
     <!-- <div>  Html::hiddenInput("latitud", '', ['id' => 'oculto1'])  </div> -->
      <input type="hidden" id="oculto1" name="longitud" value="" />
      <input type="hidden" id="oculto2" name="latitud" value=""/>

      <?= Html::button('Comprobar', ['class' => 'btn btn-primary comprobar']) ?>

      <div class="search-index">
            <form class="form-index row" method="GET" action="<?=Url::to(['/site/search'])?>">
                <div class="form-group search-form">
                    <input type="text" name="q" class="form-control typeahead" placeholder=" Busca publicaciones">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form>


    <?= ListView::widget([
           'dataProvider' => $dataProvider,
           'itemOptions' => ['class' => 'item'],
           'itemView' => '/publicaciones/viewmain',

       ]);  ?>
</div>

<div class="banners-imagenes">
    <div><?= Html::img(Url::to('@web/banners/banner-cabecera-teaming.jpg'),['class' => 'img-banner']) ?></div>
    <div><?= Html::img(Url::to('@web/banners/slider-animales-infiernos.jpg'),['class' => 'img-banner']) ?></div>
    <div><?= Html::img(Url::to('@web/banners/slider-mascotas-avila.jpg'),['class' => 'img-banner']) ?></div>
    <div><?= Html::img(Url::to('@web/banners/slider-asoc-suerte.png'),['class' => 'img-banner']) ?></div>
    <div><?= Html::img(Url::to('@web/banners/slider-tienda-mascotas.jpg'),['class' => 'img-banner'])?></div>
    <div><?= Html::img(Url::to('@web/banners/slider-veterinaria-landeta.jpg'),['class' => 'img-banner']) ?></div>
  </div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.banners-imagenes').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  });
</script>
