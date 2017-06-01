<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FontAsset;
use yii\web\UrlManager;

FontAsset::register($this);
AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->renderMetaTags(); ?>
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
        'brandLabel' => Html::img('@web/animas-logo2.png', ['alt'=>Yii::$app->name]),
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
     <br />
    <br />
    <br />
    <br />
    <br />
    <?php if(!(Yii::$app->user->isGuest) && Yii::$app->user->identity->isAdmin) { ?>
        <div class="nav-pills" style="background-color:black;">
            <div class="row">
                <div class="col-lg-3"><?= Html::a("Reportes",['/reportes/index'],['class' => 'btn btn-default']) ?></div>
                <div class="col-lg-3"><?= Html::a("Usuarios",['/user/admin/index'],['class' => 'btn btn-default']) ?></div>
                <div class="col-lg-3"><?= Html::a("Publicaciones",['/publicaciones/index'],['class' => 'btn btn-default']) ?></div>
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

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <p class="pull-left">&copy; Proyecto Animas <?= date('Y') ?></p>
            </div>
            <div class="col-lg-3">
                <p><?= Html::a('Contacta con nosotros',Url::to(['site/contact'])); ?></p>
            </div>
            <div class="col-lg-3">
                    <?=Html::a(Html::img(Url::to('@web/icon_fb.jpg'),['width' => '30px', 'height' => '30px']),Url::to('https://www.facebook.com/sharer/sharer.php?u=https://animas.herokuapp.com')) ?>
            </div>
            <div class="col-lg-3">
                <?=Html::a(Html::img(Url::to('@web/icon_tw.jpg'),['width' => '30px', 'height' => '30px']),Url::to('https://twitter.com/intent/tweet?text=Proyecto+Animas+https://animas.herokuapp.com')) ?>
            </div>
        </div
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
