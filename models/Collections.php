<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "collections".
 *
 * @property integer $id
 * @property string $account_id
 * @property integer $month
 * @property integer $year
 * @property string $inst_month
 * @property string $receive_date
 * @property integer $ispaid
 * @property string $field1
 * @property string $field2
 *
 * @property RdAccounts $account
 */
class Collections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'month', 'year', 'inst_month', 'ispaid'], 'required'],
            [['account_id', 'month', 'year', 'ispaid'], 'integer'],
            [['inst_month', 'receive_date'], 'safe'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'month' => 'Month',
            'year' => 'Year',
            'inst_month' => 'Instalment Month',
            'receive_date' => 'Receive Date',
            'ispaid' => 'Ispaid',
            'field1' => 'Field1',
            'field2' => 'Field2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(RdAccounts::className(), ['account_no' => 'account_id']);
    }
}
