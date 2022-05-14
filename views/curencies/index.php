<?php

use yii\widgets\ListView;
?>
<h1>Currencies</h1>


<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => $template,
]);
?>
