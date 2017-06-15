<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Resultados de la busqueda de: "'.$q.'"';

$this->registerCss('html, body {height: auto;}');
?>

<h2><?=$this->title?></h2>

<br>

<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#canciones" aria-controls="publicaciones" role="tab" data-toggle="tab">Publicaciones</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="publicaciones"></br>
      <div class="row">
          <?= ListView::widget([
          'dataProvider' => $publicacionesProvider,
          'itemOptions' => ['class' => 'item'],
          'itemView' => '/publicaciones/viewSearch',
          'layout' => "{items}\n{pager}",
          ]) ?>
      </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
