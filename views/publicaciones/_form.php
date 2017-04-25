<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
/* @var $form yii\widgets\ActiveForm */

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

    <?= $form->field($model, 'categoria_id')->dropDownList($categorias) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Publicar' : 'Update',
         ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
