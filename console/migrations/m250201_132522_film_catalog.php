<?php

use yii\db\Migration;

/**
 * Class m250201_132522_film_catalog
 */
class m250201_132522_film_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_catalog}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string(255)->notNull()->unique(),
            'description'   => $this->string(2000),
            'duration'      => $this->smallInteger()->notNull()->defaultValue(90),
            'age_restriction' => $this->tinyInteger()->notNull()->defaultValue(18),
            'pict'          => $this->string(5),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film_catalog}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250201_132522_film_catalog cannot be reverted.\n";

        return false;
    }
    */
}
