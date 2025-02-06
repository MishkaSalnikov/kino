<?php

//use common\models\FilmSessions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\ImageHelper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список сеансов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-sessions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film Sessions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <? /*= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'film_id',
            'start_datetime',
            'end_datetime',
            'price',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FilmSessions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); */?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], // Автонумерация строк

            [
                'attribute' => 'film.title', // Отображение названия фильма через связь
                'label' => 'Фильм',
                'value' => function ($model) {
                    return $model->film->title;
                }
            ],
            [
                'attribute' => 'start_datetime',
                'label' => 'Дата и время начала',
                'format' => ['datetime', 'php:d.m.Y H:i'],
            ],
            [
                'attribute' => 'end_datetime',
                'label' => 'Дата и время окончания',
                'format' => ['datetime', 'php:d.m.Y H:i'],
            ],
            [
                'attribute' => 'price',
                'label' => 'Цена (руб.)',
                'format' => ['decimal', 0],
            ],
            [
                'attribute' => 'film.pict',
                'label' => 'Постер',
                'format' => 'html',
                'value' => function ($model) {
                    return "<img src='" . ImageHelper::getImageUrl($model->film->id, $model->film->pict) . "' width='100'>";
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
