<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
$this->title = 'Animas';
?>
<div class="site-index">



    <?= ListView::widget([
           'dataProvider' => $dataProvider,
           'itemOptions' => ['class' => 'item'],
           'itemView' => '/publicaciones/viewmain',
       ]);  ?>

   
</div>
