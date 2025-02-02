<?php

use yii\db\Migration;

/**
 * Class m250202_213657_create_admin
 */
class m250202_213657_create_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authKey = \Yii::$app->security->generateRandomString();

        $this->upsert('{{%user}}', [
            'id'                   => 1,
            'username'             => 'admin',
            'auth_key'             => $authKey,
            'password_hash'        => '$2y$13$Y2lN/1fTpObgdDvScovbyug1pDtpEly4PAgzBF9Sdm0MA5lL6IYRO',
            'password_reset_token' => null,
            'email'                => 'salnikov@internet.ru',
            'status'               => 10,
            'verification_token'   => null,
            'created_at'           => time(),
            'updated_at'           => time(),
        ]);
        echo "Пользователь admin/admin с id=1 создан!\n";
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['id' => 1]);
        echo "Пользователь admin/admin с id=1 удален.\n";
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250202_213657_create_admin cannot be reverted.\n";

        return false;
    }
    */
}
