<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sold".
 *
 * @property int $id
 * @property string|null $date
 * @property float|null $quantity
 * @property float|null $s_price
 * @property int|null $seller_id
 * @property int|null $product_id
 *
 * @property Product $product
 * @property Users $seller
 */
class Sold extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sold';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        parent::rules();
        return [
            [['date'], 'safe'],
            [['quantity', 's_price'], 'number'],
            [['seller_id', 'product_id', 'status'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'quantity' => 'Quantity',
            's_price' => 'S Price',
            'seller_id' => 'Seller ID',
            'product_id' => 'Product ID',
        ];
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
     * Gets query for [[Seller]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Users::className(), ['id' => 'seller_id']);
    }
}
