<?php
namespace app\controllers\api;

use Yii;
use app\models\Example;
 use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
 use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
class UsersController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Example';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actionTest(){
        echo json_encode(array('aa'));
    }
    public function behaviors() {
        return ArrayHelper::merge (parent::behaviors(), [
            'authenticator' => [
                'class' => QueryParamAuth::className()
            ]
        ] );
    }

    public function createUser(){
        $model = new Example();
//        $model->username=$name;
    }

}
