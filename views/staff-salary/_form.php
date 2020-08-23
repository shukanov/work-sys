<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalary */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="staff-salary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_staff')->dropDownList(\app\models\Staff::getMapFullName())->label('ID сотрудника') ?>

    <?= $form->field($model, 'id_location')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->orderBy('id_location')->asArray()->all(), 'id_location', 'location'),
        'options' => ['placeholder' => 'Choose Location'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_position')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\StaffPositions::find()->orderBy('id_position')->asArray()->all(), 'id_position', 'position'),
        'options' => ['placeholder' => 'Choose Position'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'time_job_start_command')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Command',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_comment')->textInput(['maxlength' => true, 'placeholder' => 'Time Job Comment']) ?>

    <?= $form->field($model, 'checkin_code')->textInput(['placeholder' => 'Checkin Code']) ?>

    <?= $form->field($model, 'time_job_zone')->textInput(['maxlength' => true, 'placeholder' => 'Time Job Zone']) ?>

    <?= $form->field($model, 'time_job_start_wish')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Wish',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_end_wish')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Wish',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_start_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start Official',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_end_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Official',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job Start',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_start_approve')->textInput(['placeholder' => 'Time Job Start Approve']) ?>

    <?= $form->field($model, 'time_job_end_command')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'displayFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End Command',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Time Job End',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'time_job_end_approve')->textInput(['placeholder' => 'Time Job End Approve']) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?>

    <?= $form->field($model, 'position_approve')->textInput(['placeholder' => 'Position Approve']) ?>

    <?= $form->field($model, 'useSalary')->checkBox(['placeholder' => 'useSalary']) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'placeholder' => 'Rate']) ?>

    <?= $form->field($model, 'salary')->textInput(['maxlength' => true, 'placeholder' => 'Salary']) ?>

    <?= $form->field($model, 'late')->textInput(['placeholder' => 'Late']) ?>

    <?= $form->field($model, 'delay')->textInput(['placeholder' => 'Delay']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Comment']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>

    <?= $form->field($model, 'id_type')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\StaffSalaryType::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Staff salary type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
