<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\grid\GridView;
use kartik\widgets\FileInput;
use kartik\select2\Select2;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Last Name']) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'First Name']) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true, 'placeholder' => 'Second Name']) ?>

    <?= $form->field($model, 'id_telegram')->textInput(['placeholder' => 'Id Telegram']) ?>

    <?= $form->field($model, 'telegram_username')->textInput(['maxlength' => true, 'placeholder' => 'Имя пользователя Телеграм']) ?>

    <?= $form->field($model, 'id_location')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->orderBy('id_location')->asArray()->all(), 'id_location', 'id_location'),
        'options' => ['placeholder' => 'Choose Locations'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'date_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Start',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_start_approve')->checkbox() ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date End',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_start_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Start Official',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_end_official')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date End Official',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'personnel_number')->textInput(['maxlength' => true, 'placeholder' => 'Personnel Number']) ?>

    <?= $form->field($model, 'id_position_official')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\StaffPositions::find()->orderBy('id_position')->asArray()->all(), 'id_position', 'position'),
        'options' => ['placeholder' => 'Choose Position'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'unique_excel_name')->textInput(['maxlength' => true, 'placeholder' => 'Unique Excel Name']) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true, 'placeholder' => 'Sex']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($model, 'date_of_birth')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Date Of Birth',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'always_show')->checkbox() ?>

    <?= $form->field($model, 'vk')->textInput(['maxlength' => true, 'placeholder' => 'Vk']) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'placeholder' => 'Inn']) ?>

    <?= $form->field($model, 'snils')->textInput(['maxlength' => true, 'placeholder' => 'Snils']) ?>

    <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true, 'placeholder' => 'Passport Number']) ?>

    <?= $form->field($model, 'passport_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Passport Date',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'passport_authority')->textInput(['maxlength' => true, 'placeholder' => 'Passport Authority']) ?>

    <?= $form->field($model, 'place_of_birth')->textInput(['maxlength' => true, 'placeholder' => 'Place Of Birth']) ?>

    <?= $form->field($model, 'passport_first_page_file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => [
                'https://' . $_SERVER['SERVER_NAME'] . '/' . $model->passport_first_page
            ],
            'initialPreviewAsData' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'passport_second_page_file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => [
                'https://' . $_SERVER['SERVER_NAME'] . '/' . $model->passport_second_page
            ],
            'initialPreviewAsData' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'address_home')->textInput(['maxlength' => true, 'placeholder' => 'Address Home']) ?>

    <?= $form->field($model, 'address_register')->textInput(['maxlength' => true, 'placeholder' => 'Address Register']) ?>

    <?= $form->field($model, 'length_of_service')->textInput(['maxlength' => true, 'placeholder' => 'Length Of Service']) ?>

    <?= $form->field($model, 'family_members')->textInput(['maxlength' => true, 'placeholder' => 'Family Members']) ?>

    <?= $form->field($model, 'family_status')->textInput(['maxlength' => true, 'placeholder' => 'Family Status']) ?>

    <?= $form->field($model, 'uniform_size')->textInput(['maxlength' => true, 'placeholder' => 'Uniform Size']) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => true, 'placeholder' => 'Education']) ?>

    <?= $form->field($model, 'health_card')->textInput(['maxlength' => true, 'placeholder' => 'Health Card']) ?>

    <?= $form->field($model, 'military_id')->textInput(['maxlength' => true, 'placeholder' => 'Military']) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true, 'placeholder' => 'Info']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>
    <!-- HERE -->

    <div class="files-index">

    <?php  
    $gridColumn = [
        ['class' => 'yii\grid\CheckboxColumn'],
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'id_location',
            'label' => 'Локация',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model){
                if ($model->locations)
                {return $model->locations->location;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->asArray()->all(), 'id_location', 'id_location'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Locations', 'id' => 'grid-files-search-id_location']
        ],
        [
            'attribute' => 'id_staff',
            'label' => 'ФИО',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model){
                if ($model->staff)
                {return $model->staff->last_name . " " . $model->staff->first_name . " " . $model->staff->second_name;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Staff::find()->asArray()->all(), 'id_staff', 'id_staff'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Staff', 'id' => 'grid-files-search-id_staff']
        ],
        // 'type',
        [
            'attribute' => 'type',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'photo',
            'noWrap' => true,
            'format' => 'raw',
            'label' => 'Фото',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model) {

                $options = ['style' => [
                    'width' => '25em',
                    'height' => '25em',
                    ]
                ];

                if (strpos ($model->file, '.png') !== false ||
                    strpos ($model->file, '.jpg') !== false ||
                    strpos ($model->file, '.jpeg') !== false) {
                    return Html::img("@web/" . $model->file, $options);
                } else {
                    return (Yii::getAlias('@webroot') . $model->file);
                }
            },
            //'staff.first_name',
            'hAlign' => 'center',
            //'vAlign' => 'middle',
            'width' => '10px',
        ],
        // 'i',
        [
            'attribute' => 'i',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'datetime',
            'label' => 'Время <br>создания',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'staff',
            'template' => '{view} {update} {delete}',
            'buttons' => [
            'view' => function ($url, $model, $key) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['files/view','id'=>$model['id']]);
            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customUrl);
            },
            'update' => function ($url, $model, $key) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['files/update','id'=>$model['id']]);
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customUrl);
            },
            'delete' => function ($url, $model, $key) {
            $customUrl = Yii::$app->getUrlManager()->createUrl(['files/delete','id'=>$model['id']]);
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $customUrl);
            },
            ]
        ]
    ]; 
    ?>
    <?=Html::beginForm(['files/download-files'],'post');?>
    <div style="width: 20em; display: flex;">
    <?php
    echo Select2::widget([
        'name' => 'download_type',
        'data' => [1 => "Объединенный", 2 => "По отдельности"],
        'options' => [
            'placeholder' => 'Выбери способ загрузки документов ...',
        ],
    ]);
    ?>
    <?=Html::submitButton('Загрузить документы', ['class' => 'btn btn-info', 'style' => 'margin-left: 1em;']);?>
    
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-files']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]);
    ?>
    <?= Html::endForm();?>

</div>


</div>
