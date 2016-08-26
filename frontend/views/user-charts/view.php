<?php
/* @var $this yii\web\View */

use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
?>
<h1><?= $model->title ?></h1>

<h3><?= Url::toRoute(['user-charts/view', 'link' => $model->url]) ?></h3>

<div class="chart">
    <?php
    $cats = [];
    $series = [];
    foreach ($model->chartDatas as $chartData) {
        $cats[] = $chartData->x_value;
        $series[] = $chartData->y_value;
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title pull-left">Polar Area Chart</h4>
            <div class="pull-right">
                <button type="button" class="add-item btn btn-success btn-xs" onclick="showChart('polararea')"><i class="glyphicon glyphicon-chevron-down"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body polararea">            
            <div class="row">
                <?
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                        'themes/dark-unica'        // applies global 'grid' theme to all charts
                    ],
                    'options' => [
                        'chart' => ['polar' => true, 'type' => 'area'],
                        'title' => ['text' => $model->title],
                        'xAxis' => [
                            'title' => ['text' => $model->title_x],
                            'categories' => $cats
                        ],
                        'series' => [
                            ['name' => $model->title_y, 'data' => $series]
                        ]
                    ]
                ]);
                ?>

            </div>
        </div>
        <div class="panel-heading">
            <h4 class="panel-title pull-left">Polar Column Chart</h4>
            <div class="pull-right">
                <button type="button" class="add-item btn btn-success btn-xs" onclick="showChart('polarcolumn')"><i class="glyphicon glyphicon-chevron-down"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body polarcolumn">            
            <div class="row">
                <?
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                        'themes/dark-unica'        // applies global 'grid' theme to all charts
                    ],
                    'options' => [
                        'chart' => ['polar' => true, 'type' => 'column'],
                        'title' => ['text' => $model->title],
                        'xAxis' => [
                            'title' => ['text' => $model->title_x],
                            'categories' => $cats
                        ],
                        'series' => [
                            ['name' => $model->title_y, 'data' => $series]
                        ]
                    ]
                ]);
                ?>

            </div>
        </div>
        <div class="panel-heading">
            <h4 class="panel-title pull-left">Line Chart</h4>
            <div class="pull-right">
                <button type="button" class="remove-item btn btn-success btn-xs" onclick="showChart('linechart')"><i class="glyphicon glyphicon-chevron-down"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body linechart">
            <div class="row">
                <?
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                        'themes/dark-unica'        // applies global 'grid' theme to all charts
                    ],
                    'options' => [
                        'title' => ['text' => $model->title],
                        'xAxis' => [
                            'title' => ['text' => $model->title_x],
                            'categories' => $cats
                        ],
                        'yAxis' => [
                            'title' => ['text' => $model->title_y]
                        ],
                        'series' => [
                            ['name' => $model->title_y, 'data' => $series]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="panel-heading">
            <h4 class="panel-title pull-left">Column Chart</h4>
            <div class="pull-right">
                <button type="button" class="remove-item btn btn-success btn-xs" onclick="showChart('columnchart')"><i class="glyphicon glyphicon-chevron-down"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body columnchart">
            <div class="row">
                <?
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                        'themes/dark-unica'        // applies global 'grid' theme to all charts
                    ],
                    'options' => [
                        'title' => ['text' => $model->title],
                        'chart' => ['polar' => false, 'type' => 'column'],
                        'xAxis' => [
                            'title' => ['text' => $model->title_x],
                            'categories' => $cats
                        ],
                        'yAxis' => [
                            'title' => ['text' => $model->title_y]
                        ],
                        'series' => [
                            ['name' => $model->title_y, 'data' => $series]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>