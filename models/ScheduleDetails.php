<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule_details".
 *
 * @property integer $id
 * @property integer $schedule_id
 * @property integer $account_no
 * @property string $last_trans_date
 * @property string $balance
 * @property string $field1
 * @property string $field2
 * @property string $field3
 */
class ScheduleDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schedule_id', 'account_no', 'last_trans_date', 'balance'], 'required'],
            [['schedule_id', 'account_no'], 'integer'],
            [['last_trans_date'], 'safe'],
            [['balance'], 'string', 'max' => 15],
            [['field1', 'field2', 'field3'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schedule_id' => 'Schedule ID',
            'account_no' => 'Account No',
            'last_trans_date' => 'Last Trans Date',
            'balance' => 'Balance',
            'field1' => 'Field1',
            'field2' => 'Field2',
            'field3' => 'Field3',
        ];
    }
}
