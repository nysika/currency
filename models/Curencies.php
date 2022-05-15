<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Currencyhistory;

class Curencies extends ActiveRecord
{

  public function getCurrencyhistory()
  {
      return $this->hasMany(Currencyhistory::class, ['valute_id' => 'id']);
  }

}
