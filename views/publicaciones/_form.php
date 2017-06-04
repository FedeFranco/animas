<?php
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\imagine\Image;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Publicacion */
/* @var $form yii\widgets\ActiveForm */
$relacion = Url::to(['/publicaciones/normas']);
$this->registerJs("
//var confirmLoc = confirm('Animas quiere saber su ubicación');
var crd;
var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
      };

      function success(pos) {
      crd = pos.coords;

      console.log('Your current position is:');
      console.log('Latitude : ' + crd.latitude);
      console.log('Longitude: ' + crd.longitude);
      console.log('More or less '+ crd.accuracy + ' meters.');
      $('#lat').val(crd.latitude);
      $('#lon').val(crd.longitude);
      };

      function error(err) {
          console.warn('ERROR(' + err.code + '): ' + err.message);
          document.location.href='/';

      };

      navigator.geolocation.getCurrentPosition(success,error, options);

$('#botonpub').hide();

$('#checknormas').click(function(){if($(this).prop('checked')){
                                        $('#botonpub').css('display','block');
                                    } else {
                                        $('#botonpub').hide();
                                    }
                        })

$('#normas').click(function(){
    var miwind = window.open('$relacion', '', 'toolbar=yes,menubar=yes,width=100,height=100');
    miwind.moveTo(0,0)
     miwind.resizeTo(screen.width,screen.height);
})

");

?>

<div class="publicacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'latitud')->hiddenInput(['id' => 'lat'])->label(false) ?>
    <?= $form->field($model, 'longitud')->hiddenInput(['id' => 'lon'])->label(false) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuerpo')->textarea(['rows' => 6]) ?>

    <div>
        <i>
            Puede adjuntar un enlace con contenido similar a tu publicación
        </i>
    </div>
    <?= $form->field($model, 'url')?>
    <a id="normas">Normas de publicación</a>
     <!--Html::a('Normas de publicaciones', ['publicaciones/normas']) -->
    <?= $form->field($model, 'confirm_pub')->checkbox(['id'=>'checknormas'])?>

    <?= $form->field($model, 'categoria_id')->dropDownList($categorias) ?>

    <?= $form->field($model, 'tipo_animal_id')->dropDownList($tipos) ?>

    <?= $form->field($model, 'telf_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Publicar' : 'Update',
         ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'botonpub']) ?>
    </div>

    <?php ActiveForm::end()?>

</div>
