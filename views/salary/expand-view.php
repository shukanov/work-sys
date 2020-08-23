<?php
use yii\helpers\Html;
use kartik\grid\GridView;

use kartik\grid\DataColumn;
use kartik\editable\Editable;
use kartik\grid\EditableColumnAction;

use yii\data\ActiveDataProvider;
use yii\db\Query;

use yii\helpers\VarDumper;

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a('Создать Expand', ['staff-salary-extras/create'], ['class' => 'btn btn-success']) ?>
</p>

<?php
$gridColumns = [
    /*    [
            'label' => '№',
            // 'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'id_extra',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],*/

    [
        'label' => 'Дата',
        'noWrap' => true,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'value' => function($model) {
            return Yii::$app->formatter->asDate($model->datetime, 'php:d.m H:i');
        },
    ],

    [
        'label' => 'Комментарии',
        'noWrap' => true,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'value' => function($model) {
            return ($model->comment);
        },
        'hAlign' => 'center',
        'vAlign' => 'center',
        'width' => "1024px",
    ],

    [
        'label' => 'Сумма',
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'summ',
        'value' => function($model) {
            return ($model->summ);
        },
        'editableOptions' => [
            'inputType' => Editable::INPUT_TEXT,
            'asPopover' => false,
            'formOptions' => ['action' => ['/staff-salary-extras/edit-expand']],
        ],
        'hAlign' => 'center',
        'vAlign' => 'center',
        // 'width' => "1024px",
    ],

];
?>


<?php
Pjax::begin([
    'id' => 'grid',
]);

echo GridView::widget([
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'pjax' => true, // pjax is set to always true for this demo,
    'pjaxSettings'=>[
        'options'=>[
            'enablePushState'=>false,
        ],
    ],
    'bordered' => true,
    'responsive' => true,
    'hover' => true,
    'persistResize' => false,
]);

Pjax::end();
?>