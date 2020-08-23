<?php

use app\models\Locations;
use app\models\Staff;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\datetime\DateTimePicker;
use kartik\field\FieldRange;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;
use kartik\form\ActiveForm;

use kartik\grid\DataColumn;
use kartik\editable\Editable;
use kartik\grid\EditableColumnAction;

use yii\data\ActiveDataProvider;
use yii\db\Query;

use yii\helpers\VarDumper;

use app\models\StaffSalaryExtras;


$this->title = 'Смены';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать смену', ['staff-salary/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $editableOptionsDateTime = [
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
            'noWrap' => true,
            'format' => 'raw',
            'value' => function($model) {
                return Html::a('Expand',
                    ['site/expand-window-view', 'id_salary' => $model->id_salary],
                    ['onclick' => "newMyWindow(this.href); return false;"]); //Html::url('site/grid?id_staff=1');
            },
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
        ],


        [
            'label' => '№',
            'attribute' => 'id_salary',
            'noWrap' => true,
            'format' => 'raw',
            'filter' =>'<input type="text" class="form-control" name="StaffSalary[id_salary]">',
            'value' => function($model){
                if ($model->is_deleted == true) {
                    return '<span style="text-decoration: line-through;">' . $model->id_salary . '</span>';
                } else {
                    return $model->id_salary;
                }
            },
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
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
                if (!empty($model->staff)) {

                    if ($model->is_deleted == true) {
                        return '<span style="text-decoration: line-through;">' . $model->staff->last_name . ' ' .$model->staff->first_name . '</span>';
                    } else {
                        return Html::a($model->staff->last_name . ' ' .$model->staff->first_name,'?r=site/grid&id_staff='.$model->id_staff);
                    }
                }
                
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
                if (!empty($model->locations)) {

                    if ($model->is_deleted == true) {
                        return '<span style="text-decoration: line-through;">' . $model->locations->location . '</span>';
                    } else {
                        return Html::a($model->locations->location,'?r=site/grid&id_location='.$model->locations->id_location);
                    }
                }
                
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
            'label'=> "Cмена <br>с",
            'encodeLabel' => false,
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'time_job_start',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'format' => 'datetime',
            'filter' =>   DateTimePicker::widget([
                'name' => 'time_job_start',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'mm/dd/yyyy hh:ii:ss'
                ]
            ]),
            'headerOptions' => ['class' => 'kv-sticky-column'],
            'contentOptions' => ['class' => 'kv-sticky-column'],
            'readonly' => function($model, $key, $index, $widget) {
                if ($model->is_deleted == true) {
                } else {
                    return false;
                }
            },
            'content' => function($model) {
                if ($model->is_deleted == true) {
                    $H3 = Yii::$app->formatter->asDate($model->time_job_start_official, 'php:H:i');
                    $H4 = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');

                    if ($model->time_job_start && $model->time_job_end) {
                        $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:Y-m-d');
                        $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:Y-m-d');

                        if ($H1 != $H2) {
                            $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:d.m.');
                            $return = '<span class="bg-danger text-danger">'.$H1.'</span>'.$H4;
                        }
                        else {
                            $return = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');
                        }
                    } else if ($model->time_job_start) {
                        $return = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');
                    }

                    if ($H3 != $H4 && $model->time_job_start_official && !empty($return)) {
                        $return.= ' <span style="color:#CECECE">('.$H3.')</span>';
                    }

                    if (!empty($return)) {
                        return '<span style="text-decoration: line-through;">' . $return . '</span>';
                    } else {
                        return null;
                    }
                } else {
                    $H3 = Yii::$app->formatter->asDate($model->time_job_start_official, 'php:H:i');
                    $H4 = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');

                    if ($model->time_job_start && $model->time_job_end) {
                        $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:Y-m-d');
                        $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:Y-m-d');

                        if ($H1 != $H2) {
                            $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:d.m.');
                            $return = '<span class="bg-danger text-danger">'.$H1.'</span>'.$H4;
                        }
                        else {
                            $return = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');
                        }
                    } else if ($model->time_job_start) {
                        $return = Yii::$app->formatter->asDate($model->time_job_start, 'php:H:i');
                    }

                    if ($H3 != $H4 && $model->time_job_start_official) {
                        $return.= ' <small style="color:#CECECE" class="small">('.$H3.')</small>';
                    }

                    return $return;
                }
            },
            'editableOptions' => $editableOptionsDateTime,
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'contentOptions' => ['style'=>'vertical-align: middle;'],
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
            'class' => 'kartik\grid\EditableColumn',
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
            'readonly' => function($model, $key, $index, $widget) {
                if ($model->is_deleted == true) {
                    return true; // do not allow editing of inactive records
                } else {
                    return false;
                }
            },
            'content' => function($model) {
                if ($model->is_deleted == true) {
                    if ($model->time_job_start && $model->time_job_end) {
                        $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:Y-m-d');
                        $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:Y-m-d');

                        if ($H1 != $H2) {
                            $H1 = Yii::$app->formatter->asDate($model->time_job_end, 'php:d.m.');
                            $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                            $return = '<span class="bg-danger text-danger">'.$H1.'</span>'.$H2;
                        } else {
                            $return = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                        }
                    } else if ($model->time_job_end) {
                        $return = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                    }

                    if (!empty($return)) {
                        return '<span style="text-decoration: line-through;">' . $return . '</span>';
                    } else {
                        return null;
                    }
                } else {
                    if ($model->time_job_start && $model->time_job_end) {
                        $H1 = Yii::$app->formatter->asDate($model->time_job_start, 'php:Y-m-d');
                        $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:Y-m-d');

                        if ($H1 != $H2) {
                            $H1 = Yii::$app->formatter->asDate($model->time_job_end, 'php:d.m.');
                            $H2 = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                            $return = '<span class="bg-danger text-danger">'.$H1.'</span>'.$H2;
                        } else {
                            $return = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                        }
                    } else if ($model->time_job_end) {
                        $return = Yii::$app->formatter->asDate($model->time_job_end, 'php:H:i');
                    }
                    return $return;
                }
            },
            'editableOptions' => $editableOptionsDateTime,
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
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'rate',
            'noWrap' => true,
            'label'=>'Ставка',
            'readonly' => function($model, $key, $index, $widget) {
                if ($model->is_deleted == true) {
                    return true; // do not allow editing of inactive records
                } else {
                    return false;
                }
            },
            'editableOptions' => [
                'header' => 'Ставка',
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                'options' => [
                    'pluginOptions' => [ ]
                ]
            ],
            'content' => function($model) {
                $content = $model->rate;
                if ($model->position) $content =' <span title="'.$model->position.'">'.$model->rate.'</span>';
                return $content;
            },
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
            'class' => 'kartik\grid\EditableColumn',
            'readonly' => function($model, $key, $index, $widget) {
                if ($model->is_deleted == true) {
                    return true; // do not allow editing of inactive records
                } else {
                    return false;
                }
            },
            'editableOptions' => [
                // 'name' => 'rate',
                'header' => 'Опозд.',
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                //'asPopover'  => false,
                'options' => [
                    'pluginOptions' => [ ]
                ]
            ],
            'attribute' => 'late',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'noWrap' => true,
            'label' => 'Задер.',
            'class' => 'kartik\grid\EditableColumn',
            'readonly' => function($model, $key, $index, $widget) {
                if ($model->is_deleted == true) {
                    return true; // do not allow editing of inactive records
                } else {
                    return false;
                }
            },
            'editableOptions' => [
                'header' => 'Задер.',
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                'options' => [
                    'pluginOptions' => [ ]
                ]
            ],
            'attribute' => 'delay',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'staff-salary',
            'template' => '{view} {update} {delete} {restore}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['staff-salary/view','id'=>$model->id_salary]);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customUrl);
                },
                'update' => function ($url, $model, $key) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['staff-salary/update','id'=>$model->id_salary]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                        $customUrl,
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'id' => $model->id_salary,
                                ]
                            ]
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['staff-salary/delete','id'=>$model->id_salary]);
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>',
                        $customUrl,
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'id' => $model->id_salary,
                                ]
                            ]
                        ]
                    );
                },
                'restore' => function ($url, $model, $key) {
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['staff-salary/restore', 'id'=>$model->id_salary]);
                    return Html::a('<span class="glyphicon glyphicon-ok"></span>',
                        $customUrl,
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'id' => $model->id_salary,
                                ]
                            ]
                        ]
                    );
                },
            ]
        ],

    ];


    ?>



    <?php
    Pjax::begin([
        'id' => 'grid',
    ]);

    echo GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $model, 
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
        'rowOptions' => function ($model) {
            if ($model->time_job_start_approve && $model->time_job_end_approve && $model->position_approve) {
                return ['class' => 'success'];
            } else if ($model->time_job_start_official && $model->time_job_end_official && !$model->time_job_start) {
                return ['class' => 'warning'];
            }
        },
        'pjax' => false, // pjax is set to always true for this demo,
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

    <script> mybutton123.onclick = function(e) {return false;} </script>
</div>
