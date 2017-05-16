<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Publicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cuerpo:ntext',
            'titulo',
            'categoria.nombre_categoria',
            'url',
            'latitud',
            'longitud',
            'usuario.username',
        ],
    ]) ?>

    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?=$model->latitud?>,<?=$model->longitud?>&hl=es;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?q='+<?=$model->latitud?>+','+<?=$model->longitud?>+'&hl=es;z=14&amp;output=embed" style="color:#0000FF;text-align:left" target="_blank">Ver en Google Maps</a></small>


</div>
