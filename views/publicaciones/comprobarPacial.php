<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
?>
<div class="publicacion-view">
    <?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        [
            'label'=>'Título',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a(Html::encode($data['titulo']), ['/publicaciones/view', 'id' => $data['id']]);
             },
        ],
        'categor_nom',
        'fecha_publicacion',
    ],
    ]) ?>

</div>
