<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffPositions */

$this->title = 'Update Staff Positions: ' . ' ' . $model->id_position;
$this->params['breadcrumbs'][] = ['label' => 'Staff Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_position, 'url' => ['view', 'id' => $model->id_position]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-positions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
