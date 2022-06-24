<?php

use yii\db\Migration;

class m220624_232830_create_table_photo_files extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%photo_files}}',
            [
                'id' => $this->primaryKey(),
                'album_id' => $this->integer()->notNull(),
                'original_name' => $this->string(1024)->notNull(),
                'changed_name' => $this->string(1024)->notNull(),
                'created_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('album_id', '{{%photo_files}}', ['album_id']);

        $this->addForeignKey(
            'photo_files_ibfk_1',
            '{{%photo_files}}',
            ['album_id'],
            '{{%photo_album}}',
            ['id'],
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%photo_files}}');
    }
}
