<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FilmCatalog $model */

$this->title = 'Изменение фильма в каталоге: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог фильмов', 'url' => ['index']]; //почему нужно везде вручную писать названия крошек????
$this->params['breadcrumbs'][] = ['label' => $model->title . ' (Изменение)', 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="film-catalog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
