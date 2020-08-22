<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m200822_155452_create_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'parent_id' => $this->integer()->null(),
            'order_sort' => $this->integer()->null(),
            'deleted' => $this->boolean()->defaultValue(0),
            'allow_delete' => $this->boolean()->defaultValue(0),
            'allow_parent' => $this->boolean()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk-page_parent_id', '{{%pages}}', 'parent_id', '{{%pages}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages}}');
        $this->dropForeignKey('fk-page_parent_id', '{{%pages}}');
    }
}
