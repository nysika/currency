<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Curencies;
use app\models\CurenciesSearch;
use app\controllers\Yii;
use yii\data\ActiveDataProvider;
use app\controllers\NotFoundHttpException;

class CurenciesController extends Controller
{
    private const POSTS_PER_PAGE = 10;

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
          'query' => Curencies::find(),
          'sort' => ['defaultOrder'=>'name'],
          'pagination' => [
              'pageSize' => self::POSTS_PER_PAGE,
          ],
        ]);
        return $this->render('index', [
          'dataProvider' => $dataProvider,
        ]);
      /*  $query = Curencies::find();
        $pagination = new Pagination([
            'defaultPageSize' => self::POSTS_PER_PAGE,
            'totalCount' => $query->count(),
        ]);

        $curencies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'curencies' => $curencies,
            'pagination' => $pagination,
        ]);*/

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
        foreach ($curencies->Valute as $valute)
        {
            $currency = Curencies::find()->where(['id' => strval($valute["ID"])])->one();

            if ($currency)
            {
                $currency->rate = str_replace(',', '.', $valute->Value);
                $currency->update();
            }
            else
            {
                $currency = new Curencies();
                $currency->id = strval($valute["ID"]);
                $currency->valute_numcode = $valute->NumCode;
                $currency->valute_charcode = $valute->CharCode;
                $currency->nominal = $valute->Nominal;
                $currency->name = $valute->Name;
                $currency->rate = str_replace(',', '.', $valute->Value);
                $currency->insert();
            }
        }
    }
}
