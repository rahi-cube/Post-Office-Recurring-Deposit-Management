<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $contact_no
 * @property string $email
 * @property string $date_of_birth
 * @property string $signature
 * @property string $date_registered
 * @property string $field1
 * @property string $field2
 * @property string $field3
 * @property string $field4
 * @property string $field5
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city', 'contact_no', 'email', 'date_of_birth', 'signature'], 'required'],
            [['date_of_birth', 'date_registered'], 'safe'],
            [['signature'], 'safe'],
			[['signature'], 'file'],
            [['name', 'field1', 'field2', 'field3', 'field4', 'field5'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 40],
            [['contact_no'], 'string', 'max' => 10],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'city' => 'City',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'date_of_birth' => 'Date Of Birth',
            'signature' => 'Signature',
            'date_registered' => 'Date Registered',
            'field1' => 'Field1',
            'field2' => 'Field2',
            'field3' => 'Field3',
            'field4' => 'Field4',
            'field5' => 'Field5',
        ];
    }
	
	public function getContact($id)
	{
		$model = Customers::findOne($id);
		return $model->name;
	}
	
}
