<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type_id
 * @property int|null $brand_id
 * @property float|null $quantity
 * @property string|null $properties
 * @property float|null $r_price
 *
 * @property Brand $brand
 * @property ProductType $type
 * @property Received[] $receiveds
 * @property Sold[] $solds
 * @property Measurement[] $measurement
 */
class Product extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'name', 'brand_id'], 'required'],
            [['measurement_id','type_id', 'brand_id', 'status'], 'integer'],
            [['quantity', 'r_price'], 'number'],
            [['properties'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['measurement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Measurement::className(), 'targetAttribute' => ['measurement_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Name'),
            'type_id' => Yii::t('app', 'Product type'),
            'brand_id' => Yii::t('app', 'Brand'),
            'quantity' => Yii::t('app', 'Quantity'),
            'properties' => Yii::t('app', 'Properties'),
            'r_price' => Yii::t('app', 'Price'),
            'measurement_id' => Yii::t('app', 'Measurement'),
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Receiveds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveds()
    {
        return $this->hasMany(Received::className(), ['product_id' => 'id']);
    }

    public function getMeasurement()
    {
        return $this->hasOne(Measurement::className(), ['id' => 'measurement_id']);
    }

    /**
     * Gets query for [[Solds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolds()
    {
        return $this->hasMany(Sold::className(), ['product_id' => 'id']);
    }

    public static function getProductAll(){
        $sql = "SELECT product.id, concat(product.name, ' / ', b.name) as name FROM product
                    LEFT JOIN brand b on b.id = product.brand_id";
        $product = Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::map($product, 'id', 'name');
    }
}
