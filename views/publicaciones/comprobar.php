<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = 'Comprobar publicaciones cercanas';
$this->params['breadcrumbs'][] = ['label' => 'Publicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
