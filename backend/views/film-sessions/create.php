<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var common\models\FilmSessions $model */
/** @var array $films */

$this->title = 'Create Film Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Film Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-sessions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'films' => $films,
    ]) ?>

</div>
