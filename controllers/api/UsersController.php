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
//    public function behaviors(){
//        $behaviors= parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class'=> QueryParamAuth::className(),
//            'tokenParam' => 'token'
//        ];
//        return $behaviors;
//    }
    protected function verbs()
    {
        return [
            'index' => ['POST'],
        ];
    }
    public function actionTest(){
        echo json_encode(array('aa'));
    }



    /**
     * @SWG\Post(
     *   path="http://47.92.111.169/wemedia/web/api/users/wechatinfosave",
     *   summary="手机登录后，绑定微信",
     *  tags={"用户登录相关"},
     *   @SWG\Parameter(
     *       name="uid",
     *       in="path",
     *       description="用户手机登录后返回的UID",
     *       required=true,
     *       type="integer",
     *     ),
     *  *   @SWG\Parameter(
     *       name="token",
     *       in="path",
     *       description="用户手机登录后返回的TOKEN",
     *       required=true,
     *       type="string",
     *     ),
     *  *  *   @SWG\Parameter(
     *       name="nickname",
     *       in="path",
     *       description="微信返回的昵称",
     *       required=true,
     *       type="string",
     *     ),
     *  *  *  *   @SWG\Parameter(
     *       name="sex",
     *       in="path",
     *       description="微信返回的性别 1或者0",
     *       required=true,
     *       type="string",
     *     ),
     *  @SWG\Response(
     *     response="default",
     *     description="返回每次请求需要带上的TOKEN"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="绑定成功"
     *   ),
     * @SWG\Response(
     *     response=201,
     *     description="用户不存在"
     *   ),


     * )
     */
    public function actionWechatinfosave(){
        //绑定微信到登录的手机号
        /*
         * {
    "subscribe": 1,
    "openid": "oLVPpjqs2BhvzwPj5A-vTYAX4GLc",
    "nickname": "刺猬宝宝",
    "sex": 1,
    "language": "zh_CN",
    "city": "深圳",
    "province": "广东",
    "country": "中国",
    "headimgurl": "http://wx.qlogo.cn/mmopen/JcDicrZBlREhnNXZRudod9PmibRkIs5K2f1tUQ7lFjC63pYHaXGxNDgMzjGDEuvzYZbFOqtUXaxSdoZG6iane5ko9H30krIbzGv/0",
    "subscribe_time": 1386160805
}
         */
        $uid =  Yii::$app->request->post('uid');
        $openid =  Yii::$app->request->post('openid');
        $nickname =  Yii::$app->request->post('nickname');
        $sex =  Yii::$app->request->post('sex');

        $uid = 5;
        $openid= 'abcde';
        $nickname ='davis';
        $sex =1;
        $model = Users::find()->where(['id'=>$uid])->one();
//        echo $model->telephone;die;
        if($model){
            //save info
            $model->openid = $openid;
//            $model->nickname = $nickname;
//            $model->sex = $sex;
            $model->save();
            $return = array(
                'code' => 200,
                'msg' => '绑定成功'
            );
        }else{
            $return = array(
                'code' => 201,
                'msg' => "UID $uid 用户不存在"
            );
        }
        return $return;
    }

}
