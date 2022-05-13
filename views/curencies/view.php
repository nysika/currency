<?php
use yii\helpers\Html;
?>

<?= Html::encode("{$curency->valute_charcode} ({$curency->name})") ?>:
<?= $curency->rate/$curency->nominal ?>
