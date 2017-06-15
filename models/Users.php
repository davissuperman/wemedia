<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $openid
 * @property integer $fund
 * @property string $nickname
 * @property string $telephone
 * @property string $birthday
 * @property integer $sex
 * @property string $age
 * @property string $industry
 * @property string $position
 * @property string $hobbies
 * @property string $habits
 * @property string $residence
 * @property string $trip
 * @property string $educational
 * @property string $marital
 * @property string $auth_key
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fund', 'sex', 'status'], 'integer'],
            [['telephone', 'status'], 'required'],
            [['birthday'], 'safe'],
            [['openid'], 'string', 'max' => 50],
            [['nickname'], 'string', 'max' => 100],
            [['telephone', 'age', 'industry', 'hobbies', 'habits', 'residence', 'trip', 'marital'], 'string', 'max' => 20],
            [['position', 'educational'], 'string', 'max' => 10],
            [['auth_key'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'fund' => 'Fund',
            'nickname' => 'Nickname',
            'telephone' => 'Telephone',
            'birthday' => 'Birthday',
            'sex' => 'Sex',
            'age' => 'Age',
            'industry' => 'Industry',
            'position' => 'Position',
            'hobbies' => 'Hobbies',
            'habits' => 'Habits',
            'residence' => 'Residence',
            'trip' => 'Trip',
            'educational' => 'Educational',
            'marital' => 'Marital',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
        ];
    }
}
