<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Locations */

$this->title = 'Изменить локацию: ' . ' ' . $model->location;
$this->params['breadcrumbs'][] = ['label' => 'Локации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->location, 'url' => ['view', 'id' => $model->id_location]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="locations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'providerStaff' => $providerStaff,
    ]) ?>

</div>
