<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalaryExtras */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="staff-salary-extras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?php
        if (!empty($id_staff)) {
            echo $form->field($model, 'id_staff')->hiddenInput(['value' => $id_staff])->label(false);
        } else {
<<<<<<< Updated upstream
            echo $form->field($model, 'id_staff')->dropDownList(\app\models\Staff::getMapFullName())->label('ID сотрудника');
=======
            echo $form->field($model, 'id_staff')->dropDownList(\app\models\Staff::getMapFullName())->label('Сотрудник');
>>>>>>> Stashed changes
        }
    ?>

    <?php
        if (!empty($id_salary)) {
            echo $form->field($model, 'id_salary')->hiddenInput(['value' => $id_salary])->label(false);
        } else {
<<<<<<< Updated upstream
            echo $form->field($model, 'id_salary')->dropDownList(\app\models\StaffSalary::getMapFullName())->label('ID смены');
        }
    ?>

    <?= $form->field($model, 'id_location')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->orderBy('id_location')->asArray()->all(), 'id_location', 'location'),
        'options' => ['placeholder' => 'Choose Location'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
=======
            echo $form->field($model, 'id_salary')->dropDownList(\app\models\StaffSalary::getMapFullName())->label('Смена');
        }
    ?>

    <?php
        if (!empty($id_location)) {
            echo $form->field($model, 'id_location')->hiddenInput(['value' => $id_location])->label(false);
        } else {
            echo $form->field($model, 'id_location')->dropDownList(\app\models\Locations::getMapFullName())->label('Локация');
        }
    ?>
>>>>>>> Stashed changes

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'datetime')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Выберите Дату, время',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Comment']) ?>

    <?= $form->field($model, 'summ')->textInput(['maxlength' => true, 'placeholder' => 'Summ']) ?>

    <?= $form->field($model, 'approve')->checkbox() ?>

<<<<<<< Updated upstream
    <?= $form->field($model, 'timestamp')->textInput(['placeholder' => 'Timestamp']) ?>

=======
>>>>>>> Stashed changes
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
