<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m210804_041752_add_transport_id_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'transport_id', $this->integer());

        $this->addForeignKey(
            'order_transport_id_foreign_key',
            '{{%order}}',
            'transport_id',
            '{{%transport_company}}',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'transport_id');
    }
}
