<?php

namespace app\models;

use app\components\{AppHtmlentitiesBehavior, AppUserSexBehavior};
use phpDocumentor\Reflection\Types\Static_;
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

    const SEX_NULL = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

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
            [['login', 'password', 'name', 'last_name', 'sex', 'email'], 'required'],
            [['name', 'last_name', 'email'], 'trim'],
            [['name', 'last_name'], 'filter', 'filter' => function($value) {
                return ucfirst($value);
            }],
            [['sex'], 'integer'],
            [['created_ad'], 'safe'],
            [['name', 'last_name', 'email'], 'string', 'max' => 255],
            [['login', 'email'], 'unique'],
            [['email'], 'email'],
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

        $this->is_active = static::IS_DISABLE;
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
}
