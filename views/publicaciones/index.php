<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Publicacion;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PublicacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publicación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Publicar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cuerpo:ntext',
            'titulo',
            'categoria.nombre_categoria',
            'tipo.nombre_tipo_animal',
            'usuario.username',
            'fecha_publicacion:datetime',
            'latitud',
            'longitud',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
    $publicaciones = Publicacion::find()->all();
    $alertas = 0;
    $acogidas = 0;
    $apadrinamientos = 0;
    $adopciones = 0;

    foreach ($publicaciones as $publicacion) {
        if ($publicacion->categoria['nombre_categoria'] === 'ALERTA') {
            $alertas++;
        }
        elseif ($publicacion->categoria['nombre_categoria'] === 'ACOGIDA') {
            $acogidas++;
        }
        elseif ($publicacion->categoria['nombre_categoria'] === 'APADRINAMIENTO') {
            $apadrinamientos++;
        }
        elseif ($publicacion->categoria['nombre_categoria'] === 'ADOPCIÓN') {
            $adopciones++;
        }
    }
?>

<div class="container">
  <h2>Estadísticas sobre Animas</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Categoria</th>
        <th>Media</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>Alertas</strong></td>
        <td><?= $alertas / 2?></td>
        <td><?= $alertas?></td>
      </tr>
      <tr>
        <td><strong>Acogida</strong></td>
        <td><?= $acogidas / 2?></td>
        <td><?= $acogidas?></td>
      </tr>
      <tr>
        <td><strong>Apadrinamiento</strong></td>
        <td><?= $apadrinamientos / 2?></td>
        <td><?= $apadrinamientos?></td>
      </tr>
      <tr>
        <td><strong>Adopción</strong></td>
        <td><?= $adopciones / 2?></td>
        <td><?= $adopciones?></td>
      </tr>
    </tbody>
  </table>
</div>
