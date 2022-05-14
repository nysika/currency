<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Curencies;
use app\models\Currencyhistory;
use app\models\CurrencySearch;
use app\controllers\Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CurenciesController extends Controller
{
    private const POSTS_PER_PAGE = 10;

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
          'query' => Curencies::find(),
          'sort' => [
              'defaultOrder' => [
                  'name' => SORT_ASC,
              ]
          ],
          'pagination' => [
              'pageSize' => self::POSTS_PER_PAGE,
          ],
        ]);
        return $this->render('index', [
          'dataProvider' => $dataProvider,
          'template' => '_currency',
        ]);
    }

    public function actionHistory()
    {
        $searchModel = new CurrencySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date' => SORT_DESC];
        $dataProvider->pagination = ['pageSize' => self::POSTS_PER_PAGE];

        return $this->render('history', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
           'currenciesList' => Curencies::find()->all(),
           'template' => '_history',
        ]);
    }

    public function actionView($id)
    {
        $model = Curencies::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'curency' => $model,
        ]);
    }

    public function actionParse()
    {
        $curencies = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
        $date = date_create_from_format('d.m.Y', $curencies['Date']);

        foreach ($curencies->Valute as $valute) {
            $currency = Curencies::findOne([
              'id' => strval($valute["ID"]),
            ]);
            $curencyHistory = Currencyhistory::findOne([
                'valute_id' => strval($valute["ID"]),
                'date' => date_format($date, 'Y-m-d'),
            ]);
            if (empty($curencyHistory)) {
                $curencyHistory = new Currencyhistory();
                $curencyHistory->valute_id = strval($valute["ID"]);
                $curencyHistory->rate = str_replace(',', '.', $valute->Value);
                $curencyHistory->date = date_format($date, 'Y-m-d');
                $curencyHistory->save();
            }


            if ($currency) {
                $currency->rate = str_replace(',', '.', $valute->Value);
                $currency->update();
            } else {
                $currency = new Curencies();
                $currency->id = strval($valute["ID"]);
                $currency->valute_numcode = $valute->NumCode;
                $currency->valute_charcode = $valute->CharCode;
                $currency->nominal = $valute->Nominal;
                $currency->name = $valute->Name;
                $currency->rate = str_replace(',', '.', $valute->Value);
                $currency->save();
            }
        }
    }
}
