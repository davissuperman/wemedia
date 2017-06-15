<?php
namespace app\controllers\api;

use Yii;
use app\models\Users;
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
    public $modelClass = 'app\models\Users';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
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
    public function actionTest(){
        echo json_encode(array('aa'));
    }



    /**
     * @SWG\Post(
     *   path="http://47.92.111.169/wemedia/web/api/users/bindOpenid",
     *   summary="绑定OPENID",
     *  tags={"用户登录相关"},
     *   @SWG\Parameter(
     *       name="telephone",
     *       in="path",
     *       description="用户手机号码",
     *       required=true,
     *       type="integer",
     *     ),
     *  *   @SWG\Parameter(
     *       name="code",
     *       in="path",
     *       description="验证码",
     *       required=true,
     *       type="integer",
     *     ),
     *  @SWG\Response(
     *     response="default",
     *     description="返回每次请求需要带上的TOKEN"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="返回JSON字符串 {token:XXXX,uid:XXX}"
     *   ),
     * @SWG\Response(
     *     response=201,
     *     description="手机号,验证码不能为空"
     *   ),
     *  @SWG\Response(
     *     response=202,
     *     description="验证码不一致，请重新发送"
     *   )

     * )
     */
    public function actionBindOpenid(){

    }

}
