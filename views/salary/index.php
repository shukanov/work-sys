<?php

use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use app\models\Staff;
use app\models\Locations;

use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;

use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\grid\DataColumn;
use kartik\editable\Editable;
use kartik\grid\EditableColumnAction;

use yii\data\ActiveDataProvider;
use yii\db\Query;

use yii\helpers\VarDumper;

use app\models\StaffSalaryExtras;


$this->title = 'Неподтвержденные смены';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $editableOptionsDateTime = [
        //'name' => 'time_job_start',
        //'header' => 'Начало работы',
        'size' => 'xs',
        'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
        'widgetClass' =>  'kartik\datecontrol\DateControl',
        'language' => 'ru',
        'options' => [
            'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
            'displayFormat' => 'php:Y-m-d H:i',
            'saveFormat' => 'php:Y-m-d H:i:s',//
            'ajaxConversion'=>false,
            'convertFormat' => true,

            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'php:Y-m-d H:i',
                'todayHighlight' => true
            ],
        ],

    ];

    $gridColumns = [

        [
            'label' => '№',
            'attribute' => 'id_salary',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
            'filter' =>'<input type="text" class="form-control" name="StaffSalary[id_salary]">',
        ],

        [
            'attribute' => 'Имя',
            'noWrap' => true,
            'format' => 'raw',
            'filter' =>  Select2::widget([        
                'model' => $model,
                'attribute' => 'id_staff',
                'data' => ArrayHelper::map(Staff::find()->asArray()->all(), 'id_staff', 'last_name'),
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'initValueText' => $model->type,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Выберите значение',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'selectOnClose' => true,
                ]
            ]),
            'value' => function($model) {
                return $model->staff->last_name . ' ' .$model->staff->first_name;
            },
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
        ],
        [
            'attribute' => 'Место',
            'noWrap' => true,
            'format' => 'raw',
            'filter' =>  Select2::widget([        
                'model' => $model,
                'attribute' => 'id_location',
                'data' => ArrayHelper::map(Locations::find()->asArray()->all(), 'id_location', 'location'),
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
                'initValueText' => $model->type,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Выберите значение'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'selectOnClose' => true,
                ]
            ]),
            'value' => function($model) {
                return $model->locations->location;
            },
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
        ],

        [
            'label' => 'Официальная <br>дата<br> начала<br> работы',
            'encodeLabel' => false,
            'noWrap' => true,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'filter' =>   DateTimePicker::widget([
                'name' => 'time_job_start_official',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:00'
                ]
            ]),
            'content' => function($model) {
                if ($model->is_deleted == true) {
                    if ($model->time_job_start_official) $date = $model->time_job_start_official;
                    else if ($model->time_job_start) $date = $model->time_job_start;

                    $return = $date;
                    $N = Yii::$app->formatter->asDate($date, 'php:N');

                    if ($N == 6) {
                        $return = '<span style="text-decoration: line-through;">'.$return.' <span class="badge badge-warning">сб</span>' . '</span>';
                    } else if ($N == 7) {
                        $return = '<span style="text-decoration: line-through;">'.$return.' <span class="badge badge-info">вс</span>' . '</span>';
                    } else {
                        $return = '<span style="text-decoration: line-through;">'.$return.'</span>';
                    }
                    return $return;
                } else {
                    if ($model->time_job_start_official) $date = $model->time_job_start_official;
                    else if ($model->time_job_start) $date = $model->time_job_start;

                    $return = $date;
                    $N = Yii::$app->formatter->asDate($date, 'php:N');

                    if ($N == 6) {
                        $return = ''.$return.' <span class="badge badge-warning">сб</span>';
                    } else if ($N == 7) {
                        $return = ''.$return.' <span class="badge badge-info">вс</span>';
                    }
                    return $return;
                }

            },
        ],
        [
            'label' => 'Официальная <br>дата<br> окончания<br> работы',
            'encodeLabel' => false,
            'noWrap' => true,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'filter' =>   DateTimePicker::widget([
                'name' => 'time_job_end_official',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:00'
                ]
            ]),
            'content' => function($model) {
                if ($model->is_deleted == true) {
                    if ($model->time_job_end_official) $date = $model->time_job_end_official;
                    else if ($model->time_job_end) $date = $model->time_job_end;

                    $return = $date;
                    $N = Yii::$app->formatter->asDate($date, 'php:N');

                    if ($N == 6) {
                        $return = '<span style="text-decoration: line-through;">'.$return.' <span class="badge badge-warning">сб</span>' . '</span>';
                    } else if ($N == 7) {
                        $return = '<span style="text-decoration: line-through;">'.$return.' <span class="badge badge-info">вс</span>' . '</span>';
                    } else {
                        $return = '<span style="text-decoration: line-through;">'.$return.'</span>';
                    }
                    return $return;
                } else {
                    if ($model->time_job_end_official) $date = $model->time_job_end_official;
                    else if ($model->time_job_end) $date = $model->time_job_end;

                    $return = $date;
                    $N = Yii::$app->formatter->asDate($date, 'php:N');

                    if ($N == 6) {
                        $return = ''.$return.' <span class="badge badge-warning">сб</span>';
                    } else if ($N == 7) {
                        $return = ''.$return.' <span class="badge badge-info">вс</span>';
                    }
                    return $return;
                }

            },
        ],
        [
            'label'=> "Оф. <br>график<br>работы",
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'format' => 'raw',
            'value' => function($model){
                if ($model->is_deleted == true) {
                    $H1 = Yii::$app->formatter->asDate($model->time_job_start_official, 'php:H:i');
                    $H2 = Yii::$app->formatter->asDate($model->time_job_end_official, 'php:H:i');
                    if ($model->time_job_start_official && $model->time_job_end_official) return $H1.' - '. $H2;
                     return '<span style="text-decoration: line-through;">'.$H1.'</span>';
                } else {
                    $H1 = Yii::$app->formatter->asDate($model->time_job_start_official, 'php:H:i');
                    $H2 = Yii::$app->formatter->asDate($model->time_job_end_official, 'php:H:i');
                    if ($model->time_job_start_official && $model->time_job_end_official) return $H1.' - '. $H2;

                }
            },
        ],
        [
            'label'=>'Cмена <br>с',
            'encodeLabel' => false,
            'class' => 'kartik\grid\DataColumn',
            'attribute' => 'time_job_start',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'filter' =>   DateTimePicker::widget([
                'name' => 'time_job_start',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'mm/dd/yyyy hh:ii:ss'
                ]
            ]),
           
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'attribute' => 'time_job_start_approve',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'header' => '',
            'filter'=>array(1 => 'No active',2 => 'Active'),
            'editableOptions' => [
                'value' => 1,
                'asPopover' => false,
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    0 => 'No active',
                    1 => 'Active'
                ],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                'displayValueConfig'=> [
                    '0' => '<i class="glyphicon glyphicon-remove text-danger"></i>',
                    '1' => '<i class="glyphicon glyphicon-ok text-success"></i>',
                ],
            ],
        ],
        [
            'class' => 'kartik\grid\DataColumn',
            'attribute' => 'time_job_end',
            'label'=>'Смена <br>до',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'filter' =>   DateTimePicker::widget([
                'name' => 'time_job_end',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'mm/dd/yyyy hh:ii:ss'
                ]
            ]),
            'headerOptions' => ['class' => 'kv-sticky-column'],
            'contentOptions' => ['class' => 'kv-sticky-column'],
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'time_job_end_approve',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'header' => '',
            'filter'=>array(1 => 'No active',2 => 'Active'),
            'editableOptions' => [
                'value' => 1,
                'asPopover' => false,
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    0 => 'No active',
                    1 => 'Active'
                ],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                'displayValueConfig'=> [
                    '0' => '<i class="glyphicon glyphicon-remove text-danger"></i>',
                    '1' => '<i class="glyphicon glyphicon-ok text-success"></i>',
                ],
            ],
        ],
        [
            'class' => 'kartik\grid\DataColumn',
            'attribute' => 'rate',
            'noWrap' => true,
            'label'=>'Ставка',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '7%',
        ],

        [
            'class' => 'kartik\grid\EditableColumn',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'contentOptions' => ['style'=>'text-align: center;vertical-align: middle;'],
            'attribute' => 'position_approve',
            'header' => '',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'header' => '',
            'filter'=>array(1 => 'No active',2 => 'Active'),
            'editableOptions' => [
                'value' => 1,
                'asPopover' => false,
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data' => [
                    1 => 'No active',
                    2 => 'Active'
                ],
                'options' => ['class'=>'form-control', 'prompt'=>'Select status...'],
                'displayValueConfig'=> [
                    '0' => '<i class="glyphicon glyphicon-remove text-danger"></i>',
                    '1' => '<i class="glyphicon glyphicon-ok text-success"></i>',
                ],
            ],
        ],

        [
            'noWrap' => true,
            'label' => 'Опозд.',
            'class' => 'kartik\grid\DataColumn',
            'attribute' => 'late',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'noWrap' => true,
            'label' => 'Задер.',
            'class' => 'kartik\grid\DataColumn',
            'attribute' => 'delay',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
    ];

    ?>



    <?php
    Pjax::begin([
        'id' => 'grid',
    ]);

    echo GridView::widget([
        'id' => 'grid',
        'filterModel' => $model,
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
        'rowOptions' => function ($model) {
            if ($model->time_job_start_approve && $model->time_job_end_approve && $model->position_approve) {
                return ['class' => 'success'];
            } else if ($model->time_job_start_official && $model->time_job_end_official && !$model->time_job_start) {
                return ['class' => 'warning'];
            }
        },
        'pjax' => true, // pjax is set to always true for this demo,
        'pjaxSettings'=>[
            'options'=>[
                'enablePushState'=>false,
            ],
        ],
        // set your toolbar
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        // parameters from the demo form
        'bordered' => true,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '',
        ],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'смена',
        'itemLabelPlural' => 'смен'
    ]);

    Pjax::end();
    ?>


</div>
