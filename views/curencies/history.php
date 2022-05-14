<?php

use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<h1>Currencies History</h1>

<div class="currency-form">
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <?= $form->field($searchModel, 'valute_id')->dropDownList(ArrayHelper::map($currenciesList,'id','name')); ?>

    <?= $form->field($searchModel, 'date')->widget(DatePicker::class, [
      'dateFormat' => 'yyyy-MM-dd',
      ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => $template,
]);
?>
