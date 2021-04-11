<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "received".
 *
 * @property int $id
 * @property int $receiver_id
 * @property int $product_id
 * @property float|null $quantity
 * @property float|null $r_price
 * @property int|null $details_id
 *
 * @property Details $details
 * @property Product $product
 * @property Users $receiver
 */
class Received extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'received';
    }

    /**
     * {@inheritdoc}
     *
     *
     * 
     */
    public function rules()
    {
//        parent::rules();
        return [
            [['receiver_id', 'product_id'], 'required'],
            [['receiver_id', 'product_id', 'details_id', 'status'], 'integer'],
            [['quantity', 'r_price'], 'number'],
            [['details_id'], 'exist', 'skipOnError' => true, 'targetClass' => Details::className(), 'targetAttribute' => ['details_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receiver_id' => 'Receiver ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'r_price' => 'R Price',
            'details_id' => 'Details ID',
        ];
    }

    public function getReceivedproducts(){
        return Received::find()
            ->select([
                'received.id',
                'received.details_id as d_id',
                'received.quantity',
                'received.r_price',
                'details.date',
                'details.contragent_id',
                'contragent.name as c_name',
                'product.name'])
            ->leftJoin('product', 'received.product_id=product.id')
            ->leftJoin('details', 'received.details_id=details.id')
            ->leftJoin('contragent', 'details.contragent_id=contragent.id')
            ->leftJoin('users', 'received.receiver_id=users.id')
            ->orderBy(['details.date' => SORT_DESC])->asArray()->all();
    }


    /**
     * Gets query for [[Details]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasOne(Details::className(), ['id' => 'details_id']);
    }

    public function getContragent(){
        return $this->hasOne(Contragent::className(), ['id' => 'details.contragent_id']);
    }
    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Receiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(Users::className(), ['id' => 'receiver_id']);
    }

    /**
     * @param $model - yangi ma'lumot
     * @param $data - eski ma'lumot
     */
    public static function updateData($model, $data){
        $saved = false;
        $transaction = Yii::$app->db->beginTransaction();
        try {
                $received = self::findOne($data->id);
                $received->setAttributes([
                    'r_price' => $model->price,
                    'product_id' => $model->product,
                    'quantity' => $model->quantity,
                    'receiver_id' => 1,
                    'status' => self::STATUS_ACTIVE,
                ]);
                if($received->save()) {
                    $saved = true;
                }
            if($saved){
                $transaction->commit();
            } else{
                $transaction->rollBack();
            }
        } catch (\Exception $e){
            $transaction->rollBack();
            $a = 'Yangilandi.';
        }
        return $saved;
    }
    public static function saveData($model){
        $saved = false;
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $details = new Details();
            $details->setAttributes([
                'date' => date('Y-m-d'),
                'contragent_id' => $model->contragent,
                'sum' => $model->sum
            ]);
            if($details->save()){
                $received = new self();
                $received->setAttributes([
                    'receiver_id' => 1,
                    'product_id' => $model->product,
                    'quantity' => $model->quantity,
                    'r_price' => $model->price,
                    'details_id' => $details->id,
                    'status' => self::STATUS_ACTIVE,
                ]);
                if($received->save()){
//                    $product = Product::findOne($model->product);
//                    $product->updateAttributes([
//                        'quantity' => $model->quantity + $product->quantity,
//                        'r_price' => $model->price
//                    ]);
//                    if($product->save()){
                        $saved = true;
//                    }
                }
            }
            if($saved){
                $transaction->commit();
            } else{
                $transaction->rollBack();
            }
        } catch (\Exception $error){
            $a = "Hello";
        }
        return $saved;
    }
}
