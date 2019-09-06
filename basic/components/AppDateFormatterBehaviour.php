<?php
/**
 * Created by andrii
 * Date: 06.09.19
 * Time: 11:51
 */

namespace app\components;


use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class AppDateFormatterBehaviour extends Behavior
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
                $value = Yii::$app->formatter->asDate($attribute, 'dd-MM-Y hh:mm');
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