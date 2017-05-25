<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\helpers\Url;
use app\assets\FontAsset;


FontAsset::register($this);

$this->title = 'Sobre Animas';
$this->registerCss('html, body {
                    background-color: #101727;
                }

                p, h1 {
                    color: white;
                    font-family: "Ubuntu", serif;
                }
       ');
?>

<br />
<br />
<?php $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode("¿Qué Somos?") ?></h1>

    <p>
        Somos una plataforma de apoyo para los animales.
        Con nuestra ayuda, queremos ofrecer todo tipo de protección social
        a los animales. Pero no podrá ser sin la ayuda de los usuarios, donde ellos podrán dar a conocer
        paraderos de mascotas perdidas y animales en adopción. Así como casos de abandono y maltrato

        Te animamos a que te sumes al mundo Animas, si es que no lo has hecho ya.
     </p>
    <?= Html::img(Url::to('@fotos-animas/dribble.jpg'),['alt' => 'lobo animas', 'id' => 'img-about']) ?>
</div>
