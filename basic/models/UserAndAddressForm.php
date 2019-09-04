<?php
/**
 * Created by andrii
 * Date: 04.09.19
 * Time: 23:50
 */

namespace app\models;


use yii\base\Model;

class UserAndAddressForm extends Model
{

    public $user_id;

//User
    public $login;
    public $password;
    public $name;
    public $last_name;
    public $sex;
    public $email;

//Address
    public $post_index;
    public $country;
    public $city;
    public $street;
    public $house;
    public $office;


    public function rules()
    {
        return [
            //User
            [['login', 'password', 'name', 'last_name', 'sex', 'email'], 'required'],
            [['name', 'last_name', 'email'], 'trim'],
            [['sex'], 'integer'],

            [['name', 'last_name', 'email'], 'string', 'max' => 255],

            [['login'], 'string', 'length' => [4, 255]],
            [['login','email'], 'validateUniqueUsers'],
            [['password'], 'string', 'length' => [6, 255]],

            //Address
            [['post_index', 'country', 'city', 'street', 'house'], 'required'],
            [['user_id', 'office'], 'integer'],
            [['post_index'], 'string', 'max' => 5],
            [['country'], 'string', 'max' => 2],
            [['city', 'street', 'house'], 'string', 'max' => 255],
        ];
    }




    public function validateUniqueUsers($attribute, $params, $obj)
    {
        $model = new Users();
        $model->$attribute = $this->$attribute;

        if (!$model->validate($attribute)) {
            $this->addError($attribute, 'Неверный логин или email.');
        }


    }


    public function create(){
        if ($this->validate()){
            $user = new Users();
            $address = new Address();

            $user->login = $this->login;
            $user->password = $this->password;
            $user->name = $this->name;
            $user->last_name = $this->last_name;
            $user->sex = $this->sex;
            $user->email = $this->email;


            $address->user_id = 1;
            $address->post_index = $this->post_index;
            $address->country = $this->country;
            $address->city = $this->city;
            $address->street = $this->street;
            $address->house = $this->house;
            $address->office = $this->office;

            if ($user->validate()){
                if ($address->validate()) {
                    if ($user->save()) {
                        $address->user_id = $user->id;
                        $this->user_id = $user->id;
                        //А что если не сохранит, а пользователь уже сохранен;
                        if ($address->save()) {
                            return $this;
                        }

                    }
                }

            }
        }

        return false;
    }



    public function attributeLabels()
    {

    }


}