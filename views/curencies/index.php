<?php
//use yii\helpers\Html;
//use yii\widgets\LinkPager;
//use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
?>
<h1>Currencies</h1>


<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_currency',
]);
?>
