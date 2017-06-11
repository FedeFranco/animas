<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Publicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to('/publicaciones/mapa');

if ($model->usuario->id === Yii::$app->user->id) {
	$drag = true;
} else {
	$drag = 0;
}

$js = <<<JS
var drag = false;

if ($drag) {
	drag = true;
}

var map;
var marker;
var laturl;
var lngurl;
var baseurl = "http://augmenting.me/geo/report/?coordinates=";
var linkurl;
var comma = ", ";

//set map variables
function initialize() {
  var mapOptions = {
	zoom: 18
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
	  mapOptions);

  // Try HTML5 geolocation to get location
  if(navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
	  var pos = new google.maps.LatLng($model->latitud,$model->longitud ); //position.coords.longitude
	  var marker = new google.maps.Marker({
		map: map,
		position: pos,
		title: 'We are watching you.',
		draggable: drag,
		icon: {
		  path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
		  scale: 10,
		  strokeColor: '#FF0000'
		},
	  });

//gets the pre-drag lat/long coordinates as a pair
	  //document.getElementById("latbox").innerHTML=marker.getPosition().lat();

//gets the pre-drag latlong coordinate
		  //document.getElementById("latbox").innerHTML=marker.getPosition().lat();
		  //document.getElementById("longbox").innerHTML=marker.getPosition().lng();
		  var laturl=marker.getPosition().lat();
		  var lngurl=marker.getPosition().lng();
		  var linkurl=baseurl.concat(laturl,comma,lngurl);
		  //document.getElementById("linkurl").href=linkurl;

//gets the new latlong if the marker is dragged
		google.maps.event.addListener(marker, "drag", function(){

			$.ajax({
				method: 'get',
        		url: "$url",
				data: {
					id: $model->id,
					long: marker.getPosition().lng(),
					lat: marker.getPosition().lat()
				},
				success: function(data, status, event) {
					console.log(data)
				}

			});

			//document.getElementById("latbox").innerHTML=marker.getPosition().lat();
			//document.getElementById("longbox").innerHTML=marker.getPosition().lng();
			var laturl=marker.getPosition().lat();
			var lngurl=marker.getPosition().lng();
			var linkurl=baseurl.concat(laturl,comma,lngurl);
			//document.getElementById("linkurl").href=linkurl;
		});

	  map.setCenter(pos);
	}, function() {
	  handleNoGeolocation(true);
	});
  } else {
	// Browser doesn't support Geolocation
	handleNoGeolocation(false);
  }

}

//if it all fails
function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
	var content = 'Error: The Geolocation service failed.';
  } else {
	var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
	map: map,
	position: new google.maps.LatLng(60, 105),
  };

  var marker = new google.maps.Marker(options);
  map.setCenter(options.position);


}

google.maps.event.addDomListener(window, 'load', initialize);

JS;
$this->registerJs($js)
?>
<div class="publicacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if ($model->usuario->id === Yii::$app->user->id): ?>

	        <?=  Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	         <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => '¿Está seguro de borrar esta publicación?',
	                'method' => 'post',
	            ],
	        ]) ?>
	<?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cuerpo:ntext',
            'titulo',
            'categoria.nombre_categoria',
            'tipo.nombre_tipo_animal',
            'url',
            'latitud',
            'longitud',
            'usuario.username',
            'fecha_publicacion:relativeTime',
        ],
    ]) ?>
    <br>
    <br>
    <br>
    <div id="map-canvas" style="height: 280px;width: 100%;"></div>
    <?php if (!(Yii::$app->user->isGuest)): ?>
        <h2 id="cab-contacto">Ver Contacto &#x21B6;</h3>

        <div id="contacto-telf-view">
            Teléfono: <?= $model->telf_contacto?>
        </div>

        <br />
        <br/>
        <br/>
    <!--    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?=$model->latitud?>,<?=$model->longitud?>&hl=es;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?q='+<?=$model->latitud?>+','+<?=$model->longitud?>+'&hl=es;z=14&amp;output=embed" style="color:#0000FF;text-align:left" target="_blank">Ver en Google Maps</a></small> -->
    <?php else:?>
        <div><strong>Para ver la información del teléfono y la ubicación de esta publicación debe estar <?= Html::a('logueado',['/user/security/login'])?></strong></div>
    <?php endif; ?>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHvxtC6tuK72E_ZcWHcyYQzYxqhZzYsbk">
</script>
<!-- <script> -->


<!-- </script> -->
