<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\helpers\Url;
use app\assets\FontAsset;
use app\assets\AppAsset;

AppAsset::register($this);
FontAsset::register($this);

$this->title = 'Sobre Animas';
$this->registerCss('html, body {
                    background-color: #101727;
');
?>

<br />
<br />
<?php $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h1><?= Html::encode("¿Qué Somos?") ?></h1>

                <p>
                    Somos una plataforma de apoyo para los animales.
                    Con nuestra ayuda, queremos ofrecer todo tipo de protección social
                    a los animales. Pero no podrá ser sin la ayuda de los usuarios, donde ellos podrán dar a conocer
                    paraderos de mascotas perdidas y animales en adopción. Así como casos de abandono y maltrato

                    Te animamos a que te sumes al mundo Animas, si es que no lo has hecho ya.
                 </p>
            </div>
            <div class="col-lg-5">
                <?= Html::img(Url::to('@web/fotos-animas/dribble.jpg'),['alt' => 'lobo animas', 'id' => 'img-about']) ?>
            </div>
        </div>
    </div>

</div>
