<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exam}}`.
 */
class m210812_125031_create_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exam}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(11),
            'start_time' => $this->integer(11),
            'need_day' => $this->integer(11),
            'exam_day' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%exam}}');
    }
}
