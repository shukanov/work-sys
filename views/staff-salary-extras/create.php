<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StaffSalaryExtras */

$this->title = 'Create Staff Salary Extras';
$this->params['breadcrumbs'][] = ['label' => 'Staff Salary Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-salary-extras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id_salary' => $id_salary,
        'id_staff' => $id_staff,
<<<<<<< Updated upstream
=======
        'id_location' => $id_location,
>>>>>>> Stashed changes
    ]) ?>

</div>
