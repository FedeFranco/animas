<?php
use yii\grid\GridView;

 ?>

 <?php yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $simpleFilterData,
        'columns' => [
            'titulo',
            'tipo.nombre_tipo_animal',
            'categoria.nombre_categoria',
        ],
        'summary' => false
    ]) ?>
 <?php yii\widgets\Pjax::end(); ?>
