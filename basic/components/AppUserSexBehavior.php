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
                        case Users::SEX_NULL: return 'Нет информации';
                        case Users::SEX_MAN: return 'Мужской';
                        case Users::SEX_WOMAN : return 'Женский';
                        default: return 'нет информации';
                    }
                })();
                break;
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

}