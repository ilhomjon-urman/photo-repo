<?php

use yii\db\Migration;

class m220624_232829_create_table_photo_album extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%photo_album}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(250)->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%photo_album}}');
    }
}
