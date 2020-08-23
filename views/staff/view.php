<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

use kartik\widgets\FileInput;
use kartik\select2\Select2;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->last_name . ' ' . $model->first_name . ' ' . $model->second_name) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id_staff], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_staff], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_staff',
        'last_name',
        'first_name',
        'second_name',
        'id_telegram',
        'telegram_username',
        [
            'attribute' => 'location.id_location',
            'label' => 'Id Location',
        ],
        'status',
        'state',
        'date_start',
        'date_start_approve:boolean',
        'date_end',
        'date_start_official',
        'date_end_official',
        'personnel_number',
        'id_position_official',
        'unique_excel_name',
        'sex',
        'phone',
        'email:email',
        'date_of_birth',
        'always_show:boolean',
        'vk',
        'instagram',
        'inn',
        'snils',
        'passport_number',
        'passport_date',
        'passport_authority',
        'place_of_birth',
        'passport_first_page',
        'passport_second_page',
        'address_home',
        'address_register',
        'length_of_service',
        'family_members',
        'family_status',
        'uniform_size',
        'comment:ntext',
        'education',
        'health_card',
        'military_id',
        'info',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4><?= ' '. Html::encode($model->location->location) ?></h4>
    </div>
    <?php 
    $gridColumnLocations = [
        'location',
        'chat_id',
        'short_name',
        'alternative_names',
        'official_name',
        'address',
        '2gis',
        'first_shift_min_for_late',
        'second_shift_min_for_late',
        'approve_min_for_delay',
        's_workweek_from',
        's_workweek_to',
        's_saturday_from',
        's_saturday_to',
        's_sunday_from',
        's_sunday_to',
        'sort',
        'show_in_reg',
        'show_in_salary',
        'last_online',
        'pre_order',
        'delivery',
        'photo',
    ];

    if (!is_null($model->location)) {
        echo DetailView::widget([
            'model' => $model->location,
            'attributes' => $gridColumnLocations]);
    }
    ?>
</div>

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
        'template' => '{view}',
        'buttons' => [
        'view' => function ($url, $model, $key) {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['files/view','id'=>$model['id']]);
        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customUrl);
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
