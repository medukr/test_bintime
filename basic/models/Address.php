<?php

namespace app\models;

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
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_index', 'country', 'city', 'street', 'house'], 'required'],
            [['user_id', 'office'], 'integer'],
            [['post_index'], 'string', 'max' => 5],
            [['country'], 'string', 'max' => 2],
            [['city', 'street', 'house'], 'string', 'max' => 255],
        ];
    }

    public function getUser(){
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_index' => 'Post Index',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'house' => 'House',
            'office' => 'Office',
        ];
    }
}
