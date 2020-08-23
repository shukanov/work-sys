<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StaffSalaryExtras */

$this->title = $model->id_extra;
$this->params['breadcrumbs'][] = ['label' => 'Staff Salary Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-salary-extras-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Staff Salary Extras'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update-without-nav-bar', 'id' => $model->id_extra], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete-without-nav-bar', 'id' => $model->id_extra], [
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
        'id_extra',
        'id_staff',
        'id_salary',
        'id_location',
        'state',
        'datetime',
        'type',
        'comment',
        'summ',
        'approve',
        'timestamp',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
</div>
