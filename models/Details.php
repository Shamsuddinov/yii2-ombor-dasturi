<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "details".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $contragent_id
 * @property float|null $sum
 *
 * @property Contragent $contragent
 * @property Received[] $receiveds
 */
class Details extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        parent::rules();
        return [
            [['date'], 'safe'],
            [['contragent_id', 'status'], 'integer'],
            [['sum'], 'number'],
            [['contragent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contragent::className(), 'targetAttribute' => ['contragent_id' => 'id']],
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
            'contragent_id' => 'Contragent ID',
            'sum' => 'Sum',
        ];
    }

    /**
     * Gets query for [[Contragent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContragent()
    {
        return $this->hasOne(Contragent::className(), ['id' => 'contragent_id']);
    }

    /**
     * Gets query for [[Receiveds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveds()
    {
        return $this->hasMany(Received::className(), ['details_id' => 'id']);
    }
    static function getItemsAsArray(){
        return Details::find()
            ->select('date, id')
            ->indexBy('id')
            ->column();
    }
}
