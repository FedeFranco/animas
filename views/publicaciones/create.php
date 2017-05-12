<?php

use yii\helpers\Html;

$this->registerJs('
var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
      };

      function success(pos) {
      var crd = pos.coords;

      console.log("Your current position is:");
      console.log("Latitude : " + crd.latitude);
      console.log("Longitude: " + crd.longitude);
      console.log("More or less " + crd.accuracy + " meters.");
      };

      function error(err) {
          console.warn("ERROR(" + err.code + "): " + err.message);
          if(err.code == 1) {
              alert("dated save deny")
          }
          else {alert("non dated save deny")}
      };

      navigator.geolocation.getCurrentPosition(success, error, options);



');

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = 'Nueva Publicación';
$this->params['breadcrumbs'][] = ['label' => 'Publicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
    ]) ?>

</div>
<?php
