<?php
namespace app\controllers;
use Yii;
use app\models\Example;
use yii\filters\auth\QueryParamAuth;
class ExampleController extends \yii\rest\Controller
{
    public $modelClass = 'app\models\Example';
    public function behaviors(){
        $behaviors= parent::behaviors();
        $behaviors['authenticator'] = [
        'class'=> QueryParamAuth::className(),
        ];
        return $behaviors;
    }
    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }
    public function actionIndex(){
        $examples = Example::find()->all();
        return [
            'data'=>$examples,
        ];
    }
}