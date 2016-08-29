<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chart_groups".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $x_title
 * @property string $y_title
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $url
 *
 * @property User $user
 * @property UserCharts[] $userCharts
 */
class ChartGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chart_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'x_title', 'y_title', 'created_at', 'url'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['title', 'x_title', 'y_title', 'url'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'description' => 'Description',
            'x_title' => 'X Title',
            'y_title' => 'Y Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCharts()
    {
        return $this->hasMany(UserCharts::className(), ['group_id' => 'id']);
    }
}
