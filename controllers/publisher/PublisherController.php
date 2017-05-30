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
            // ��֤ $model �յ�������

            // ��Щ��������� ...

            return $this->render('task-confirm', ['model' => $model]);
        } else {
            // �����ǳ�ʼ����ʾ����������֤����
            return $this->render('task', ['model' => $model]);
        }
    }
}
