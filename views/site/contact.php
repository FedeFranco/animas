<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\assets\FontAsset;
use app\assets\AppAsset;
use app\assets\AppAssetJS;

AppAssetJS::register($this);
AppAsset::register($this);
FontAsset::register($this);

$this->registerCss('
    html, body {
        background-color: #E3E2DD;
    }

    h1, h2, p, div, label {
        color: black;
    }


');
$this->title = 'Contacta con Animas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Gracias por contactar con nosotros. Responderemos lo antes posible
        </div>

    <?php else: ?>

        <p>
            Si tienes una organización proanimalista o
            te interesa nuestro proyecto y quieres colaborar o
            simplemente tienes una pregunta no dudes en contactar
            con nostros.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-5">
                <?= Html::img(Url::to('@web/fotos-animas/deer-animas-trans.png'))?>
            </div>
        </div>

    <?php endif; ?>

</div>
<script>
    $(document).ready(function() {
          $("form").validate({
            lang: 'es'
          });
        });
    $("form").validate();
</script>
