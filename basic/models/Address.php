<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $user_id
 * @property string $post_index
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $house
 * @property int $office
 * @property int $is_active
 */
class Address extends \yii\db\ActiveRecord
{
    const IS_ENABLE = 1;
    const IS_DISABLE = 0;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'address';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'post_index', 'country', 'city', 'street', 'house'], 'required'],
            [['user_id', 'office'], 'integer'],
            [['post_index'], 'string', 'max' => 5],
            [['post_index'], 'integer'],
            [['country'], 'string', 'max' => 2],
            [['city', 'street', 'house'], 'string', 'max' => 255],
            [['country'], 'filter', 'filter' => function ($value) {
                return strtoupper($value);}
            ],
            [['city', 'street'], 'filter', 'filter' => function($value){
                return ucfirst($value);
            }],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return bool
     */
    public function disable(){
       $this->is_active = static::IS_DISABLE;

       return $this->save();
    }


    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => 'ID',
            'user_id' => 'ID Пользователя',

        ],
            static::getFormAttributes()
        );
    }

    public static function getFormAttributes(){
        return [
            'post_index' => 'Почтовый индекс',
            'country' => 'Страна',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'office' => 'Оффис/Квартира',
        ];
    }
}
