<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>
    <?php
    /*echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            'modules/exporting', // adds Exporting button/menu to chart
            'themes/dark-unica'        // applies global 'grid' theme to all charts
        ],
        'options' => [
            'chart' => ['polar' => true, 'type' => 'column'],
            'title' => ['text' => 'Fruit Consumption'],
            'xAxis' => [

                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            ],
            'series' => [
                [ 
                    'name' => 'Jane', 'data' => [29.9, 71.5, 106.4, 129.2, 144.0,
                        176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]],
                [ 
                    'name' => 'John', 'data' => [39.9, 51.5, 136.4, 119.2, 124.0,
                        176.0, 139.6, 128.5, 246.4, 164.1, 195.6, 34.4]],
            ]
        ]
    ]);*/
    ?>

    <code><?= __FILE__ ?></code>
</div>
