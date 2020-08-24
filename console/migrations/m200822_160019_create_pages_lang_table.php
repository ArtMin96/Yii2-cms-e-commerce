<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages_lang}}`.
 */
class m200822_160019_create_pages_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages_lang}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'language' => $this->string(2),
            'name' => $this->string(),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        $this->batchInsert('{{%pages_lang}}', ['parent_id', 'language', 'name'], [
            [
                'parent_id' => 1,
                'language' => 'en',
                'name' => 'Home',
            ],
            [
                'parent_id' => 1,
                'language' => 'ru',
                'name' => 'Главная',
            ],
            [
                'parent_id' => 1,
                'language' => 'ru',
                'name' => 'Գլխավոր',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages_lang}}');
    }
}
