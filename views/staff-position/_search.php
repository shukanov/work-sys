<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaffPositionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-staff-positions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_position')->textInput(['placeholder' => 'Id Position']) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?>

    <?= $form->field($model, 'default_rate')->textInput(['placeholder' => 'Default Rate']) ?>

    <?= $form->field($model, 'bonus_hours')->textInput(['placeholder' => 'Bonus Hours']) ?>

    <?= $form->field($model, 'bonus_rate')->textInput(['placeholder' => 'Bonus Rate']) ?>

    <?php /* echo $form->field($model, 'month_bonus')->textInput(['placeholder' => 'Month Bonus']) */ ?>

    <?php /* echo $form->field($model, 'real_salary')->textInput(['placeholder' => 'Real Salary']) */ ?>

    <?php /* echo $form->field($model, 'show_in_telegram')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'bonus_sales')->textInput(['placeholder' => 'Bonus Sales']) */ ?>

    <?php /* echo $form->field($model, 'sort')->textInput(['placeholder' => 'Sort']) */ ?>

    <?php /* echo $form->field($model, 'edit_salary')->checkbox() */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
