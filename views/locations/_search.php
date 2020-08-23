<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LocationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-locations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_location')->textInput(['placeholder' => 'Id Location']) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'Location']) ?>

    <?= $form->field($model, 'chat_id')->textInput(['placeholder' => 'Chat']) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => 'Short Name']) ?>

    <?= $form->field($model, 'alternative_names')->textInput(['maxlength' => true, 'placeholder' => 'Alternative Names']) ?>

    <?php /* echo $form->field($model, 'official_name')->textInput(['maxlength' => true, 'placeholder' => 'Official Name']) */ ?>

    <?php /* echo $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) */ ?>

    <?php /* echo $form->field($model, '2gis')->textInput(['maxlength' => true, 'placeholder' => '2gis']) */ ?>

    <?php /* echo $form->field($model, 'first_shift_min_for_late')->textInput(['placeholder' => 'First Shift Min For Late']) */ ?>

    <?php /* echo $form->field($model, 'second_shift_min_for_late')->textInput(['placeholder' => 'Second Shift Min For Late']) */ ?>

    <?php /* echo $form->field($model, 'approve_min_for_delay')->textInput(['placeholder' => 'Approve Min For Delay']) */ ?>

    <?php /* echo $form->field($model, 's_workweek_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Workweek From',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 's_workweek_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Workweek To',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 's_saturday_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Saturday From',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 's_saturday_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Saturday To',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 's_sunday_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Sunday From',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 's_sunday_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Sunday To',
                'autoclose' => true
            ]
        ]
    ]); */ ?>

    <?php /* echo $form->field($model, 'sort')->textInput(['placeholder' => 'Sort']) */ ?>

    <?php /* echo $form->field($model, 'show_in_reg')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'show_in_salary')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'last_online')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Last Online',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'pre_order')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'delivery')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'photo')->textInput(['maxlength' => true, 'placeholder' => 'Photo']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
