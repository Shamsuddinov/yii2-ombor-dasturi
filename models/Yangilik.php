<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yangilik".
 *
 * @property int $id
 * @property string $nomi
 * @property string $matni
 */
class Yangilik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yangilik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomi', 'matni'], 'required'],
            [['matni'], 'string'],
            [['nomi'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomi' => 'Nomi',
            'matni' => 'Matni',
        ];
    }
}
