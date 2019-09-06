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
        return array_merge(
            self::getFormRules(),
            [
                ['user_id', 'required'],
                ['user_id', 'integer'],
                [['country'], 'filter', 'filter' => function ($value) {
                    return mb_strtoupper($value, "UTF-8");
                }
                ],
                [['city', 'street'], 'filter', 'filter' => function ($value) {
                    return mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
                }],
            ]
        );
    }

    public static function getFormRules(){
        return [
            [['post_index', 'country', 'city', 'street', 'house'], 'required'],
            [['post_index'], 'string', 'max' => 5],
            [['post_index','office'], 'integer'],
            [['country'], 'string', 'max' => 2],
            [['city', 'street', 'house'], 'string', 'max' => 255],
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
            self::getFormAttributes()
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
