<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

$this->title = 'Файлы';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

$css = <<< CSS
    .modalbackground {
        margin: 0; /* убираем отступы */
        padding: 0; /* убираем отступы */
        position: fixed; /* фиксируем положение */
        top:0; /* растягиваем блок по всему экрану */
        bottom:0;
        left:0;
        right:0;
        background: rgba(0,0,0,0.5); /* полупрозрачный цвет фона */
        z-index:100; /* выводим фон поверх всех слоев на странице браузера */
        opacity:1; /* Делаем невидимым */
        pointer-events: auto; /* элемент невидим для событий мыши */
    }

    /* ширина диалогового окна и его отступы от экрана */
    .modalwindow {
        width: 100%;
        text-align: center;
        max-width: 450px;
        margin: 10% auto;
        padding: 2%;
        background: #fff;
        border-radius: 3px;
    }

    /* настройка заголовка */
    .modalwindow h3 {
        padding: 0;
        margin: 0;
    }

    /* оформление сообщение */
    .modalwindow p {
        padding: 0;
        margin: 4% 0 8% 0;
    }

    /* вид кнопки ЗАКРЫТЬ */
    .modalwindow a {
        display: block;
        color: #fff;
        background: #369;
        padding: 2%;
        margin: 0 auto;
        width: 50%;
        border-radius: 3px;
        text-align: center;
        text-decoration: none;
    }

    /* вид кнопки ЗАКРЫТЬ при наведении на нее мыши */
    .modalwindow a:hover {
        background: #47a;
    }
CSS;

$this->registerCss($css, ["type" => "text/css"], "errorModalWindow");

