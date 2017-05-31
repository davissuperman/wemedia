<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publisher".
 *
 * @property integer $id
 * @property string $fromurl
 * @property string $title
 * @property integer $readmax
 * @property string $starttime
 * @property string $endtime
 * @property string $createtime
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publisher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromurl', 'title', 'readmax'], 'required'],
            [['readmax'], 'integer'],
            [['starttime', 'endtime', 'createtime'], 'safe'],
            [['fromurl'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fromurl' => 'Fromurl',
            'title' => 'Title',
            'readmax' => 'Readmax',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'createtime' => 'Createtime',
        ];
    }
}
