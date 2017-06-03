<?php
namespace app\controllers\api;

use Yii;
use app\models\Publisher;
 use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

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
     *     title="Diandian API",
     *     version="1.0.0"
     *   )
     * )
     */
    public function actionTest(){
        echo json_encode(array('aa'));
    }
    /*
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }
*/
    public function actions()
    {
        $actions = parent::actions();
        // 注销系统自带的实现方法
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
        return $actions;
    }
    /**
     * @SWG\Get(
     *   path="http://47.92.111.169/wemedia/web/api/publisher/index",
     *   summary="list publisher",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with publisher"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function actionIndex()
    {
        $modelClass = $this->modelClass;
        $query = $modelClass::find();
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
    /**
     * @SWG\Get(
     *   path="http://47.92.111.169/wemedia/web/api/publisher/view?id=XXX",
     *   summary="view publisher detail" ,
     *   @SWG\Response(
     *     response=200,
     *     description=" publisher detail info"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }
    protected function findModel($id)
    {
        $modelClass = $this->modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * @SWG\Post(
     *   path="http://47.92.111.169/wemedia/web/api/publisher/create",
     *   summary="create a new publisher",
     * @SWG\Parameter(
     * name="fromurl",in="path",description=" from url",required=true,type="string"
      * ),
     * @SWG\Parameter(
     *       name="title",
     *       in="path",
     *       description="biaoti",
     *       required=true,
     *       type="string",
     *     ),
     *    * @SWG\Parameter(
     *       name="readmax",
     *       in="path",
     *       description="read max",
     *       required=true,
     *       type="integer",
     *     ),
     *  *    * @SWG\Parameter(
     *       name="starttime",
     *       in="path",
     *       description="start time format should be yyyy-m-d h:i:s",
     *       required=true,
     *       type="string",
     *     ),
     *  *    * @SWG\Parameter(
     *       name="endtime",
     *       in="path",
     *       description="end time format should be yyyy-m-d h:i:s",
     *       required=true,
     *       type="string",
     *     ),
     *   @SWG\Response(
     *     response=200,
     *     description="new publisher info"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function actionCreate()
    {
        $model = new $this->modelClass();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if (!$model->save()) {
            return array_values($model->getFirstErrors())[0];
        }
        return $model;
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if (!$model->save()) {
            return array_values($model->getFirstErrors())[0];
        }
        return $model;
    }
    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }
}
