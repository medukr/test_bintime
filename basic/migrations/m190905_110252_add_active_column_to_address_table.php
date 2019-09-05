<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%address}}`.
 */
class m190905_110252_add_active_column_to_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('address', 'is_active', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('address', 'is_active');
    }
}
