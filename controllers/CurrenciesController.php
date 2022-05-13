<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use app\models\Curencies;
//use yii\filters\auth\CompositeAuth;
//use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
//use yii\filters\auth\QueryParamAuth;

class CurrenciesController extends ActiveController
{
    public $modelClass = 'app\models\Curencies';    

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

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
