<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use app\models\Curencies;

class CurrenciesController extends ActiveController
{
    public $modelClass = 'app\models\Curencies';   

    
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'pagination' => [
                    'pageSize' => 10,
                ],
            ],
        ]);
    }
}
