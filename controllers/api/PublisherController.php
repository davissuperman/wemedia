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
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Publisher';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    /**
     * @SWG\Swagger(
     *   @SWG\Info(
     *     title="My first swagger documented API",
     *     version="1.0.0"
     *   )
     * )
     */
    public function actionTest(){
        echo json_encode(array('aa'));
    }

}
