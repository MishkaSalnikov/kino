<?php

use common\models\FilmCatalog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\ImageHelper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог фильмов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'duration',
            'age_restriction',
            [
                'attribute' => 'pict',
                'format' => 'html',
                'label' => 'Изображение',
                'value' => function ($model) {
                    $img = ImageHelper::getImageUrl($model->id, $model->pict);
                    return Html::img($img, ['style' => 'width:200px;']); //лучше бы, конечно, отдельно генерить превью????
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FilmCatalog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
