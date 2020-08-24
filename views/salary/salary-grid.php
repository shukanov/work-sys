<?php

use yii\widgets\Pjax;
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
//use kartik\grid\GridView;
//use kartik\grid\SerialColumn;

//use kartik\widgets\DynaGrid;

use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
<<<<<<< Updated upstream
=======
use kartik\alert\Alert;
>>>>>>> Stashed changes

//use kartik\grid\Editable;
//use kartik\grid\EditableColumn;

use kartik\grid\DataColumn;
use kartik\editable\Editable;
use kartik\grid\EditableColumnAction;

use yii\data\ActiveDataProvider;
use yii\db\Query;

// use kartik\bs4dropdown\ButtonDropdown;
use yii\helpers\VarDumper;

use app\models\StaffSalaryExtras;
<<<<<<< Updated upstream
=======
use app\models\Salary;
>>>>>>> Stashed changes

$this->title = 'Сводная таблица по зарплате';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
<<<<<<< Updated upstream
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <?php
        echo '<thead>';
        echo '<tr>';
        echo '<th score="col">' . 'Фамилия' . '</th>';
        echo '<th score="col">' . 'Имя' . '</th>';
        echo '<th score="col">' . 'Отчество' . '</th>';
        echo '<th score="col">' . 'Зарплата' . '</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
        foreach ($staffAllAndSalary as $staffAndSalary) {
            echo '<tr>';
            echo '<td score="col">' . $staffAndSalary['last_name']. '</td>';
            echo '<td score="col">' . $staffAndSalary['first_name']. '</td>';
            echo '<td score="col">' . $staffAndSalary['second_name']. '</td>';
            echo '<td score="col">' . $staffAndSalary['summ']. '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        ?>
    </table>
=======
    <?php
    $messages = Yii::$app->session->getFlash('warning');

    if(Yii::$app->getSession()->hasFlash('warning')) {
        foreach ($messages as $message) {
            echo Alert::widget([
                'type' => Alert::TYPE_DANGER,
                'showSeparator' => true,
                'title' => $message['title'],
                'body' => $message['body'],
            ]);
        }
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?=Html::beginForm(
            [
                'generate-rko',
            ],
            'post'
        );
        ?>
        <div style="display:flex; flex-direction: row; justify-content: flex-start;">
        <div>
        <?= Html::input('text', 'reason', '', ['class' => 'form-control', 'placeholder' => 'Введите основание']) ?>
        </div>
        <div style="margin-left:1em;">
        <?= Html::a(
            'Сгенерировать РКО для всех сотрудников',
            ['generate-rko'],
            [
                'class' => 'btn btn-success',
                'data' => [
                    'method' => 'post',
                    'params' => [
                        'date_start' => $dateStart,
                        'date_end' => $dateEnd
                    ]
                ]
            ]
        )
        ?>
        </div>
        </div>
        <?= Html::endForm();?>
    </div>

    <?php
    Pjax::begin([
        'id' => 'grid',
    ]);

    echo GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            'last_name:text:Фамилия',
            'first_name:text:Имя',
            'second_name:text:Отчество',
            'summ' => [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Зарплата<br>до вычета<br>НДС',
                'encodeLabel' => false,
                'content' => function($model) {
                    if (!empty($model)) {
                        $summ = Salary::calculateSalary($model['id_staff']);
                        return $summ;
                    }
                },
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'pageSummary' => true
            ]
        ], // check the configuration for grid columns by clicking button above
        //'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
        'pjax' => true, // pjax is set to always true for this demo,
        'pjaxSettings'=>[
            'options'=>[
                'enablePushState'=>false,
            ],
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
    ]);

    Pjax::end();
    ?>
>>>>>>> Stashed changes
</div>
