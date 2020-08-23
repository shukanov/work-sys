<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
// use kartik\daterange\DateRangePicker;
use kartik\grid\GridView;

$this->title = 'Места';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="locations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать место', ['create'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('Сложный поиск', '#', ['class' => 'btn btn-info search-button']) ?>-->
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        // 'id_location',
        [
            'attribute' => 'id_location',
            'label' => 'Код <br>локации',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'location',
            'label' => 'Название <br>локации',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'short_name',
            'label' => 'Сокращённое <br>имя',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'alternative_names',
            'label' => 'Альтернативное <br>название',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'official_name',
            'label' => 'Официальное <br>название',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'location',
        // // 'chat_id',
        // 'short_name',
        // 'alternative_names',
        // 'official_name',
        [
            'attribute' => 'address',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => '2gis',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'first_shift_min_for_late',
            'label' => '1-ая <br>смена <br>мин. <br>за <br>опоздание',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'second_shift_min_for_late',
            'label' => '2-ая <br>смена <br>мин. <br>за <br>опоздание',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'approve_min_for_delay',
            'label' => 'Утвердить <br>мин. <br>задержки',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'address',
        // '2gis',
        // 'first_shift_min_for_late',
        // 'second_shift_min_for_late',
        // 'approve_min_for_delay',
        [
            'attribute' => 's_workweek_from',
            'label' => 'Рабочая <br>неделя <br>от',
            'encodeLabel' => false,
            // 'filter' =>   DatePicker::widget([
            //     'name' => 'created_at',
            //     'pluginOptions' => [
            //         'format' => 'hh:ii:ss',
            //         // 'todayHighlight' => true
            //     ],
            //     'convertFormat' => true,
            // ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 's_workweek_to',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 's_saturday_from',
            'label' => 'Суббота <br>от',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 's_saturday_to',
            'label' => 'Суббота <br>по',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 's_workweek_from',
        // 's_workweek_to',
        // 's_saturday_from',
        // 's_saturday_to',
        [
            'attribute' => 's_sunday_from',
            'label' => 'Воскресенье <br>с',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 's_sunday_to',
            'label' => 'Воскресенье <br>по',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'sort',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'show_in_reg',
            'format' => 'boolean',
            'label' => 'Показать <br>регистрацию',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 's_sunday_from',
        // 's_sunday_to',
        // 'sort',
        // 'show_in_reg:boolean',
        [
            'attribute' => 'show_in_salary',
            'format' => 'boolean',
            'label' => 'Показать <br>в <br>зарплате',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'last_online',
            'label' => 'Последний <br>онлайн',
            'encodeLabel' => false,
            'filter' =>   DateTimePicker::widget([
                'name' => 'last_online',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'pre_order',
            'format' => 'boolean',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'delivery',
            'format' => 'boolean',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'show_in_salary:boolean',
        // 'last_online',
        // 'pre_order:boolean',
        // 'delivery:boolean',
        // 'photo',
        [
            'attribute' => 'photo',
            'noWrap' => true,
            'format' => 'raw',
            'filter' => false,
            'value' => function($model) {

                $options = ['style' => [
                    'width' => '25em',
                    'height' => '25em',
                    ]
                ];
                
                return Html::img("@web/" . $model->photo, $options);
            //    return '<a href="'.Url::to(['r=site/grid?id_staff=1']).'">'.$model->staff->last_name . ' ' .$model->staff->first_name.'</a>';
            },
            //'staff.first_name',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'width' => '10px',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-locations']],
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
