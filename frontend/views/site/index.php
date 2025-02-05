<?php
use yii\helpers\Html;
use common\components\ImageHelper;

/** @var yii\web\View $this */
/** @var frontend\models\FilmSessions[] $sessions */

$this->title = 'Расписание сеансов';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="film-sessions-list">
    <?php if (!empty($sessions)): ?>
        <table class="table">
            <thead>
            <tr>
                <th>Фильм</th>
                <th>Описание</th>
                <th>Дата и время</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sessions as $session): ?>
                <tr>
                    <td>
                        <?= Html::encode($session->film->title) ?><br />
                        <img src="<?= ImageHelper::getImageUrl($session->film->id, $session->film->pict) ?>" width="200">
                    </td>
                    <td>
                        <?= Html::encode($session->film->description) ?>
                    </td>
                    <td>
                        начало <?= Yii::$app->formatter->asDatetime($session->start_datetime, 'php:d.m.Y H:i') ?> <br />
                        идет до <?= Yii::$app->formatter->asDatetime($session->end_datetime, 'php:d.m.Y H:i') ?>
                    </td>

                    <td>
                        <?= Yii::$app->formatter->asCurrency($session->price, 'RUB') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет доступных сеансов.</p>
    <?php endif; ?>
</div>
