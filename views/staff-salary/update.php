<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalary */

$this->title = 'Обновление Смены: ' . ' ' . $model->id_salary;
$this->params['breadcrumbs'][] = ['label' => 'Staff Salary', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_salary, 'url' => ['view', 'id' => $model->id_salary]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-salary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
