<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StaffPositions */

$this->title = 'Create Staff Positions';
$this->params['breadcrumbs'][] = ['label' => 'Staff Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-positions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
