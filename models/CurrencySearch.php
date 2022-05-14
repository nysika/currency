<?php

namespace app\models;

use app\models\Model;
use yii\data\ActiveDataProvider;

class CurrencySearch extends Currencyhistory
  {

    public function rules(){
        return [
            [['valute_id', 'date'], 'safe'],
        ];
    }
    /*public function scenarios(){
        return Model::scenarios();
    }*/
    public function search($params){
        $query = Currencyhistory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;
        }
        $query->andFilterWhere([
            'valute_id' => $this->valute_id,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
  }
