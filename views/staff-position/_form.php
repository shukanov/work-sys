<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffPositions */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="staff-positions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <!-- <?= $form->field($model, 'id_position')->textInput(['placeholder' => 'Id Position']) ?> -->

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?>

    <?= $form->field($model, 'default_rate')->textInput(['placeholder' => 'Default Rate']) ?>

    <?= $form->field($model, 'bonus_hours')->textInput(['placeholder' => 'Bonus Hours']) ?>

    <?= $form->field($model, 'bonus_rate')->textInput(['placeholder' => 'Bonus Rate']) ?>

    <?= $form->field($model, 'month_bonus')->textInput(['placeholder' => 'Month Bonus']) ?>

    <?= $form->field($model, 'real_salary')->textInput(['placeholder' => 'Real Salary']) ?>

    <?= $form->field($model, 'show_in_telegram')->checkbox() ?>

    <?= $form->field($model, 'bonus_sales')->textInput(['placeholder' => 'Bonus Sales']) ?>

    <?= $form->field($model, 'sort')->textInput(['placeholder' => 'Sort']) ?>

    <?= $form->field($model, 'edit_salary')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
