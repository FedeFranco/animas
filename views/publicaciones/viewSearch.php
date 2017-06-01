<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Cancion */

?>

<div class="cancion-view">

      <div class="col-sm-12 col-md-12 cancion-search">
            <a href="<?= Url::to(['/publicaciones/view', 'id' => $model->id]) ?>">
              <div class="caption">
                <h3 class="rosa"><?= $model->titulo?></h3>
              </div>
            </a>
        </div>

</div>
