<?php
/**
 * Created by andrii
 * Date: 05.09.19
 * Time: 17:02
 */

namespace app\components;

use app\models\Users;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class AppUserSexBehavior extends Behavior
{

    public $attributes;


    public function events()
    {
        $events = [];
        foreach ($this->attributes as $key => $value) {
            $events[$key] = $key;
        }
        return $events;
    }

    public function getValue($attribute, $event)
    {
        switch ($event) {
            case BaseActiveRecord::EVENT_AFTER_FIND :
                $value = (function () use ($attribute){
                    switch ($attribute) {
                        case Users::SEX_MAN: return 'Мужской';
                        case Users::SEX_WOMAN : return 'Женский';
                        default: return 'не указано';
                    }
                })();
                break;
//            case BaseActiveRecord::EVENT_BEFORE_INSERT :
//                $value = htmlentities(trim($attribute), ENT_QUOTES, 'utf-8', false);
//                break;
//            case BaseActiveRecord::EVENT_BEFORE_UPDATE :
//                $value = htmlentities(trim($attribute), ENT_QUOTES, 'utf-8', false);
//                break;
            default:
                $value = false;
        }
        return $value;
    }

    public function afterFind()
    {
        foreach ($this->attributes[BaseActiveRecord::EVENT_AFTER_FIND] as $attribute) {
            $this->owner->$attribute = $this->getValue($this->owner->$attribute, BaseActiveRecord::EVENT_AFTER_FIND);
        }
    }

//    public function beforeUpdate()
//    {
//        foreach ($this->attributes[BaseActiveRecord::EVENT_BEFORE_UPDATE] as $attribute) {
//            $this->owner->$attribute = $this->getValue($this->owner->$attribute, BaseActiveRecord::EVENT_BEFORE_UPDATE);
//        }
//    }
//
//    public function beforeInsert()
//    {
//        foreach ($this->attributes[BaseActiveRecord::EVENT_BEFORE_INSERT] as $attribute) {
//            $this->owner->$attribute = $this->getValue($this->owner->$attribute, BaseActiveRecord::EVENT_BEFORE_INSERT);
//        }
//    }
}