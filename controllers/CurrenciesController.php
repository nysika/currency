<?php
namespace app\controllers;

use Yii;
use yii\data\DataFilter;
use yii\data\ActiveDataFilter;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use app\models\Curencies;
use app\models\Currencyhistory;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\data\ActiveDataProvider;



class CurrenciesController extends ActiveController
{
    private const POSTS_PER_PAGE = 10;
    public $modelClass = 'app\models\Curencies';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
          'class' => CompositeAuth::class,
          'authMethods' => [
              HttpBearerAuth::class,
          ],
        ];

        return $behaviors;

    }

    public function actions()
    {
      $actions = parent::actions();
      $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
      return $actions;
      /*  return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'pagination' => [
                    'pageSize' => 10,
                ],
            ],
        ]);*/
    }

    public function prepareDataProvider() {

        $query = $this->modelClass::find();
        if(\Yii::$app->request->get('date')) {
            $query = $query->joinWith(['currencyhistory'])->select(['curencies.id', 'curencies.name', 'currency_history.rate', 'currency_history.date'])->andWhere(['currency_history.date' => \Yii::$app->request->get('date')]);
        }

        if (\Yii::$app->request->get('id')) {
          $query = $query->andWhere(['curencies.id' => \Yii::$app->request->get('id')]);

        }

        $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'sort' => [
              'defaultOrder' => [
                  'name' => SORT_ASC,
              ]
          ],
          'pagination' => [
              'pageSize' => self::POSTS_PER_PAGE,
          ],
        ]);


        return $dataProvider;
    }


}
