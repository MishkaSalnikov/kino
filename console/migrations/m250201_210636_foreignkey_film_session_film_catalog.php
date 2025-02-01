<?php

use yii\db\Migration;

/**
 * Class m250201_210636_foreignkey_film_session_film_catalog
 */
class m250201_210636_foreignkey_film_session_film_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-film_sessions_film_catalog_film_id',
            '{{%film_sessions}}',
            'film_id',
            '{{%film_catalog}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-film_sessions_film_catalog_film_id',
            '{{%film_sessions}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250201_210636_foreignkey_film_session_film_catalog cannot be reverted.\n";

        return false;
    }
    */
}
