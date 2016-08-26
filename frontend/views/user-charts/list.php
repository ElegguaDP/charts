<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
?>
<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-stats"></i> Chart List</h4></div>
    <div class="panel-body">
        <? foreach ($charts as $chart) { ?>            
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?= Url::toRoute(['user-charts/view', 'link' => $chart->url]) ?>">Chart "<?= $chart->title ?>"</a>                        
                    </div>
                    <div class="pull-right">
                        <a href="<?= Url::toRoute(['user-charts/update', 'id' => $chart->id]) ?>"><button type="button" class="edit-item btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>