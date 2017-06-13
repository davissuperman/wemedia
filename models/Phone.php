<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property integer $id
 * @property string $telephone
 * @property integer $code
 * @property string $createtime
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telephone', 'code'], 'required'],
            [['code'], 'integer'],
            [['createtime'], 'safe'],
            [['telephone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telephone' => 'Telephone',
            'code' => 'Code',
            'createtime' => 'Createtime',
        ];
    }
}
