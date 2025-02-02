<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class UserController extends Controller
{
    public function actionCreate($username, $password, $email)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        if ($user->save()) {
            echo "Пользователь {$username} создан успешно!\n";
        } else {
            echo "Ошибка создания пользователя: " . print_r($user->errors, true) . "\n";
        }
    }
}
