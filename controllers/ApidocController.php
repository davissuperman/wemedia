<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\helpers\Url;


class ApidocController extends Controller
{
    public function actionIndex(){

        $b2broot = Yii::$app->basePath;
        $swagger = \Swagger\scan($b2broot.'/controllers');
        $json_file = $b2broot.'/swagger-docs/swagger.json';
        $is_write = file_put_contents($json_file, $swagger);
        if ($is_write == true) {
            $this->redirect(Url::to(['/swagger-ui/dist/index.html'])) ;
        }

    }
}
