<?php
namespace app\models;
use app\components\behaviors\CustomBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class BaseModel extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETED = 3;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
            [
                'class' => CustomBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],

            ],
        ];
    }
    public function rules()
    {
        return [
            [['created_by','created_at','updated_by','updated_at'], 'integer']
        ]; // TODO: Change the autogenerated stub
    }
    static function getModelAsArray($model, $from = 'id', $to= 'name', $arr = []){
        if(empty($arr)){
            return ArrayHelper::map($model::find()->asArray()->all(), $from, $to);
        } else{
            return ArrayHelper::map($model::find()->where($arr)->asArray()->all(), $from, $to);
        }
    }
    public static function getResult($responseType = true)
    {
        if($responseType){
            $result['status'] = 'true';
            $result['saved_one'] = \Yii::t('app', 'Successfully!');
            $result['saved'] = \Yii::t('app', 'Item successfully deleted!');
        } else{
            $result['status'] = 'false';
            $result['error_one'] = \Yii::t('app', 'Unsuccessful!');
            $result['error'] = \Yii::t('app', 'You can not delete this item, because some items used it!');
        }
        return $result;
    }
    public static  function getErrorsMessage($type = true, $message = 'added'){
        $session = \Yii::$app->session;
        if($type){
            $session->setFlash('success', \Yii::t('app', "Successfully $message!"));
        } else {
            $session->setFlash('danger', \Yii::t('app', 'Please check all items, because there are some mistakes.'));
        }
    }
}