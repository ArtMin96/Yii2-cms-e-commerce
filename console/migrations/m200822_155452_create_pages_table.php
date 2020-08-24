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
            'alias' => $this->string()->notNull(),
            'type' => $this->string()->notNull()->defaultValue('_link'),
            'parent_id' => $this->integer()->null(),
            'order_sort' => $this->integer()->null(),
            'deleted' => $this->boolean()->defaultValue(0),
            'allow_delete' => $this->boolean()->defaultValue(0),
            'allow_parent' => $this->boolean()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk-page_parent_id', '{{%pages}}', 'parent_id', '{{%pages}}', 'id');

        $this->batchInsert('{{%pages}}', ['name', 'alias', 'type', 'parent_id', 'order_sort', 'allow_parent'], [
            [
                'name' => 'Home',
                'alias' => '/',
                'type' => '_link',
                'parent_id' => null,
                'order_sort' => 0,
                'allow_parent' => 0,
            ],
            [
                'name' => 'Services',
                'alias' => '#',
                'type' => '_text',
                'parent_id' => null,
                'order_sort' => 1,
                'allow_parent' => 1,
            ],
            [
                'name' => 'Translation services',
                'alias' => '#',
                'type' => '_text',
                'parent_id' => 2,
                'order_sort' => 0,
                'allow_parent' => 1,
            ],
            [
                'name' => 'Certified translation',
                'alias' => '#',
                'type' => '_text',
                'parent_id' => 2,
                'order_sort' => 1,
                'allow_parent' => 1,
            ],
            [
                'name' => 'Legal Translation Services',
                'alias' => '/legal-translation-services',
                'type' => '_link',
                'parent_id' => 3,
                'order_sort' => 0,
                'allow_parent' => 0,
            ],
            [
                'name' => 'Medical Translations',
                'alias' => '/medical-translations',
                'type' => '_link',
                'parent_id' => 3,
                'order_sort' => 1,
                'allow_parent' => 0,
            ],
        ]);
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
