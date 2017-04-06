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
             <!-- imagen -->
          </div>
          <div class="media-body">
              <h4 class="media-heading">
                <?= $model->titulo?>
              </h4>
             <?= $model->cuerpo?>
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
