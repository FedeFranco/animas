<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs("$('#botonpub').hide();
$('#checknormas').click(function(){if($(this).prop('checked')){
                                        $('#botonpub').css('display','block');
                                    } else {
                                        $('#botonpub').hide();
                                    }
                        })
");
?>

<div class="publicacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuerpo')->textarea(['rows' => 6]) ?>

    <div>
        <i>
            Puede adjuntar un enlace con contenido similar a tu publicación
        </i>
    </div>
    <?= $form->field($model, 'url')?>

    <?= Html::a('Normas de publicaciones', ['publicaciones/normas']) ?>
    <?= $form->field($model, 'confirm_pub')->checkbox(['id'=>'checknormas'])?>

    <?= $form->field($model, 'categoria_id')->dropDownList($categorias) ?>

    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Publicar' : 'Update',
         ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'botonpub']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
