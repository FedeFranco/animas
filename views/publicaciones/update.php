<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = 'Modificar Publicación: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Publicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="publicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipos' => $tipos,
        'categorias' => $categorias,
        
    ]) ?>

</div>
