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

    const USER_MODEL_NAME = Users::class;
    const ADDRESS_MODEL_NAME = Address::class;

    private $_user;
    private $_address;

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
        return array_merge(
            (self::USER_MODEL_NAME)::getFormRules(),
            (self::ADDRESS_MODEL_NAME)::getFormRules(),
            [
                [['login','email'], 'validateUniqueUsers'],

            ]

        );

    }

    public function validateUniqueUsers($attribute, $params, $obj)
    {
        $model = $this->getUserModel();
        $model->$attribute = $this->$attribute;

        if (!$model->validate($attribute)) {
            $this->addError($attribute, 'Неверный логин или email.');
        }

    }


    public function create(){
        if ($this->validate()){
            $user = $this->getUserModel();
            $address = $this->getAddressModel();

            $user->login = $this->login;
            $user->setPassword($this->password);
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
                        //А что если не сохранит, а пользователь уже сохранен,нужна транзакция?;
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
        return array_merge(
            (self::USER_MODEL_NAME)::getFormAttributes(),
            (self::ADDRESS_MODEL_NAME)::getFormAttributes());
    }

    public function getUserModel(){
        if ($this->_user === null) {
            $model_name = self::USER_MODEL_NAME;
            $this->_user = new $model_name();
        }

        return $this->_user;
    }

    public function getAddressModel(){
        if ($this->_address === null) {
            $model_name = self::ADDRESS_MODEL_NAME;
            $this->_address = new $model_name() ;
        }

        return $this->_address;
    }


}