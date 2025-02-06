<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\icons\FontAwesomeAsset;

/** @var yii\web\View $this */
/** @var common\models\FilmSessions $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $films */
?>

<div class="film-sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'film_id')->dropDownList($films, ['prompt' => 'Выберите фильм']) ?>


    <?php
    FontAwesomeAsset::register($this);
    echo $form->field($model, 'start_datetime')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Выберите дату и время'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
