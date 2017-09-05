<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $createDate
 * @property string $modityDate
 * @property string $lastVisitDate
 * @property integer $status
 * @property string $email
 *
 * @property Address[] $addresses
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'email'], 'required'],
            [['id', 'status'], 'integer'],
            [['createDate', 'modityDate', 'lastVisitDate'], 'safe'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 45],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'createDate' => 'Create Date',
            'modityDate' => 'Modity Date',
            'lastVisitDate' => 'Last Visit Date',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['userId' => 'id']);
    }
}
