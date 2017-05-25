<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            'cuerpo:ntext',
            'titulo',
            'categoria_id',
            'usuario_id',
            'fecha_publicacion:datetime',
            'latitud',
            'longitud',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
