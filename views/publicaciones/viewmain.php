<?php
    use app\models\Publicacion;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use Imagine\Image\Box;
    use Imagine\Image\Point;
    use kartik\social\FacebookPlugin;
    use kartik\social\TwitterPlugin;
    use Yii;
?>

<div class="publicaciones-view">
    <div class="panel panel-default">
        <?php if ($model->categoria['nombre_categoria'] === 'ALERTA'): ?>
          <div class="media panel-alerta" style="background-color: #F45454;">
        <?php else:?>
          <div class="media panel">
        <?php endif; ?>
          <div class="media-left">
             <?= Html::a(Html::img($model->imagen,['width' => '200px','height'=>'200px', 'alt' => 'img-publicacion', 'class' => 'img-circle', 'style' => 'padding: 15px;']), ['/publicaciones/view', 'id' => $model->id]) ?>
          </div>
          <div class="row media-body" style="padding: 15px">
              <div class="col-xs-8 col-sm-8">
                  <h4>
                     <?= $model->categoria['nombre_categoria']?>
                 </h4>
                  <h4 class="media-heading">
                    <?= Html::a($model->titulo,['/publicaciones/view', 'id' => $model->id])?>
                  </h4>
                  <div class="">
                      <?= $model->cuerpo ?>
                  </div>
                 <div class="">
                     <div class=""> <?= Html::a($model->url,$model->url); ?></div>
                 </div>
                 <div class="">
                    Tipo: <?= $model->tipo['nombre_tipo_animal']?>
                 </div>
              </div>
              <div class="col-xs-4 col-sm-4" style="text-align:right;">
                  <p class="">Creado por <?=Html::a($model->usuario->username, ['/user/'.$model->usuario->id])?></p>
                  <p class=""><?= Yii::$app->formatter->asDate($model->fecha_publicacion,'long'); ?></p>
                  <br>
                  <div class="">
                     <?php if (!(Yii::$app->user->isGuest)): ?>
                          <div class="">
                              <?= Html::a('Reportar usuario', ['/reportes/create', 'id' => $model->id], [
                                  'class' => 'btn btn-danger',
                                  'data' => [
                                      'confirm' => 'Está seguro de denunciar a este usuario junto a su publicación?',
                                      'method' => 'post',
                                  ],
                              ]) ?>
                          </div>
                      <?php endif; ?>

                      <div class="">
                          <?php echo FacebookPlugin::widget(['type'=>FacebookPlugin::SHARE, 'settings' => ['size'=>'small', 'layout'=>'button_count', 'mobile_iframe'=>'false', 'href' => Url::to(['publicaciones/view',$model->id])]]) ?>
                      </div>

                      <div class="">
                         <?php echo TwitterPlugin::widget(['type'=>TwitterPlugin::SHARE, 'settings' => ['size'=>'default']]); ?>
                      </div>
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
