<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contact}}`.
 */
class m210809_074252_add_columns_to_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contact}}', 'company', $this->string());
        $this->addColumn('{{%contact}}', 'ogrn', $this->string());
        $this->addColumn('{{%contact}}', 'inn', $this->string());
        $this->addColumn('{{%contact}}', 'postal', $this->string());
        $this->addColumn('{{%contact}}', 'legal_address', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%contact}}', 'company');
        $this->dropColumn('{{%contact}}', 'ogrn');
        $this->dropColumn('{{%contact}}', 'inn');
        $this->dropColumn('{{%contact}}', 'postal');
        $this->dropColumn('{{%contact}}', 'legal_address');
    }
}
