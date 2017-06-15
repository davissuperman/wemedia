<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
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
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public static function tableName()
    {
        return '{{%users}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }
    /**
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['openid', 'fund', 'nickname', 'telephone', 'sex', 'age', 'industry', 'position', 'hobbies', 'habits', 'residence', 'trip', 'educational', 'marital'], 'required'],
            [['fund', 'sex'], 'integer'],
            [['birthday'], 'safe'],
            [['openid'], 'string', 'max' => 50],
            [['nickname'], 'string', 'max' => 100],
            [['telephone', 'age', 'industry', 'hobbies', 'habits', 'residence', 'trip', 'marital'], 'string', 'max' => 20],
            [['position', 'educational'], 'string', 'max' => 10],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */

}
