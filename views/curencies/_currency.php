<?php
use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
?>
<div class="post">
  <?= Html::encode("{$model->id} {$model->valute_charcode} ({$model->name})") ?>:
       <?= $model->rate/$model->nominal ?>
</div>
