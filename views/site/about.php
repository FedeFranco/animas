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
    <div class="site-about" itemscope itemtype="https://schema.org/Organization">
        <div class="padre-sobre-nosotros">
            <div class="">
                <h1><?= Html::encode("¿Qué Somos?") ?></h1>

                <p itemprop="description"><span itemprop="owns">Proyecto Animas</span>es una plataforma de apoyo para los animales.
                    Con nuestra ayuda, queremos ofrecer todo tipo de protección social
                    a los animales. Pero no podrá ser sin la ayuda de los usuarios, donde ellos podrán dar a conocer
                    paraderos de mascotas perdidas y animales en adopción. Así como casos de abandono y maltrato
                    Te animamos a que te sumes al mundo Animas, si es que no lo has hecho ya.
                 </p>

                 <h3>¿Nuevo en <span itemprop="name">animas</span>?</h3>
                 <p>
                     <span itemprop="name">Animas</span> Muestra las publicaciones de usuarios que quieren dar en ADOPCIÓN, APADRINAMIENTO o ACOGIDA mascotas o publicaciones de ALERTAS para animales que han podido escaparse
                     Echa un vistazo a la barra de menú. En la sección de <?= Html::a('Publicar', ['/publicaciones/create'])?> podrás dar a conocer al
                     resto de usuarios si deseas dar en adopción, apadrinamiento o acogida a algún animal
                     o por otra parte una de tus mascotas se ha perdido o escapado... de esa manera podrás publicar una ALERTA.

                     En la sección de <?= Html::a('Buscar', ['/site/filtro'])?>, podrás encontrar publicaciones que te interesen, filtrando por tipos de animales
                     y/o por categorías.
                     No te olvides <?= Html::a('Registrarte', ['/user/registration/register'])?> y <?= Html::a('Loguearte', ['/user/security/login'])?> , encontrarás más servicios que ofrece <span itemprop="owns">Proyecto Animas</span>
                 </p>
            </div>
            <div class="">
                <?= Html::img(Url::to('@web/fotos-animas/dribble.jpg'),['alt' => 'lobo animas', 'id' => 'img-about']) ?>
            </div>
            <h5>
                <span itemprop="founder">Desarrollado por Jesús Franco</span>
            </h5>
        </div>
    </div>

</div>
