<!DOCTYPE html>
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
    window.location.href = '$url?lat=' + crd.latitude + '&long=' + crd.longitude;
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

      background-color: #E3E2DD;
  }

  .img-banner {
    width: 100%;
    height: 150px;
  }


");
 ?>



<div class="site-index">

        <?php $form = ActiveForm::begin(['id' => 'comprobar-form', 'method' => 'post']); ?>
        <!-- <div>  Html::hiddenInput("latitud", '', ['id' => 'oculto1'])  </div> -->
        <label for="oculto1">
            <input type="hidden" id="oculto1" name="longitud" value="" />
        </label>
        <label for="oculto2">
            <input type="hidden" id="oculto2" name="latitud" value=""/>
        </label>
        <?= Html::button('Comprobar', ['class' => 'btn btn-primary comprobar', 'id' => 'bot-comprobar-cercanos']) ?>
        <br />
        <br />
        <form class="form-index" method="GET" action="<?=Url::to(['/site/search'])?>">
            <div class="form-group search-form">
              <label for="text-seek">¡Introduce alguna palabra para encontrar una publicación!</label>
              <div class="search-from-inputs">
                  <input type="text" id="text-seek" name="q" class="form-control typeahead" placeholder=" Busca publicaciones">
                  <button type="submit" class="btn btn-default" id="search-submit"><span class="glyphicon glyphicon-search"></span></button>
              </div>
            </div>
        </form>

    <div class="search-index">
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
