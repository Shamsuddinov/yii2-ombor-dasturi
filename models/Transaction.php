<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $department_id
 * @property int|null $invoice_id
 * @property int|null $details_id
 * @property int $sum
 * @property int $inventory
 * @property int|null $type_id
 * @property string|null $transaction_date
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property Department $department
 * @property Details $details
 * @property Invoice $invoice
 * @property TransactionType $type
 */
class Transaction extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'sum', 'inventory', 'comment'], 'required'],
            [['department_id', 'invoice_id', 'details_id', 'sum', 'inventory', 'type_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['transaction_date', 'comment'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['details_id'], 'exist', 'skipOnError' => true, 'targetClass' => Details::className(), 'targetAttribute' => ['details_id' => 'id']],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_id' => Yii::t('app', 'Department ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'details_id' => Yii::t('app', 'Details ID'),
            'sum' => Yii::t('app', 'Sum'),
            'inventory' => Yii::t('app', 'Inventory'),
            'comment' => Yii::t('app', 'Comment'),
            'type_id' => Yii::t('app', 'Type ID'),
            'transaction_date' => Yii::t('app', 'Transaction Date'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
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

    /**
     * Gets query for [[Invoice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TransactionType::className(), ['id' => 'type_id']);
    }
}
