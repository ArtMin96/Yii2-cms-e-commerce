<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'phone' => $this->string()->null(),
            'username' => $this->string()->notNull()->unique(),
            'person_type' => $this->boolean()->defaultValue(true)->notNull()->comment('Physical person/true, Legal person/false'),
            'avatar' => $this->string()->null(),
            'company' => $this->string()->null(),
            'address' => $this->string()->null(),
            'contact_person' => $this->string()->null(),
            'tax_code' => $this->string()->null(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'email_verified' => $this->timestamp()->null(),
            'ip' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
