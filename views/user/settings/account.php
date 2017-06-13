<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 */

$this->title = Yii::t('user', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'account-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'new_password')->passwordInput() ?>

                <hr/>

                <?= $form->field($model, 'current_password')->passwordInput() ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-block btn-success']) ?><br>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <?php if (($model->module->enableAccountDelete)): ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('user', 'Borrar Cuenta') ?></h3>
                </div>
                <div class="panel-body">
                    <p>
                        <?= Yii::t('user', 'Una vez borrada la cuenta, no se podrá volver atrás') ?>.
                        <?= Yii::t('user', 'Se borrará para siempre') ?>.
                        <?= Yii::t('user', 'Por favor, reconsidéralo') ?>.
                    </p>
                    <?= Html::a(Yii::t('user', 'Borrar Cuenta'), ['delete'], [
                        'class' => 'btn btn-danger',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Estás seguro? No se podrá volver atrás'),
                    ]) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
