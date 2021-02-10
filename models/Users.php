<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $sur_name
 * @property string|null $login
 * @property string|null $password
 *
 * @property Received[] $receiveds
 * @property Sold[] $solds
 */
class Users extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        parent::rules();
        return [
            [['first_name'], 'required'],
            [['first_name', 'sur_name'], 'string', 'max' => 25],
            [['login'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 32],
            [['login'], 'unique'],
            ['status', 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'sur_name' => 'Sur Name',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Receiveds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveds()
    {
        return $this->hasMany(Received::className(), ['receiver_id' => 'id']);
    }

    /**
     * Gets query for [[Solds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolds()
    {
        return $this->hasMany(Sold::className(), ['seller_id' => 'id']);
    }
}
