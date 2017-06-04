<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAnimal */

$this->title = 'Create Tipo Animal';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-animal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
