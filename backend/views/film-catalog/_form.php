<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FilmCatalog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="film-catalog-form col-md-9 col-lg-6 text-center mx-auto py-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'age_restriction')->textInput() ?>

    <?= $form->field($model, 'pict')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
