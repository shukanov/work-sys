<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Locations */

$this->title = 'Location';
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locations-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?=  Html::encode($model->location) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Изменить', ['update', 'id' => $model->id_location], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id_location], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Хотите удалить эту локацию?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_location',
        'location',
        'chat_id',
        'short_name',
        'alternative_names',
        'official_name',
        'address',
        '2gis',
        'first_shift_min_for_late',
        'second_shift_min_for_late',
        'approve_min_for_delay',
        's_workweek_from',
        's_workweek_to',
        's_saturday_from',
        's_saturday_to',
        's_sunday_from',
        's_sunday_to',
        'sort',
        'show_in_reg:boolean',
        'show_in_salary:boolean',
        'last_online',
        'pre_order:boolean',
        'delivery:boolean',
        'photo',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
</div>
