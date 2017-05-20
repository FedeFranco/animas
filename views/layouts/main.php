<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\UrlManager;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $items = [
        ['label' => 'Sobre Animas', 'url' => ['/site/about']],
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'items' =>[['label' => 'Loguearse',
                                        'url' => ['/user/security/login']],
                                        ['label' => 'Registrarse',
                                        'url' => ['/user/registration/register']]]]
        ) : (
            '<li>'
            . Html::beginForm(['/user/security/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )];
    if (!(Yii::$app->user->isGuest)) {

         array_unshift($items, ['label' => 'Mi Perfil', 'url' => ['/user/profile'/* . Yii::$app->user->id*/]]);
         array_unshift($items, ['label' => 'Configuración',  'url' => ['/user/settings/profile']]);
         array_unshift($items, ['label' => 'Publicar',  'url' => ['/publicaciones/create']]);
    }

    NavBar::begin([
        'brandLabel' => 'Animas',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>
    <?php
    if(!(Yii::$app->user->isGuest)) {
        $session = Yii::$app->session;

        $session['numero'] = 4;


    }
    ?>
    <?php if(!(Yii::$app->user->isGuest) && Yii::$app->user->identity->isAdmin) { ?>
        <div class="container" style="background-color:black;">
            <div class="row">
                <div class="col-md-3"><?= Html::a("Reportes",['/reportes/index'],['class' => 'btn btn-default']) ?></div>
                <div class="col-md-3"><?= Html::a("Usuarios",['/user/admin/index'],['class' => 'btn btn-default']) ?></div>
                <div class="col-md-3"><?= Html::a("Publicaciones",['/publicaciones/index'],['class' => 'btn btn-default']) ?></div>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?php if(!(Yii::$app->user->isGuest)) { ?>

<div><?= $session['__id'] ?></div>
<?php } ?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="pull-left">&copy; Proyecto Animas <?= date('Y') ?></p>
            <div>
            <div class="col-sm-8">
                <p><?= Html::a('Contacta con nosotros',Url::to(['site/contact'])); ?></p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
