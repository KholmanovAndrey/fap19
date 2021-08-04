<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transport_company}}`.
 */
class m210804_041115_create_transport_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transport_company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'title' => $this->string()->unique()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transport_company}}');
    }
}
