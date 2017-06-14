<?php
namespace app\controllers\api;

use Yii;
use app\models\Telephone;
 use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
 use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
use Smsrest;
class TelephoneController extends ActiveController
{
    public $minuteToResend = 2;//间隔几分钟从新发送
    /**
     * @inheritdoc
     */
    public $modelClass = 'app\models\Telephone';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    /**
     * @SWG\Post(
     *   path="http://47.92.111.169/wemedia/web/api/telephone/sendsms",
     *   summary="获取验证码",
     *  tags={"用户登录相关"},
     *   * @SWG\Parameter(
     *       name="telephone",
     *       in="path",
     *       description="用户手机号码",
     *       required=true,
     *       type="integer",
     *     ),
     *  @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="返回JSON字符串 {code:XXXX}"
     *   ),
     * @SWG\Response(
     *     response=201,
     *     description="手机号不能为空"
     *   ),
     *  @SWG\Response(
     *     response=202,
     *     description="系统错误"
     *   )

     * )
     */
    public function actionSendsms(){
        $return = null;
        $telephone =  Yii::$app->request->post('telephone');
        if(!$telephone){
            echo  json_encode(array("code"=>201,'msg'=>'手机号不能为空'));
            return;
        }
        $number = null;

        $telephoneFind = Telephone::find()
            ->where(['telephone' => $telephone])
            ->one();
        if($telephoneFind){
            //update existed number 是否是两分钟
            $currentTime = time();
            $existed = $telephoneFind->createtime;
            if( ($currentTime-strtotime($existed) ) < $this->minuteToResend*60){
                //update with new number
                $number = rand(1000,9999);
                $telephoneFind->code = $number;
                $telephoneFind->save();
                $return =  json_encode(array("code"=>200,'code'=>$number));
            }else{
                //返回原来存在的
                $number = $telephoneFind->code;
                $return =   json_encode(array("code"=>200,'code'=>$telephoneFind->code));
            }
        }else{
            $number = rand(1000,9999);
            $model = new Telephone();
            $model->telephone = $telephone;
            $model->code = $number;
            if( $model->save() ){
                $return =   json_encode(array("code"=>200,'code'=>$number));
            }else{
                $return =   json_encode(array("code"=>202,'msg'=>'系统错误'));
            }
        }

        if($this->sendSms($telephone,array($number,$this->minuteToResend."分钟"),"111261") == 1){
            echo $return;
            return;
        }

    }
    /**
     * @SWG\Post(
     *   path="http://47.92.111.169/wemedia/web/api/telephone/login",
     *   summary="手机登录",
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
     *     description="an ""unexpected"" error"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="返回JSON字符串 {code:XXXX}"
     *   ),
     * @SWG\Response(
     *     response=201,
     *     description="手机号不能为空"
     *   ),
     *  @SWG\Response(
     *     response=202,
     *     description="系统错误"
     *   )

     * )
     */
    public function actionLogin(){
        $telephone =  Yii::$app->request->post('telephone');
        $code =  Yii::$app->request->post('code');
        if(!$telephone || !$code){
            $return = array(
                'code' => 201,
                'msg' => '手机号，验证码不能为空'
            );
            echo json_encode($return);
            return;
        }
    }


    function sendSms($to,$datas,$tempId)
    {
        $return = null;
        // 初始化REST SDK
        //主帐号
        $accountSid= '8a216da8566d11660156702508100377';

//主帐号Token
        $accountToken= 'c5fb0dc16c064310a602d7528d4b5c39';

//应用Id
        $appId='8a216da8567745c001567a2350ed0497';

//请求地址，格式如下，不需要写https://
        $serverIP='app.cloopen.com';

//请求端口
        $serverPort='8883';

//REST版本号
        $softVersion='2013-12-26';

        $rest = new \REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
//        echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            echo "result error!";
            return;
        }
        if($result->statusCode!=0) {
            echo "error code :" . $result->statusCode . "<br>";
            echo "error msg :" . $result->statusMsg . "<br>";
            //TODO 添加错误处理逻辑
        }else{
//            echo "Sendind TemplateSMS success!<br/>";
            // 获取返回信息
//            $smsmessage = $result->TemplateSMS;
//            echo "dateCreated:".$smsmessage->dateCreated."<br/>";
//            echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
            //TODO 添加成功处理逻辑
            $return = 1;
        }
        return $return;
    }
//    public function behaviors() {
//        return ArrayHelper::merge (parent::behaviors(), [
//            'authenticator' => [
//                'class' => QueryParamAuth::className()
//            ]
//        ] );
//    }

    public function createUser(){
        $model = new Example();
//        $model->username=$name;
    }

}
