<?php
namespace app\controllers;
use Yii;
use app\models\Example;
class ExampleController extends \yii\rest\Controller
{
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