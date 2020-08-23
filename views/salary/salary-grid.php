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

$this->title = 'Сводная таблица по зарплате';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
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
</div>
