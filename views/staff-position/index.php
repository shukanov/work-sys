<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffPositionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Должности';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="staff-positions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать должность', ['create'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>-->
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        // 'id_position',
        // 'position',
        [
            'attribute' => 'position',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'default_rate',
            'label' => 'Ставка <br>по <br>умолчанию',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'default_rate',
        [
            'attribute' => 'bonus_hours',
            'label' => 'Бонусные <br>часы',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'bonus_rate',
            'label' => 'Бонусная <br>ставка',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'month_bonus',
            'label' => 'Месячный <br>бонус',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'real_salary',
            'label' => 'Реальная <br>зарплата',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'bonus_hours',
        // 'bonus_rate',
        // 'month_bonus',
        // 'real_salary',
        [
            'attribute' => 'show_in_telegram',
            'format' => 'boolean',
            'label' => 'Показать <br>в <br>Телеграм',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'bonus_sales',
            'label' => 'Бонусные <br>продажи',
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
            'attribute' => 'edit_salary',
            'format' => 'boolean',
            'label' => 'Изменить <br>зарплату',
            'encodeLabel' => false,
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'show_in_telegram:boolean',
        // 'bonus_sales',
        // 'sort',
        // 'edit_salary:boolean',
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-staff-positions']],
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
