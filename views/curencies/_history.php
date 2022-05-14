<?php
use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
?>
<div class="post">
  <?= $model->date ?> <?= $model->valute_id ?>  <?= $model->currency->name ?> <?= $model->currency->valute_charcode ?> <?= $model->rate ?>

</div>
