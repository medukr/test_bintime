<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $last_name
 * @property int $sex
 * @property string $created_ad
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'name', 'last_name', 'sex', 'created_ad', 'email'], 'required'],
            [['sex'], 'integer'],
            [['created_ad'], 'safe'],
            [['login', 'password', 'name', 'last_name', 'email'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['email'], 'unique'],
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_ad'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_ad']
                ],
                'value' => new  Expression('NOW()')
            ]
        ];
    }

    public function getAddress(){
        return $this->hasMany(Address::class, ['user_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'sex' => 'Sex',
            'created_ad' => 'Created Ad',
            'email' => 'Email',
        ];
    }
}
