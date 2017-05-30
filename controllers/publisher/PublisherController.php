<?php
namespace app\controllers\publisher;
use Yii;
use app\models\Country;
use app\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\publish\SubmitTask;

class PublisherController extends  Controller{
    public function actionIndex(){
        echo 'aaa';
    }
    public function actionTask()
    {
        $model = new SubmitTask;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据

            // 做些有意义的事 ...

            return $this->render('task-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('task', ['model' => $model]);
        }
    }
}
