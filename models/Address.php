<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $street
 * @property string $zip
 * @property integer $stateId
 * @property string $createDate
 * @property string $modifyDate
 * @property integer $status
 * @property integer $userId
 * @property integer $cityId
 *
 * @property City $city
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'cityId'], 'required'],
            [['id', 'stateId', 'status', 'userId', 'cityId'], 'integer'],
            [['createDate', 'modifyDate'], 'safe'],
            [['street', 'zip'], 'string', 'max' => 45],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street' => 'Street',
            'zip' => 'Zip',
            'stateId' => 'State ID',
            'createDate' => 'Create Date',
            'modifyDate' => 'Modify Date',
            'status' => 'Status',
            'userId' => 'User ID',
            'cityId' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
