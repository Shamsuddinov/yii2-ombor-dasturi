<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $sur_name
 * @property string|null $username
 * @property string|null $password
 * @property int|null $department_id
 * @property Department[] $department
 * @property Received[] $receiveds
 * @property Sold[] $solds
 */
class Users extends BaseModel implements IdentityInterface
{
    public $rules;
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
            [['username'], 'string', 'max' => 30],
            [['accessToken'], 'string'],
            [['password', 'authKey'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['status', 'department_id'], 'integer'],
            ['rules', 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'Firstname'),
            'sur_name' => Yii::t('app', 'Surname'),
            'username' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'rules' => Yii::t('app', 'Rules'),
            'department_id' => Yii::t('app', 'Department'),
        ];
    }
    public function getUserRules()
    {
        return $this->hasMany(AuthAssignment::className(), ['id' => 'user_id']);
    }

    public static function getAllUsers(): array
    {
        return ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username');
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

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if(static::findOne(['username' => $username])){
            return static::findOne(['username' => $username]);
        }
        return null;
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

}
