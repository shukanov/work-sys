<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalary */

$name = '';

if (!empty($model->staff->last_name)) {
    $name .= $model->staff->last_name . ' ';
}

if (!empty($model->staff->first_name)) {
    $name .= $model->staff->first_name . ' ';
}

if (!empty($model->staff->second_name)) {
    $name .= $model->staff->second_name . ' ';
}

if (!empty($model->state)) {
    $name .= ' / ' . $model->state;
}

if (!empty($model->position)) {
    $name .= ' / ' . $model->position;
}

if (!empty($model->locations)) {
    $name .= ' / ' . $model->locations->location;
}

$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => 'Staff Salary', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-salary-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= $name ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a('Update', ['update', 'id' => $model->id_salary], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_salary], [
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
        'id_salary',
        'id_staff',
        'id_location',
        'id_position',
        'state',
        'time_job_start_command',
        'time_job_comment',
        'checkin_code',
        'time_job_zone',
        'time_job_start_wish',
        'time_job_end_wish',
        'time_job_start_official',
        'time_job_end_official',
        'time_job_start',
        'time_job_start_approve:datetime',
        'time_job_end_command',
        'time_job_end',
        'time_job_end_approve:datetime',
        'position',
        'position_approve',
        'rate',
        'salary',
        'late',
        'delay',
        'comment',
        'code',
        [
            'attribute' => 'type.id',
            'label' => 'Id Type',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Тип смены</h4>
    </div>
    <?php
        if (!empty($model->type)) {
            $gridColumnStaffSalaryType = [
                ['attribute' => 'id', 'visible' => false],
                'name',
            ];
            echo DetailView::widget([
                'model' => $model->type,
                'attributes' => $gridColumnStaffSalaryType    ]);
        }
    ?>
</div>
