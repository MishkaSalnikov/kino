<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\FilmCatalog $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог фильмов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="film-catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'duration',
            'age_restriction',
            [
                'attribute' => 'pict',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->getImageUrl(), ['style' => 'max-width: 200px;']);
                },
            ],
        ],
    ]);
    ?>

</div>
