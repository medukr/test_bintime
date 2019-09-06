<?php

namespace app\models;

use app\components\{AppHtmlentitiesBehavior, AppUserSexBehavior, AppDateFormatterBehaviour};
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
 * @property int $is_active
 */
class Users extends \yii\db\ActiveRecord
{

    const IS_ENABLE = 1;
    const IS_DISABLE = 0;

    const USER_SEX = [
        0 => 'Нет информации',
        1 => 'Мужской',
        2 => 'Женский'
    ];

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
        return array_merge(
            self::getFormRules(),
            [
                [['name', 'last_name'], 'filter', 'filter' => function($value) {
                    return ucfirst($value);
                }],
                [['created_ad'], 'safe'],
                [['login', 'email'], 'unique']
            ]);

    }

    public static function getFormRules(){
        return [
            [['login', 'password', 'name', 'last_name', 'sex', 'email'], 'required'],
            [['name', 'last_name', 'email'], 'trim'],
            [['sex'], 'integer'],
            [['email'], 'email'],
            [['name', 'last_name', 'email'], 'string', 'max' => 255],
            [['login'], 'string', 'length' => [4, 255]],
            [['password'], 'string', 'length' => [6, 255]]
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
            ],
            [
                'class' => AppHtmlentitiesBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['name', 'last_name'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['name', 'last_name'],
                    ActiveRecord::EVENT_AFTER_FIND => ['name', 'last_name'],
                ],
            ],
            [
                'class' => AppUserSexBehavior::class,
                'attributes' => (function () {
                    return Yii::$app->requestedAction->id !== 'update' && Yii::$app->requestedAction->id !== 'create'
                        ? [ActiveRecord::EVENT_AFTER_FIND => ['sex']]
                        : [];
                })()
            ],
            [
                'class' => AppDateFormatterBehaviour::class,
                'attributes' => [ ActiveRecord::EVENT_AFTER_FIND => ['created_ad']]
            ]

        ];
    }

    public function getAddress()
    {
        return $this->hasMany(Address::class, ['user_id' => 'id']);
    }


    public static function findWithAddress($id)
    {
        return self::find()
            ->where('id = :id', [':id' => $id])
            ->with('address')
            ->one();
    }

    public function disable()
    {

        $this->is_active = self::IS_DISABLE;
        return $this->save();
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => 'ID',
        ],
        static::getFormAttributes());
    }

    public static function getFormAttributes(){
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'sex' => 'Пол',
            'created_ad' => 'Дата добавления',
            'email' => 'Email',
        ];
    }

    public function getUserSexConstant(){
        return self::USER_SEX;
    }

}
