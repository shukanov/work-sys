<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffSalarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\StaffPositions;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Staff Salary';
$this->params['breadcrumbs'][] = $this->title; 
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="staff-salary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Staff Salary', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        // [
        //     'attribute' => 'id_type',
        //     'noWrap' => true,
        //     'format' => 'raw',
        //     'value' => function($model) {
        //         $options = ['style' => [
        //             'width' => '2em',
        //             'height' => '2em',
        //             ]
        //         ];
                
        //         if (!is_null($model->type)) {
        //             if ($model->type->name == 'Добавленная через сайт (вручную)') {
        //                 return Html::img("@web/staff-salary/staff-salary-type-icons/manually.png", $options);
        //             } elseif ($model->type->name == 'Не открытая') {
        //                 return Html::img("@web/staff-salary/staff-salary-type-icons/notOpen.png", $options);
        //             } elseif ($model->type->name == 'Удалённая') {
        //                 return Html::img("@web/staff-salary/staff-salary-type-icons/delete.png", $options);
        //             } elseif ($model->type->name == 'Успешно закрытая') {
        //                 return Html::img("@web/staff-salary/staff-salary-type-icons/success.png", $options);
        //             }
        //         }

        //         return Html::img("@web/staff-salary/staff-salary-type-icons/null.png", $options);
        //        // return '<a href="'.Url::to(['r=site/grid?id_staff=1']).'">'.$model->staff->last_name . ' ' .$model->staff->first_name.'</a>';
        //     },
        //     //'staff.first_name',
        //     'hAlign' => 'center',
        //     //'vAlign' => 'middle',
        //     'width' => '10px',
        // ],
        // [
        //     'attribute' => 'id_salary',
        //     'label' => 'ID зарплаты',
        //     'format' => 'raw',
        //     'value' => function($model) {
        //         if ($model->is_deleted == true) {
        //         return '<span style="text-decoration: line-through;">' . $model->id_salary . '</span>';
        //         } else {
        //         return $model->id_salary;
        //         }
        //     }
        // ],
        // 'id_staff',
        [
            'attribute' => 'id_staff',
            'format' => 'raw',
            'label' => 'ФИО',
            'value' => function($model){
                if ($model->staff){
                    if ($model->is_deleted == true) {
                        return '<span style="text-decoration: line-through;">' . $model->staff->last_name . " " . $model->staff->first_name . " " . $model->staff->second_name . '</span>';
                    } else {
                        return $model->staff->last_name . " " . $model->staff->first_name . " " . $model->staff->second_name;
                    }
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Staff::find()->asArray()->all(), 'id_staff', 'id_staff'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Staff', 'id' => 'grid-staff-salary-search-id_staff']
        ],

        [
            'attribute' => 'id_location',
            'format' => 'raw',
            'label' => 'Локация',
            'value' => function($model){
                if ($model->locations) {
                    if ($model->is_deleted == true) {
                        return '<span style="text-decoration: line-through;">' . $model->locations->location . '</span>';
                    } else {
                        return $model->locations->location;
                    }
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->asArray()->all(), 'id_location', 'id_location'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Locations', 'id' => 'grid-staff-salary-search-id_location']
        ],
       
        [
            'attribute' => 'state',
            'label' => 'Город',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->state . '</span>';
                } else {
                return $model->state;
                }
            }
        ],
        // 'time_job_start_command',
        [
            'attribute' => 'time_job_start_command',
            'label' => 'Официальное время начало работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_start_command . '</span>';
                } else {
                return $model->time_job_start_command;
                }
            }
        ],
        // 'time_job_comment',
        [
            'attribute' => 'time_job_comment',
            'label' => 'Комментарии о работе',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_comment . '</span>';
                } else {
                return $model->time_job_comment;
                }
            }
        ],
        // 'checkin_code',
        [
            'attribute' => 'checkin_code',
            'label' => 'Код регистрации',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->checkin_code . '</span>';
                } else {
                return $model->checkin_code;
                }
            }
        ],
        // 'time_job_zone',
        [
            'attribute' => 'time_job_zone',
            'label' => 'Временная зона работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_zone . '</span>';
                } else {
                return $model->time_job_zone;
                }
            }
        ],
        // 'time_job_start_wish',
        [
            'attribute' => 'time_job_start_wish',
            'label' => 'Время начала работы по желанию',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_start_wish . '</span>';
                } else {
                return $model->time_job_start_wish;
                }
            }
        ],
        // 'time_job_end_wish',
        [
            'attribute' => 'time_job_end_wish',
            'label' => 'Время окончания работы по желанию',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_end_wish . '</span>';
                } else {
                return $model->time_job_end_wish;
                }
            }
        ],
        // 'time_job_start_official',
        [
            'attribute' => 'time_job_start_official',
            'label' => 'Официальное время начало работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_start_official . '</span>';
                } else {
                return $model->time_job_start_official;
                }
            }
        ],
        // 'time_job_end_official',
        [
            'attribute' => 'time_job_end_official',
            'label' => 'Официальное время окончания работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_end_official . '</span>';
                } else {
                return $model->time_job_end_official;
                }
            }
        ],
        // 'time_job_start',
        [
            'attribute' => 'time_job_start',
            'label' => 'Время начала работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_start . '</span>';
                } else {
                return $model->time_job_start;
                }
            }
        ],
        // 'time_job_start_approve:datetime',
        [
            'attribute' => 'time_job_start_approve',
            'label' => 'Подтверждения времени старта смены',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_start_approve . '</span>';
                } else {
                return $model->time_job_start_approve;
                }
            }
        ],
        'time_job_end_command',
        [
            'attribute' => 'time_job_end_command',
            'label' => 'Команда окончания времени',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_end_command . '</span>';
                } else {
                return $model->time_job_end_command;
                }
            }
        ],
        // 'time_job_end',
        [
            'attribute' => 'time_job_end',
            'label' => 'Время окончания работы',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_end . '</span>';
                } else {
                return $model->time_job_end;
                }
            }
        ],
        // 'time_job_end_approve:datetime',
        [
            'attribute' => 'time_job_end_approve',
            'label' => 'Подтверждения времени окончания смены',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->time_job_end_approve . '</span>';
                } else {
                return $model->time_job_end_approve;
                }
            }
        ],
        // 'position',
        [
            'attribute' => 'position',
            'label' => 'Позиция',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->position . '</span>';
                } else {
                return $model->position;
                }
            }
        ],
        // 'position_approve',
        [
            'attribute' => 'position_approve',
            'label' => 'Утвержденная позиция',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->position_approve . '</span>';
                } else {
                return $model->position_approve;
                }
            }
        ],
        // 'rate',
        [
            'attribute' => 'rate',
            'label' => 'Ставка',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->rate . '</span>';
                } else {
                return $model->rate;
                }
            }
        ],
        // 'salary',
        [
            'attribute' => 'salary',
            'label' => 'Зарплата',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->salary . '</span>';
                } else {
                return $model->salary;
                }
            }
        ],
        // 'late',
        [
            'attribute' => 'late',
            'label' => 'Опоздания',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->late . '</span>';
                } else {
                return $model->late;
                }
            }
        ],
        // 'delay',
        [
            'attribute' => 'delay',
            'label' => 'Задержка',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->delay . '</span>';
                } else {
                return $model->delay;
                }
            }
        ],
        // 'comment',
        [
            'attribute' => 'comment',
            'label' => 'Комментарии',
            'format' => 'raw',
            'value' => function($model) {
                if ($model->is_deleted == true) {
                return '<span style="text-decoration: line-through;">' . $model->comment . '</span>';
                } else {
                return $model->comment;
                }
            }
        ],
        'code',
        // [
        //     'attribute' => 'id_type',
        //     'format' => 'raw',
        //     'label' => 'ID Типа',
        //     'value' => function($model){
        //         if ($model->type) {
        //             if ($model->is_deleted == true) {
        //             return '<span style="text-decoration: line-through;">' . $model->type->id . '</span>';
        //             } else {
        //             return $model->type->id;
        //             }
        //         }
        //     },
        //     'filterType' => GridView::FILTER_SELECT2,
        //     'filter' => \yii\helpers\ArrayHelper::map(\app\models\StaffSalaryType::find()->asArray()->all(), 'id', 'id'),
        //     'filterWidgetOptions' => [
        //         'pluginOptions' => ['allowClear' => true],
        //     ],
        //     'filterInputOptions' => ['placeholder' => 'Staff salary type', 'id' => 'grid-staff-salary-search-id_type']
        // ],
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
                    $customUrl = Yii::$app->getUrlManager()->createUrl(['staff-salary/update']);
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-staff-salary']],
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
    ]); ?>

</div>
