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
        //Свич позволит легко расширить количество ивентов, без необходимости переписывать весь метод
        switch ($event) {
            case BaseActiveRecord::EVENT_AFTER_FIND :
                $value = (function () use ($attribute){
                    foreach (Users::USER_SEX as $key => $item) {
                        if ($key === $attribute) return $item;
                    }
                    return null;
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