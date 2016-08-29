<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_charts".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $group_id
 *
 * @property ChartData[] $chartDatas
 * @property ChartGroups $group
 */
class UserCharts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_charts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'group_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChartDatas()
    {
        return $this->hasMany(ChartData::className(), ['chart_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ChartGroups::className(), ['id' => 'group_id']);
    }
}
