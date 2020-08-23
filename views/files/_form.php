<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true, 'placeholder' => 'Заголовок файла']) ?>

    <?= $form->field($model, 'id_location')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->orderBy('id_location')->asArray()->all(), 'id_location', 'location'),
        'options' => ['placeholder' => 'Choose Location'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_staff')->dropDownList(\app\models\Staff::getMapFullName())->label('ID сотрудника') ?>
    
    <?= $form->field($model, 'id_salary')->dropDownList(\app\models\StaffSalary::getMapFullName())->label('ID смены') ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) ?>

    <?= $form->field($model, 'temp_file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => [
                'https://' . $_SERVER['SERVER_NAME'] . '/' . $model->file
            ],
            'initialPreviewAsData' => true,
        ],
    ]); ?>

    <!--<?= $form->field($model, 'i')->textInput(['placeholder' => 'I']) ?>-->

    <!--<?= $form->field($model, 'comment')->textInput(['maxlength' => true, 'placeholder' => 'Текстовый комментарий к файлу']) ?>-->
    <?= $form->field($model, 'comment')->textarea(['rows' => 5, 'cols' => 5, 'placeholder' => 'Текстовый комментарий к файлу']) ?>

    <?= $form->field($model, 'storage_life')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d',
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Выберите дату истечения срока годности файла',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
