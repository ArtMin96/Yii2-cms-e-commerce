<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seo}}`.
 */
class m200824_200914_create_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seo}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer(),
            'meta_title' => $this->string()->null(),
            'meta_keywords' => $this->text()->null(),
            'meta_description' => $this->text()->null(),
            'meta_image' => $this->string()->null(),
            'og_title' => $this->string()->null(),
            'og_type' => $this->string()->null(),
            'og_url' => $this->string()->null(),
            'og_image' => $this->string()->null(),
            'og_description' => $this->text()->null(),
            'og_site_name' => $this->string()->null(),
            'fb_admins' => $this->string()->null(),
            'twitter_card' => $this->string()->null(),
            'twitter_site' => $this->string()->null(),
            'twitter_title' => $this->string()->null(),
            'twitter_description' => $this->text()->null(),
            'twitter_creator' => $this->string()->null(),
            'twitter_image' => $this->string()->null(),
        ]);

        $this->addForeignKey('fk-seo_page_id', '{{%seo}}', 'page_id', '{{%pages}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seo}}');
        $this->dropForeignKey('fk-seo_page_id', '{{%seo}}');
    }
}
