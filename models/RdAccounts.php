<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rd_accounts".
 *
 * @property string $account_no
 * @property integer $contact_1
 * @property integer $contact_2
 * @property string $deposit_amount
 * @property integer $term
 * @property string $kyc
 * @property integer $card_no
 * @property string $start_date
 * @property string $end_date
 * @property string $balance_in
 * @property string $balance_out
 * @property string $half_withdrawal
 * @property string $last_trans_date
 * @property string $date_registered
 * @property string $field1
 * @property string $field2
 * @property string $filed3
 * @property string $filed4
 * @property string $filed5
 */
class RdAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rd_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_no', 'contact_1', 'deposit_amount', 'term', 'kyc', 'card_no', 'start_date', 'end_date'], 'required'],
            [['account_no', 'contact_1', 'contact_2', 'deposit_amount', 'term', 'card_no'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['kyc'], 'string', 'max' => 25],    
			[['account_no'], 'unique', 'targetAttribute' => 'account_no'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_no' => 'Account No',
            'contact_1' => 'Contact 1',
            'contact_2' => 'Contact 2',
            'deposit_amount' => 'Deposit Amount',
            'term' => 'Term',
            'kyc' => 'KYC',
            'card_no' => 'Card No',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'balance_in' => 'Balance In',
            'balance_out' => 'Balance Out',
            'half_withdrawal' => 'Half Withdrawal',
            'last_trans_date' => 'Last Trans Date',
            'date_registered' => 'Date Registered',
            'field1' => 'Field1',
            'field2' => 'Field2',
            'filed3' => 'Filed3',
            'filed4' => 'Filed4',
            'filed5' => 'Filed5',
        ];
    }
}
