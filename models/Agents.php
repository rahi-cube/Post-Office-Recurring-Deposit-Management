<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agents".
 *
 * @property integer $id
 * @property string $name
 * @property string $authority_no
 * @property string $validity_date
 * @property string $date_registered
 * @property string $field1
 * @property string $filed2
 * @property string $filed3
 */
class Agents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'authority_no', 'validity_date', 'date_registered', 'field1', 'filed2', 'filed3'], 'required'],
            [['validity_date', 'date_registered'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['authority_no'], 'string', 'max' => 30],
            [['field1', 'filed2', 'filed3'], 'string', 'max' => 255]
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
            'authority_no' => 'Authority No',
            'validity_date' => 'Validity Date',
            'date_registered' => 'Date Registered',
            'field1' => 'Field1',
            'filed2' => 'Filed2',
            'filed3' => 'Filed3',
        ];
    }
}
