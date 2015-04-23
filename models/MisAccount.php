<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mis_account".
 *
 * @property integer $account
 * @property integer $contact_1
 * @property integer $contact_2
 * @property integer $contact_3
 * @property string $kyc
 * @property string $payment_type
 * @property double $amount
 * @property integer $cheque_no
 * @property string $date_taken
 * @property string $register_date
 * @property integer $term
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property string $field1
 * @property string $field2
 */
class MisAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mis_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'contact_1', 'kyc', 'payment_type', 'amount', 'date_taken', 'term', 'start_date', 'end_date', 'status'], 'required'],
            [['account', 'contact_1', 'contact_2', 'contact_3', 'cheque_no', 'term', 'status'], 'integer'],
            [['amount'], 'number'],
            [['date_taken', 'register_date', 'start_date', 'end_date'], 'safe'],
            [['kyc'], 'string', 'max' => 30],
            [['payment_type'], 'string', 'max' => 10], 
			[['cheque_no'], 'required', 'when' => function ($model) {
					return $model->payment_type == 'cheque';
				},'whenClient' => "function (attribute, value) {
					return $('input[name=\"MisAccount[payment_type]\"]').val() == 'cheque';
				}"
				
			],           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account' => 'Account No',
            'contact_1' => 'Contact 1',
            'contact_2' => 'Contact 2',
            'contact_3' => 'Contact 3',
            'kyc' => 'Kyc',
            'payment_type' => 'Payment Type',
            'amount' => 'Amount',
            'cheque_no' => 'Cheque No',
            'date_taken' => 'Date Taken',
            'register_date' => 'Register Date',
            'term' => 'Term',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'field1' => 'Field1',
            'field2' => 'Field2',
        ];
    }
}
