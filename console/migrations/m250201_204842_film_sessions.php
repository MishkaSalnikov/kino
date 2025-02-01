<?php

use yii\db\Migration;

/**
 * Class m250201_204842_film_sessions
 */
class m250201_204842_film_sessions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('film_sessions', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(),
            'start_datetime' => $this->dateTime(),
            'end_datetime' => $this->dateTime(),
            'price' => $this->smallInteger(),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
        $this->createIndex('idx-film_sessions-start_datetime', '{{%film_sessions}}', 'start_datetime');
        $this->createIndex('idx-film_sessions-end_datetime', '{{%film_sessions}}', 'end_datetime');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
     $this->dropTable('film_sessions');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250201_204842_film_sessions cannot be reverted.\n";

        return false;
    }
    */
}
