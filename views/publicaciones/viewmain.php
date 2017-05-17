<?php
    use app\models\Publicacion;
    use yii\helpers\Html;
    use Imagine\Image\Box;
    use Imagine\Image\Point;
    use Yii;
?>

<div class="publicaciones-view">
    <div class="panel panel-default">
        <div class="media">
          <div class="media-left">
             <?= Html::a(Html::img($model->imagen,['width' => '250px','height'=>'200px']), ['/publicaciones/view', 'id' => $model->id]) ?>
          </div>
          <div class="media-body">
              <h4 class="media-heading">
                <?= Html::a($model->titulo,['/publicaciones/view', 'id' => $model->id])?>
              </h4>
             <?= $model->cuerpo?>
             <div class="row">
                 <div class="col-md-3">
                    Por <?= $model->usuario->username?>
                 </div>
                 <div class="col-md-3">
                     <?= Yii::$app->formatter->asDateTime($model->fecha_publicacion,'full'); ?>
                 </div>
                 <div class="col-md-3">
                     <?= Html::a($model->url,$model->url); ?>
                 </div>
                 <div class="row">
                     <div class="row">
                         <div class="col-md-2">
                            <?= $model->categoria['nombre_categoria']?>
                         </div>
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
