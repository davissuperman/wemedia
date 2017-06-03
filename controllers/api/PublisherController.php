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
     *   tags={"publisher"},
     * description="取得所有发布的任务",
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
     *   summary="根据ID获取任务详情" ,
     * tags={"publisher"},
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
     *   summary="创建一个新的任务",
     * @SWG\Parameter(
     * name="fromurl",in="path",description=" 外部链接",required=true,type="string"
      * ),
     * @SWG\Parameter(
     *       name="title",
     *       in="path",
     *       description="标题",
     *       required=true,
     *       type="string",
     *     ),
     *    * @SWG\Parameter(
     *       name="readmax",
     *       in="path",
     *       description="文章阅读量",
     *       required=true,
     *       type="integer",
     *     ),
     *  *    * @SWG\Parameter(
     *       name="starttime",
     *       in="path",
     *       description="开始时间",
     *       required=false,
     *       type="string",
     *     ),
     *  *    * @SWG\Parameter(
     *       name="endtime",
     *       in="path",
     *       description="结束时间",
     *       required=false,
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
