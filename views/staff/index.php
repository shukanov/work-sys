<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
<<<<<<< Updated upstream
=======
use kartik\alert\Alert;
>>>>>>> Stashed changes
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use app\models\Locations;
use app\models\Staff;

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="staff-index">

<<<<<<< Updated upstream
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>-->
    </p>
=======
    <?php
    $message = Yii::$app->session->getFlash('warning');

    if (!empty($message)) {
        echo Alert::widget([
            'type' => Alert::TYPE_DANGER,
            'showSeparator' => true,
            'title' => $message['title'],
            'body' => $message['body'],
        ]);
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="display: flex; flex-direction: row; justify-content: flex-start;">
        <div>
        <?= Html::a('Создать сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <?=Html::beginForm(['salary/salary-grid'],'post');?>
        <div style="display: flex; flex-direction: row; justify-content: flex-start;">
        <div style="margin-left: 2em;">
        <?=
            DatePicker::widget([
                'name' => 'date_start',
                //'value' => date('yy-m-d'),
                'value' => '2016-01-01',
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'date_end',
                'separator' => 'до',
                'value2' => date('yy-m-') . date('t'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'options' => [
                    'id' => 'salaryDateRange1',
                    'style' => 'width: 10em;'
                ],
                'options2' => [
                    'id' => 'salaryDateRange2',
                    'style' => 'width: 10em;'
                ],
            ])
        ?>
        </div>
        <div>
        <?= Html::submitButton('Расчёт заработной платы', ['class' => 'btn btn-info', 'onclick' => "newMyWindow('/index.php?r=salary/index');"]);?>
        </div>
        <div>
        <?= Html::a('Расчёт заработной платы', ['salary/salary-grid'], ['class' => 'btn btn-success', 'onclick' => "newMyWindow('/index.php?r=salary/index');"]) ?>
        </div>
        <?= Html::endForm();?>
        </div>
        <!--<?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>-->
    </div>
>>>>>>> Stashed changes
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'id_staff',
            'value' => function($model) {
                    return $model->last_name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Staff::find()->asArray()->all(), 'id_staff', 'last_name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
            ],
            'filterInputOptions' => ['placeholder' => 'Введите фамилию', 'id' => 'grid-staff-search-id_staff'],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'first_name',
            'noWrap' => true,
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'second_name',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'id_telegram',
            'label' => 'ID <br>Телеграма',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'telegram_username',
            'label' => 'Имя <br>пользователя <br>Телеграм',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'telegram_username',
        [
            'attribute' => 'id_location',
            'label' => 'Название <br>локации',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model){
                if ($model->location)
                {return $model->location->location;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->asArray()->all(), 'id_location', 'location'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
            ],
            'filterInputOptions' => ['placeholder' => 'Введите локацию', 'id' => 'grid-staff-search-id_location']
        ],
        [
            'attribute' => 'status',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'state',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'date_start',
            'label' => 'Дата <br>начала',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'date_start',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'date_start_approve',
            'format' => 'boolean',
            'label' => 'Одобренная <br>дата <br>начала',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'date_end',
            'label' => 'Дата <br>окончания',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'date_end',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'date_start',
        // 'date_start_approve:boolean',
        // 'date_end',
        [
            'attribute' => 'date_start_official',
            'label' => 'Официальная <br>дата <br>начала',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'date_start_official',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'date_end_official',
            'label' => 'Официальная <br>дата <br>окончания',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'date_end_official',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'personnel_number',
            'label' => 'Персональный <br>номер',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'date_start_official',
        // 'date_end_official',
        // 'personnel_number',
        [
            'attribute' => 'unique_excel_name',
            'label' => 'Уникальное <br>имя <br>Excel',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'sex',
            'filter' => ['F' => 'Жен', 'M' => 'Муж'],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'phone',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'unique_excel_name',
        // 'sex',
        // 'phone',
        [
            'attribute' => 'email',
            'label' => 'Электронная <br>почта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'date_of_birth',
            'label' => 'Дата <br>рождения',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'date_of_birth',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'always_show',
            'format' => 'boolean',
            'label' => 'Показывается <br>всегда',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'vk',
            'label' => 'Ссылка <br>ВК',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'email:email',
        // 'date_of_birth',
        // 'always_show:boolean',
        // 'vk',
        [
            'attribute' => 'instagram',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'inn',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'snils',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'instagram',
        // 'inn',
        // 'snils',
        [
            'attribute' => 'passport_number',
            'label' => 'Номер <br>паспорта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'passport_date',
            'label' => 'Когда <br>выдан <br>паспорта',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'passport_date',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'passport_authority',
            'label' => 'Кем <br>выдан <br>паспорта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'place_of_birth',
            'label' => 'Место <br>рождения',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'passport_number',
        // 'passport_date',
        // 'passport_authority',
        // 'place_of_birth',
        [
            'attribute' => 'passport_first_page',
            'label' => 'Первая <br>страница <br>паспорта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'passport_second_page',
            'label' => 'Вторая <br>страница <br>паспорта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'address_home',
            'label' => 'Адрес <br>проживания',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'address_register',
            'label' => 'Место <br>регистрации',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'passport_first_page',
        // 'passport_second_page',
        // 'address_home',
        // 'address_register',
        [
            'attribute' => 'length_of_service',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'family_members',
            'label' => 'Члены <br>семьи',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'family_status',
            'label' => 'Семейный <br>статус',
            'encodeLabel' => false,
            // 'filter' => [
            //     'Да' => 'Да',
            //     'Никогда не был(а) в браке' => 'Никогда не был(а) в браке', 
            //     'Брак не зарегистрирован' => 'Брак не зарегистрирован',
            //     'Разведен(а) официально (развод зарегистрирован)' => 'Разведен(а) официально (развод зарегистрирован)'
            // ],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'uniform_size',
            'label' => 'Размер <br>униформы',
            'encodeLabel' => false,
            'filter' => [
                'XXS' => 'XXS',
                'XS' => 'XS',
                'S' => 'S',
                'M' => 'M',
                'L' => 'L',
                'XL' => 'XL',
                'XXL' => 'XXL',
                'XXXL' => 'XXXL',
            ],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'length_of_service',
        // 'family_members',
        // 'family_status',
        // 'uniform_size',
        [
            'attribute' => 'comment',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'education',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'health_card',
            'label' => 'Медицинская <br>карта',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'military_id',
            'label' => 'Военный <br>билет',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'info',
            // 'filter' => [
            //     'Всё понял!' => 'Всё понял!',
            //     'Не понял' => 'Не понял'
            // ],
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'comment:ntext',
        // 'education',
        // 'health_card',
        // 'military_id',
        // 'info',
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-staff']],
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
