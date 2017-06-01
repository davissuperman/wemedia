<?php

namespace app\controllers\api;

use Yii;
use app\models\Publisher;
 use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * PublisherController implements the CRUD actions for Publisher model.
 */
class PublisherController extends ActiveController
{
    public $modelClass = 'app\models\Publisher';
    public function actionTest(){
        echo 'aaaaaaaaaa';
    }

}
