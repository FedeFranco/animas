<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\FontAsset;
use app\assets\AppAsset;

AppAsset::register($this);
FontAsset::register($this);

$this->registerCss('
html, body {
    background-color: #19254B;
}

ul {
    color: white;
    font-family: "Ubuntu", serif;
}

');
?>
<h1> Normas de publicación</h1>
<p>Para establecer un uso correcto de la web, le rogamos usen los siguientes principios</p>
<br />
<div class="container">
    <div class="row">
        <ul class="col-lg">
            <li>Evite contenido violento y desagradable como sangre, heridas y deformaciones en las imágenes de la publicación</li>
            <li>Si es un particular, absténgase de incluir publicidad en las publicaciones</li>
            <li>Sea claro en la descripción. Use expresiones cortas y entendibles y no incluya palabras mal sonantes</li>
            <li>El título de la publicación debe ser una frase relacionado con el contenido en general de la publicación. No inlcuya palabras como "ayuda" o "porfavor"</li>
            <li>Si el animal al que referencia la publicación tiene alguna necesidad así como una enfermedad, no olvide incluirlo</li>
        </ul>
        <?=Html::img(Url::to('@fotos-animas/dolphin.jpg'),['atl' => 'delfin-animas', 'id' => 'delf-anim', 'class' => 'col-lg']) ?>
    </div>
</div>
