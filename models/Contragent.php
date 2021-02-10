<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contragent".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Details[] $details
 */
class Contragent extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contragent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Details]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Details::className(), ['contragent_id' => 'id']);
    }
    public static function getContragentList(){
        return Contragent::find()
            ->select('name, id')
            ->indexBy('id')
            ->column();
    }

    /**
     * @return array
     */
    public static function getContragentAll(){
        return ArrayHelper::map(Contragent::find()->asArray()->all(), 'id', 'name');
    }

}
