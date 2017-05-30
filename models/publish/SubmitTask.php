<?php
namespace app\models\publish;
use yii\base\Model;
class SubmitTask extends Model
{
    public $fromUrl;
    public $readMax;
    public $startTime;
    public $endTime;

    public function rules()
    {
        return [
            [['fromUrl', 'readMax'], 'required'],
            [['startTime','endTime'], 'date', 'format' => 'yyyy-M-d H:m:s'],
        ];
    }
}