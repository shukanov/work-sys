<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalarySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-staff-salary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_salary')->textInput(['placeholder' => 'Id Salary']) ?>

    <?= $form->field($model, 'id_staff')->textInput(['placeholder' => 'Id Staff']) ?>

    <?= $form->field($model, 'id_location')->textInput(['placeholder' => 'Id Location']) ?>

    <?= $form->field($model, 'id_position')->textInput(['placeholder' => 'Id Position']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?php /* echo $form->field($model, 'time_job_start_command')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Command',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_comment')->textInput(['maxlength' => true, 'placeholder' => 'Time Job Comment']) */ ?>

    <?php /* echo $form->field($model, 'checkin_code')->textInput(['placeholder' => 'Checkin Code']) */ ?>

    <?php /* echo $form->field($model, 'time_job_zone')->textInput(['maxlength' => true, 'placeholder' => 'Time Job Zone']) */ ?>

    <?php /* echo $form->field($model, 'time_job_start_wish')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Wish',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_end_wish')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Wish',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_start_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Official',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_end_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Official',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_start_approve')->textInput(['placeholder' => 'Time Job Start Approve']) */ ?>

    <?php /* echo $form->field($model, 'time_job_end_command')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Command',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'time_job_end_approve')->textInput(['placeholder' => 'Time Job End Approve']) */ ?>

    <?php /* echo $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) */ ?>

    <?php /* echo $form->field($model, 'position_approve')->textInput(['placeholder' => 'Position Approve']) */ ?>

    <?php /* echo $form->field($model, 'rate')->textInput(['maxlength' => true, 'placeholder' => 'Rate']) */ ?>

    <?php /* echo $form->field($model, 'late')->textInput(['placeholder' => 'Late']) */ ?>

    <?php /* echo $form->field($model, 'delay')->textInput(['placeholder' => 'Delay']) */ ?>

    <?php /* echo $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Comment']) */ ?>

    <?php /* echo $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) */ ?>

    <?php /* echo $form->field($model, 'id_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\StaffSalaryType::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Staff salary type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
