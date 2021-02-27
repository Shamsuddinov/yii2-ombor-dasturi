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
 * @property int|null $invoice_id
 * @property Product $product
 * @property Users $seller
 */
class Sold extends BaseModel
{
    public $tabular;
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
            [['date', 'tabular'], 'safe'],
            [['quantity', 's_price'], 'number'],
            [['seller_id', 'product_id', 'status', 'department_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'quantity' => Yii::t('app', 'Quantity'),
            's_price' => Yii::t('app', 'Price'),
            'seller_id' => Yii::t('app', 'Seller ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
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

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }
}
