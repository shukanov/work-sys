<div class="form-group" id="add-staff">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Staff',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'id_staff' => ['type' => TabularForm::INPUT_HIDDEN],
        'last_name' => ['type' => TabularForm::INPUT_TEXT],
        'first_name' => ['type' => TabularForm::INPUT_TEXT],
        'second_name' => ['type' => TabularForm::INPUT_TEXT],
        'id_telegram' => ['type' => TabularForm::INPUT_TEXT],
        'telegram_username' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'state' => ['type' => TabularForm::INPUT_TEXT],
        'date_start' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date Start',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_start_approve' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'date_end' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date End',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_start_official' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date Start Official',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_end_official' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date End Official',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'personnel_number' => ['type' => TabularForm::INPUT_TEXT],
        'id_position_official' => ['type' => TabularForm::INPUT_TEXT],
        'unique_excel_name' => ['type' => TabularForm::INPUT_TEXT],
        'sex' => ['type' => TabularForm::INPUT_TEXT],
        'phone' => ['type' => TabularForm::INPUT_TEXT],
        'email' => ['type' => TabularForm::INPUT_TEXT],
        'date_of_birth' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Date Of Birth',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'always_show' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'vk' => ['type' => TabularForm::INPUT_TEXT],
        'instagram' => ['type' => TabularForm::INPUT_TEXT],
        'inn' => ['type' => TabularForm::INPUT_TEXT],
        'snils' => ['type' => TabularForm::INPUT_TEXT],
        'passport_number' => ['type' => TabularForm::INPUT_TEXT],
        'passport_date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Passport Date',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'passport_authority' => ['type' => TabularForm::INPUT_TEXT],
        'place_of_birth' => ['type' => TabularForm::INPUT_TEXT],
        'passport_first_page' => ['type' => TabularForm::INPUT_TEXT],
        'passport_second_page' => ['type' => TabularForm::INPUT_TEXT],
        'address_home' => ['type' => TabularForm::INPUT_TEXT],
        'address_register' => ['type' => TabularForm::INPUT_TEXT],
        'length_of_service' => ['type' => TabularForm::INPUT_TEXT],
        'family_members' => ['type' => TabularForm::INPUT_TEXT],
        'family_status' => ['type' => TabularForm::INPUT_TEXT],
        'uniform_size' => ['type' => TabularForm::INPUT_TEXT],
        'comment' => ['type' => TabularForm::INPUT_TEXTAREA],
        'education' => ['type' => TabularForm::INPUT_TEXT],
        'health_card' => ['type' => TabularForm::INPUT_TEXT],
        'military_id' => ['type' => TabularForm::INPUT_TEXT],
        'info' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowStaff(' . $key . '); return false;', 'id' => 'staff-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Staff', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowStaff()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