?>
<div class="files-index">

    <?php
        if (!empty($error)) {
            echo
            '<div id="error" class="modalbackground">
                <div class="modalwindow">
                    <h3>Ошибка!</h3>
                    <p>' . $error . '</p>
                    <a href=' . Yii::$app->request->scriptUrl . '?r=' . Yii::$app->request->get('r') . '>Закрыть</a>
                </div>
            </div>';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать файл', ['create'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>-->
    </p>

    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php  
    $gridColumn = [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return [
                    'checked' => $model->isChecked(),
                    'onchange' =>
                        "
                        let selectedRows = getCookie('selectedRowsOnPages');
                    
                        if (selectedRows !== undefined) {
                            selectedRows = JSON.parse(selectedRows);
                            
                            let indexInArray = null;
                            
                            selectedRows.forEach(
                                function(currentValue, index) {
                                    if (Object.keys(currentValue).indexOf('" . $model->id . "') != -1) {
                                        indexInArray = index;
                                    }
                                }
                            )
                            
                            if (indexInArray !== null) {
                                selectedRows.splice(indexInArray, 1);
                                selectedRows.push({" . $model->id . " : $(this).is(':checked')});
                                setCookie('selectedRowsOnPages', JSON.stringify(selectedRows));
                            } else {
                                selectedRows.push({" . $model->id . " : $(this).is(':checked')});
                                setCookie('selectedRowsOnPages', JSON.stringify(selectedRows));
                            }
                        } else {
                            selectedRows = new Array();
                            selectedRows.push({" . $model->id . " : $(this).is(':checked')});
                            setCookie('selectedRowsOnPages', JSON.stringify(selectedRows));
                        }
                        
                        console.log(selectedRows);
                        ",
                ];
            },
        ],
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        // 'header',
        [
            'attribute' => 'header',
            'label' => 'Заголовок <br>файла',
            'encodeLabel' => false,
            'filter' =>'<input type="text" class="form-control" name="FilesSearch[header]">',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'id_location',
            'label' => 'Локация',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model){
                if ($model->locations)
                {return $model->locations->location;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Locations::find()->asArray()->all(), 'id_location', 'location'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
            ],
            'filterInputOptions' => ['placeholder' => 'Введите локацию', 'id' => 'grid-files-search-id_location']
        ],
        [
            'attribute' => 'id_staff',
            'label' => 'ФИО',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model){
                if ($model->staff)
                {return $model->staff->last_name . " " . $model->staff->first_name . " " . $model->staff->second_name;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Staff::find()->asArray()->all(), 'id_staff', 'last_name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
            ],
            'filterInputOptions' => ['placeholder' => 'Введите фамилию', 'id' => 'grid-files-search-id_staff']
        ],
        // 'type',
        [
            'attribute' => 'type',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'photo',
            'noWrap' => true,
            'format' => 'raw',
            'label' => 'Фото',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function($model) {

                $options = ['style' => [
                    'width' => '25em',
                    'height' => '25em',
                    ]
                ];

                if ((strpos ($model->file, '.png') !== false ||
                    strpos ($model->file, '.jpg') !== false ||
                    strpos ($model->file, '.jpeg') !== false) &&
                    file_exists(Yii::getAlias('@webroot') . $model->file)) {
                    return Html::img($model->file, $options);
                } else {
                    return (Yii::getAlias('@webroot') . $model->file);
                }
            },
            //'staff.first_name',
            'hAlign' => 'center',
            //'vAlign' => 'middle',
            'width' => '10px',
        ],
        // 'i',
        [
            'attribute' => 'i',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'datetime',
            'label' => 'Дата <br>создания',
            'encodeLabel' => false,
            'filter' =>   DateTimePicker::widget([
                'name' => 'datetime',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'comment',
            'label' => 'Текстовый <br>комментарий <br>к <br>файлу',
            'encodeLabel' => false,
            // 'filter' => true,
            // 'filterInputOptions' => [
            //     'class' => 'form-control input-sm', 
            //     'id' => null
            // ],
            'filter' =>'<input type="text" class="form-control" name="FilesSearch[comment]">',
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        [
            'attribute' => 'storage_life',
            'label' => 'Дата <br>истечения <br>срока <br>годности',
            'encodeLabel' => false,
            'filter' =>   DatePicker::widget([
                'name' => 'storage_life',
                'pluginOptions' => [
                    'dateFormat' => 'YYYY-mm-dd',
                    'todayHighlight' => true,
                ],
            ]),
            'hAlign' => 'center',
            'vAlign' => 'middle',
        ],
        // 'datetime',
        // 'comment',
        // 'storage_life:date',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?=Html::beginForm(['files/download-files', 'id' => 'downloadForm'],'post', ['onsubmit' => "submitCallback();"]);?>
    <div style="width: 20em; display: flex;", id="downloadForm">
    <?php
    echo Html::hiddenInput(
            $name = 'selectionArray',
            $value = 0,
            $options =
            [
                'id' => 'hiddenSelect',
            ]
         );
    echo Select2::widget([
        'name' => 'download_type',
        'data' => [1 => "Объединенный", 2 => "По отдельности"],
        'options' => [
            'placeholder' => 'Выбери способ загрузки документов ...',
            'id' => 'selectDownloadType',
        ],
    ]);
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        selectDownloadType.onchange = function(e) {
            let select = document.getElementById('selectDownloadType');
            console.log(select.value);

            if (select.value == 1 && (document.getElementById('filenameInput') == null)) {
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("name", "filename");
                x.setAttribute("id", "filenameInput");
                x.setAttribute("style", "margin-left: 1em; width: 20em;");
                x.setAttribute("placeholder", "Введите имя файла...");
                x.setAttribute("class", "form-control");
                document.getElementById('downloadForm').insertBefore(x, document.getElementById('downloadSubmit'));
            } else if (select.value == 2 && (document.getElementById('filenameInput') != null)) {
                document.getElementById('filenameInput').remove();
            }
        }
        function submitCallback() {
            let hidden = document.getElementById('hiddenSelect');

            hidden.value = getCookie('selectedRowsOnPages');

            deleteCookie('selectedRowsOnPages');
        }
    </script>
    <?php
    if (!empty($_POST['download_type'])) {
        echo '<span>' . $_POST['download_type'] . '</span>';
    }
    ?>
    <?=Html::submitButton('Загрузить документы', ['class' => 'btn btn-info', 'id' => 'downloadSubmit','style' => 'margin-left: 1em;']);?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-files']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>
    <?= Html::endForm();?>

</div>
<script>
// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options = {}) {

  options = {
    path: '/',
    // при необходимости добавьте другие значения по умолчанию
    ...options
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}

function deleteCookie(name) {
  setCookie(name, "", {
    'max-age': -1
  })
}
</script>
