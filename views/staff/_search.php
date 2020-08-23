<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-staff-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_staff')->textInput(['placeholder' => 'Id Staff']) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => 'Second Name']) ?>

    <?= $form->field($model, 'id_telegram')->textInput(['placeholder' => 'Id Telegram']) ?>

    <?php /* echo $form->field($model, 'telegram_username')->textInput(['maxlength' => true, 'placeholder' => 'Telegram Username']) */ ?>

    <?php /* echo $form->field($model, 'id_location')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->orderBy('id_location')->asArray()->all(), 'id_location', 'id_location'),
        'options' => ['placeholder' => 'Choose Locations'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'status')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) */ ?>

    <?php /* echo $form->field($model, 'date_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Start',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'date_start_approve')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date End',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'date_start_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Start Official',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'date_end_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date End Official',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'personnel_number')->textInput(['maxlength' => true, 'placeholder' => 'Personnel Number']) */ ?>

    <?php /* echo $form->field($model, 'id_position_official')->textInput(['placeholder' => 'Id Position Official']) */ ?>

    <?php /* echo $form->field($model, 'unique_excel_name')->textInput(['maxlength' => true, 'placeholder' => 'Unique Excel Name']) */ ?>

    <?php /* echo $form->field($model, 'sex')->textInput(['maxlength' => true, 'placeholder' => 'Sex']) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'date_of_birth')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Of Birth',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'always_show')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'vk')->textInput(['maxlength' => true, 'placeholder' => 'Vk']) */ ?>

    <?php /* echo $form->field($model, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) */ ?>

    <?php /* echo $form->field($model, 'inn')->textInput(['maxlength' => true, 'placeholder' => 'Inn']) */ ?>

    <?php /* echo $form->field($model, 'snils')->textInput(['maxlength' => true, 'placeholder' => 'Snils']) */ ?>

    <?php /* echo $form->field($model, 'passport_number')->textInput(['maxlength' => true, 'placeholder' => 'Passport Number']) */ ?>

    <?php /* echo $form->field($model, 'passport_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Passport Date',
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'passport_authority')->textInput(['maxlength' => true, 'placeholder' => 'Passport Authority']) */ ?>

    <?php /* echo $form->field($model, 'place_of_birth')->textInput(['maxlength' => true, 'placeholder' => 'Place Of Birth']) */ ?>

    <?php /* echo $form->field($model, 'passport_first_page')->textInput(['placeholder' => 'Passport First Page']) */ ?>

    <?php /* echo $form->field($model, 'passport_second_page')->textInput(['placeholder' => 'Passport Second Page']) */ ?>

    <?php /* echo $form->field($model, 'address_home')->textInput(['maxlength' => true, 'placeholder' => 'Address Home']) */ ?>

    <?php /* echo $form->field($model, 'address_register')->textInput(['maxlength' => true, 'placeholder' => 'Address Register']) */ ?>

    <?php /* echo $form->field($model, 'length_of_service')->textInput(['maxlength' => true, 'placeholder' => 'Length Of Service']) */ ?>

    <?php /* echo $form->field($model, 'family_members')->textInput(['maxlength' => true, 'placeholder' => 'Family Members']) */ ?>

    <?php /* echo $form->field($model, 'family_status')->textInput(['maxlength' => true, 'placeholder' => 'Family Status']) */ ?>

    <?php /* echo $form->field($model, 'uniform_size')->textInput(['maxlength' => true, 'placeholder' => 'Uniform Size']) */ ?>

    <?php /* echo $form->field($model, 'comment')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'education')->textInput(['maxlength' => true, 'placeholder' => 'Education']) */ ?>

    <?php /* echo $form->field($model, 'health_card')->textInput(['maxlength' => true, 'placeholder' => 'Health Card']) */ ?>

    <?php /* echo $form->field($model, 'military_id')->textInput(['maxlength' => true, 'placeholder' => 'Military']) */ ?>

    <?php /* echo $form->field($model, 'info')->textInput(['maxlength' => true, 'placeholder' => 'Info']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
