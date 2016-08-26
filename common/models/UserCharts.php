<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_charts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $title_x
 * @property string $title_y
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ChartData[] $chartDatas
 * @property User $user
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
            [['user_id', 'url', 'title', 'created_at'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['url', 'title', 'title_x', 'title_y'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'url' => 'Url',
            'title' => 'Title',
            'description' => 'Description',
            'title_x' => 'Title X',
            'title_y' => 'Title Y',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
