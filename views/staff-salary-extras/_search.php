<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalaryExtrasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-staff-salary-extras-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_extra')->textInput(['placeholder' => 'Id Extra']) ?>

    <?= $form->field($model, 'id_staff')->textInput(['placeholder' => 'Id Staff']) ?>

    <?= $form->field($model, 'id_salary')->textInput(['placeholder' => 'Id Salary']) ?>

    <?= $form->field($model, 'id_location')->textInput(['placeholder' => 'Id Location']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?php /* echo $form->field($model, 'datetime')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Datetime',
                'autoclose' => true,
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) */ ?>

    <?php /* echo $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Comment']) */ ?>

    <?php /* echo $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => 'Summ']) */ ?>

    <?php /* echo $form->field($model, 'approve')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'timestamp')->textInput(['placeholder' => 'Timestamp']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
