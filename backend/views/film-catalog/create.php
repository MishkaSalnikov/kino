<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FilmCatalog $model */

$this->title = 'Добавление фильма в каталог';
$this->params['breadcrumbs'][] = ['label' => 'Каталог фильмов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-catalog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
