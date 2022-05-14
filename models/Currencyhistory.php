<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "Currencyhistory".
 *

 * @property string $valute_id
 * @property integer $rate
 * @property integer $date
 *
 * @property Curencies $curencies
 */

class Currencyhistory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%currency_history}}';
    }

    public function getCurrencyName()
    {
        return $this->hasOne(Curencies::class, ['id' => 'valute_id']);
    }

}
