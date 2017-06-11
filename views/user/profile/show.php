<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use  yii\web\Request;
/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */
$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <div class="marco-perfil">
        <div class="">
                <div class="">
                    <h4><?= $this->title ?></h4>
                    <ul style="padding: 0px; list-style: none outside none;">
                        <?php if (!empty($profile->location)): ?>
                            <li>
                                <strong class="glyphicon glyphicon-map-marker text-muted"></strong> <?= Html::encode($profile->location) ?>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($profile->website)): ?>
                            <li>
                                <strong class="glyphicon glyphicon-globe text-muted"></strong> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($profile->public_email)): ?>
                            <li>
                                <strong class="glyphicon glyphicon-envelope text-muted"></strong> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                            </li>
                        <?php endif; ?>
                        <li>
                            <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                        </li>
                    </ul>
                    <?php if (!empty($profile->bio)): ?>
                        <p><?= Html::encode($profile->bio) ?></p>
                    <?php endif; ?>
                    <?php if (($profile->user->id === Yii::$app->user->id)): ?>
                        <h3>Tus publicaciones</h3>
                    <?php else: ?>
                        <h3>Publicaciones de <?= Html::encode($this->title); ?></h3>
                    <?php endif; ?>
                    <div id="perfil-padre">
                        <div style="width: 50%;">
                        <div style="background-color: white; border-radius: 4px; height: auto;">
                            <ul style="padding: 20px;">
                                <?php
                                foreach ($publicaciones as $value) { ?>
                                    <li><?=Html::a($value['titulo'],['/publicaciones/view', 'id' => $value['id']]) ?></li>
                                <?php  } ?>
                            </ul>
                        </div>
                        </div>
                        <div class="perfil-img">
                            <?=Html::img(Url::to('@web/fotos-animas/animas-med-lin-alt220.png'),['atl' => 'gorila-animas', 'id' => 'gor-anim', 'class' => 'col-lg']) ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
