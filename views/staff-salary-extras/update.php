<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalaryExtras */

$this->title = 'Update Staff Salary Extras: ' . ' ' . $model->id_extra;
$this->params['breadcrumbs'][] = ['label' => 'Staff Salary Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_extra, 'url' => ['view', 'id' => $model->id_extra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-salary-extras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
