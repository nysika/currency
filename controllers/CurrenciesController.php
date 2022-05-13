<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use app\models\Curencies;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class CurrenciesController extends ActiveController
{
    public $modelClass = 'app\models\Curencies';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
          'class' => CompositeAuth::class,
          'authMethods' => [
<<<<<<< HEAD
              HttpBearerAuth::class,
=======
              //HttpBasicAuth::className(),
              HttpBearerAuth::class,
              //QueryParamAuth::class,
>>>>>>> fb50a65 (bearer auth)
          ],
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
