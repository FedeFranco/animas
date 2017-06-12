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

                 <h2>¿Nuevo en <span itemprop="name">animas</span>?</h2>
                 <p itemprop="description">
                     <span itemprop="name">Animas</span> Muestra las publicaciones de usuarios que quieren dar en ADOPCIÓN, APADRINAMIENTO o ACOGIDA mascotas o publicaciones de ALERTAS para animales que han podido escaparse
                     Echa un vistazo a la barra de menú. En la sección de <?= Html::a('Publicar', ['/publicaciones/create'])?> podrás dar a conocer al
                     resto de usuarios si deseas dar en adopción, apadrinamiento o acogida a algún animal
                     o por otra parte una de tus mascotas se ha perdido o escapado... de esa manera podrás publicar una ALERTA.

                     En la sección de <?= Html::a('Buscar', ['/site/filtro'])?>, podrás encontrar publicaciones que te interesen, filtrando por tipos de animales
                     y/o por categorías.
                     No te olvides <?= Html::a('Registrarte', ['/user/registration/register'])?> y <?= Html::a('Loguearte', ['/user/security/login'])?> , encontrarás más servicios que ofrece <span itemprop="owns">Proyecto Animas</span>
                 </p>

                 <h3>Cómo usar <span itemprop="name">Animas</span></h3>
                 <p itemprop="description">
                     Como ya sabes, los usuarios de <span itemprop="name">Animas</span> se registran en la plataforma y de esta manera pueden publicar anuncios para comunicar al restos de usuarios de la web de qué forman desean ayudar a una mascota.
                     Una vez accediendo a <?= Html::a('Publicar', ['/publicaciones/create'])?>, elemento que encontramos en el menú de navegación, se nos presentará un formulario, el cual debemos rellenar. Nos encontraremos con: el <strong>Título</strong>,
                     el cual debemos debe ser una síntesis de la publicación; el <strong>Cuerpo</strong>, que es la descripción de la publicación: un <strong>Enlace</strong>, el cual es una información adicional a la cual queramos redirigir al usuario;
                     una lista desplegable de <strong>Categorias</strong>, donde indicaremos de que forma queremos que nos ayuden; una lista desplegable de <strong>Tipos</strong>, donde indicaremos a que familia pertenece cada animal y por último deberemos seleccionar
                     una <strong>Imagen</strong> de nuestro animal o mascota. ¡No olvides chequear las <?= Html::a('Normas de publicación', ['/publicaciones/normas'])?> para que puedas publicar!. Una vez publicado encontrarás tu publicación en forma de anuncio en la página principal
                     Para acceder a la infromación de la publicación basta con pulsar en el título o la imagen de la misma. Podrás encontrar un mapa de la localización donde ha ocurrido tu publicación. Si deseas tan cambiar el punto de localización ¡Tan solo pincha y arrastra!
                     Para borrar una publicación, deberás dirigirte a la información completa de la publicación (como acabamos de nombrar), una vez ahí podrás borrar o modificar los datos de la publicación en los botones que se encuentran en la parte superior.
                     Para acceder a la lista de tus publicaciones bastará pulsando en la opción del menú de navegación "Mi Perfil" (para que aparezca esta opción se debe de estar logueado).Dentro de tu información encontrarás una lista de todas tus publicaciones.

                     También puedes ver las publicaciones de otros usuarios accediendo por el nombre de usuario que se encuentra en cada publicación anunciada en la página principal.
                 </p>
                 <br />
                 <br />
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
