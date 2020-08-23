<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_location')->textInput(['placeholder' => 'Id Location']) ?>

    <?= $form->field($model, 'id_staff')->textInput(['placeholder' => 'Id Staff']) ?>

    <?= $form->field($model, 'id_salary')->textInput(['placeholder' => 'Id Salary']) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => 'Type']) ?>

    <?php /* echo $form->field($model, 'file')->textInput(['maxlength' => true, 'placeholder' => 'File']) */ ?>

    <?php /* echo $form->field($model, 'i')->textInput(['placeholder' => 'I']) */ ?>

    <?php /* echo $form->field($model, 'datetime')->textInput(['placeholder' => 'Datetime']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
