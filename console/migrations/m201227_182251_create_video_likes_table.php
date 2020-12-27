<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video_likes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%video}}`
 * - `{{%user}}`
 */
class m201227_182251_create_video_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video_likes}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->string(16)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'type' => $this->integer(1)->notNull(),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-video_likes-video_id}}',
            '{{%video_likes}}',
            'video_id'
        );

        // add foreign key for table `{{%video}}`
        $this->addForeignKey(
            '{{%fk-video_likes-video_id}}',
            '{{%video_likes}}',
            'video_id',
            '{{%video}}',
            'video_id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-video_likes-user_id}}',
            '{{%video_likes}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-video_likes-user_id}}',
            '{{%video_likes}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%video}}`
        $this->dropForeignKey(
            '{{%fk-video_likes-video_id}}',
            '{{%video_likes}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-video_likes-video_id}}',
            '{{%video_likes}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-video_likes-user_id}}',
            '{{%video_likes}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-video_likes-user_id}}',
            '{{%video_likes}}'
        );

        $this->dropTable('{{%video_likes}}');
    }
}
