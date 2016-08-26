<?php

namespace frontend\controllers;

use common\models\UserCharts;
use common\models\ChartData;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MultipleForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

class UserChartsController extends \yii\web\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create', 'update', 'view', 'list'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'create' => ['post'],
//                    'update' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionCreate() {
        $modelChart = new UserCharts;
        $modelChartData = [new ChartData()];

        if ($modelChart->load(Yii::$app->request->post())) {
            //chart-url create
            $modelChart->created_at = time();
            $urlLength = rand(6, 12);
            $modelChart->user_id = Yii::$app->user->id;
            $modelChart->url = Yii::$app->getSecurity()->generateRandomString($urlLength);
            
            $modelChartData = MultipleForm::createMultiple(ChartData::className());
            MultipleForm::loadMultiple($modelChartData, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelChartData),
                    ActiveForm::validate($modelChart)
                );
            }
            // validate all models            
            $valid = $modelChart->validate();
            $valid = MultipleForm::validateMultiple($modelChartData) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $flag = false;
                    if ($flag = $modelChart->save(false)) {
                        foreach ($modelChartData as $chartData) {
                            $chartData->chart_id = $modelChart->id;
                            if (!($flag = $chartData->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Chart successful created. Link to your chart is ' . $modelChart->url);
                        return $this->redirect(['view', 'link' => $modelChart->url]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
                    'chart' => $modelChart,
                    'chartData' => (empty($modelChartData)) ? [new ChartData] : $modelChartData
        ]);
    }

    public function actionUpdate($id) {
        $modelChart = UserCharts::find()->where('id = :id',[':id' => $id])->one();
        if ($modelChart && $modelChart->user_id == Yii::$app->user->id) {
            $modelChartData = $modelChart->chartDatas;

            if ($modelChart->load(Yii::$app->request->post())) {

                $oldIDs = ArrayHelper::map($modelChartData, 'id', 'id');
                $modelChartData = MultipleForm::createMultiple(ChartData::classname(), $modelChartData);
                MultipleForm::loadMultiple($modelChartData, Yii::$app->request->post());
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelChartData, 'id', 'id')));

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                                    ActiveForm::validateMultiple($modelChartData), ActiveForm::validate($modelChart)
                    );
                }

                // validate all models
                $modelChart->updated_at = time();
                $valid = $modelChart->validate();
                $valid = MultipleForm::validateMultiple($modelChartData) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $modelChart->save(false)) {
                            if (!empty($deletedIDs)) {
                                ChartData::deleteAll(['id' => $deletedIDs]);
                            }
                            foreach ($modelChartData as $chartData) {
                                $chartData->chart_id = $modelChart->id;
                                if (!($flag = $chartData->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            Yii::$app->session->setFlash('success', 'Chart successful updated');
                            return $this->redirect(['view', 'link' => $modelChart->url]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }

            return $this->render('update', [
                        'chart' => $modelChart,
                        'chartData' => (empty($modelChartData)) ? [new ChartData] : $modelChartData
            ]);
        }
    }

    public function actionView($link = null) {
        $model = UserCharts::find()->where('url = :link', [':link' => $link])->with('chartDatas')->one();
        if ($model) {
            return $this->render('view', ['model' => $model]);
        }
    }
    
    public function actionList(){
        $charts = UserCharts::find('user_id = :user_id', [':user_id' => Yii::$app->user->id])->all();
        return $this->render('list', ['charts' => $charts]);
    }

}
