<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;

use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Locations */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Staff',
        'relID' => 'staff',
        'value' => \yii\helpers\Json::encode($model->staff),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="locations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_location')->textInput(['placeholder' => 'Id Location']) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'placeholder' => 'Location']) ?>

    <?= $form->field($model, 'chat_id')->textInput(['placeholder' => 'Chat']) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => 'Short Name']) ?>

    <?= $form->field($model, 'alternative_names')->textInput(['maxlength' => true, 'placeholder' => 'Alternative Names']) ?>

    <?= $form->field($model, 'official_name')->textInput(['maxlength' => true, 'placeholder' => 'Official Name']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <?= $form->field($model, '2gis')->textInput(['maxlength' => true, 'placeholder' => '2gis']) ?>

    <?= $form->field($model, 'first_shift_min_for_late')->textInput(['placeholder' => 'First Shift Min For Late']) ?>

    <?= $form->field($model, 'second_shift_min_for_late')->textInput(['placeholder' => 'Second Shift Min For Late']) ?>

    <?= $form->field($model, 'approve_min_for_delay')->textInput(['placeholder' => 'Approve Min For Delay']) ?>

    <?= $form->field($model, 's_workweek_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Workweek From',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 's_workweek_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Workweek To',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 's_saturday_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Saturday From',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 's_saturday_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Saturday To',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 's_sunday_from')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Sunday From',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 's_sunday_to')->widget(\kartik\datecontrol\DateControl::className(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
        'saveFormat' => 'php:H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose S Sunday To',
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'sort')->textInput(['placeholder' => 'Sort']) ?>

    <?= $form->field($model, 'show_in_reg')->checkbox() ?>

    <?= $form->field($model, 'show_in_salary')->checkbox() ?>

    <?= $form->field($model, 'last_online')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'displayFormat' => 'php:Y-m-d H:i:s',
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Last Time Online',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'pre_order')->checkbox() ?>

    <?= $form->field($model, 'delivery')->checkbox() ?>
    <!-- FileInput::widget([
    'model' => $model,
    'attribute' => 'attachment_1[]',
    'options' => ['multiple' => true]
]); -->


    <?= $form->field($model, 'images')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => [
                'https://' . $_SERVER['SERVER_NAME'] . '/' . $model->photo
            ],
            'initialPreviewAsData' => true,
        ],
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>