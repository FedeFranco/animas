<?php
    use app\models\Publicacion;
    use yii\helpers\Html;
    use Yii;
?>

<?php
?>

<div class="publicaciones-view">
    <div class="panel panel-default">
        <div class="media">
          <div class="media-left">
             <?= Html::a(Html::img($model->imagen), ['/publicaciones/view', 'id' => $model->id]) ?>
          </div>
          <div class="media-body">
              <h4 class="media-heading">
                <?= $model->titulo?>
              </h4>
             <?= $model->cuerpo?>
             <div class="row">
                 <div class="col-md-2">
                    Por <?= $model->usuario->username?>
                 </div>
                 <div class="col-md-2">
                     <?= Html::a('Reportar usuario', ['/reportes/create', 'id' => $model->id], [
                         'class' => 'btn btn-danger',
                         'data' => [
                             'confirm' => 'Está seguro de denunciar a este usuario junto a su publicación?',
                             'method' => 'post',
                         ],
                     ]) ?>
                 </div>
             </div>
             <br/>
             <br/>
            <?php
                if (!(Yii::$app->user->isGuest) && Yii::$app->user->identity->isAdmin) { ?>

                    <?= Html::a('Borrar', ['/publicaciones/delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php } ?>
          </div>
        </div>
    </div>
</div>
