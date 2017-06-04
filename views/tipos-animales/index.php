<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-animal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Animal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_tipo_animal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
