<?php

namespace app\models;

use yii\db\ActiveRecord;


class Currencyhistory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%currency_history}}';
    }

    public function getCurrency()
    {
        return $this->hasOne(Curencies::class, ['id' => 'valute_id']);
    }



}
