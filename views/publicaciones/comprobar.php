<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
$urlComp = Url::to(['/publicaciones/comprobar', 'lat' => $_GET['lat'], 'long' => $_GET['long']]);
$js = <<<JS
    $('#rangkm').change(function(){
        $.ajax({
            method: 'get',
            url: '$urlComp',
            context: this,
            data: {
                km: $(this).val(),
                ajax: true
            },
            success: function(data, status, event) {
                $('#grid-comprobar').empty();
                $('#grid-comprobar').html(data);
                $('#km').empty();
                $('#km').html($(this).val());
            }

        })
    });
JS;
$this->registerJs($js);
$this->title = 'Comprobar publicaciones cercanas';
$this->params['breadcrumbs'][] = ['label' => 'Publicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicacion-view">
<p>Filtrar por distancia:</p>
<div class="row col-sm-12">
    <p class="col-sm-1">1 Km</p>
    <div class="col-sm-6">
        <input type="range" id="rangkm" name="rang" value="1" min="1" max="80"/>
    </div>
    <p class="col-sm-1">80 Km</p>
</div>
<br>

    <h3 style="color:white;">Publicaciones a <span id="km">1</span> Km:</h3>

    <div id="grid-comprobar">

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
        'categoria.nombre_categoria',
        'tipo.nombre_tipo_animal',
        'fecha_publicacion:relativeTime',
    ],
    ]) ?>
    </div>

</div>
