<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chart_data".
 *
 * @property string $id
 * @property integer $chart_id
 * @property double $y_value
 * @property double $x_value
 *
 * @property UserCharts $chart
 */
class ChartData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chart_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['y_value', 'x_value'], 'required'],
            [['chart_id'], 'integer'],
            [['y_value', 'x_value'], 'number'],
            [['chart_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCharts::className(), 'targetAttribute' => ['chart_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chart_id' => 'Chart ID',
            'y_value' => 'Y Value',
            'x_value' => 'X Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChart()
    {
        return $this->hasOne(UserCharts::className(), ['id' => 'chart_id']);
    }
}
