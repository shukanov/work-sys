<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<!--    <style>-->
<!--        div.kv-editable-inline {-->
<!--            display: block !important;-->
<!--        }-->
<!--    </style>-->
    <style>
        @media (min-width: 1200px) {
            .container {
                width: 1280px !important;
            }
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);    
    
    $items = [
            ['label' => 'Home', 'url' => ['/site/index']],
            /*['label' => 'Contact', 'url' => ['/site/contact']],*/
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->first_name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ];   
        
    if (!Yii::$app->user->isGuest) {
        $items [] = ['label' => 'Смены', 'url' => ['/site/grid']];
        $items [] = ['label' => 'Неподтвержденные смены', 'url' => ['/salary/index']];
        $items [] = ['label' => 'Сотрудники', 'url' => ['/staff/index']];
        $items [] = ['label' => 'Должности', 'url' => ['/staff-position/index']];
        //$items [] = ['label' => 'Staff Salary', 'url' => ['/staff-salary/index']];
        $items [] = ['label' => 'Места', 'url' => ['/locations/index']];
        $items [] = ['label' => 'Файлы', 'url' => ['/files/index']];
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <?php
        echo '<div class="container">';
    ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
<<<<<<< Updated upstream
        <?= Alert::widget() ?>
=======
>>>>>>> Stashed changes
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>
    function newMyWindow(e) {
<<<<<<< Updated upstream
        var h = 600,
            w = 1400;
        window.open(e, '', 'scrollbars=1,height='+Math.min(h, screen.availHeight)+',width='+Math.min(w, screen.availWidth)+',left='+Math.max(0, (screen.availWidth - w)/2)+',top='+Math.max(0, (screen.availHeight - h)/2));
=======
        let h = screen.availHeight * 0.73,
            w = screen.availWidth * 0.83;

        if (e == '/index.php?r=salary/index') {
            var xmlHttp = new XMLHttpRequest();

            let dates = 'date_start=' + document.getElementById('salaryDateRange1').value;
            dates = dates + '&date_end=' + document.getElementById('salaryDateRange2').value

            xmlHttp.open("GET", 'index.php?r=salary/has-unapproved-salaries&' + dates, false); // true for asynchronous
            xmlHttp.send(null);

            if (xmlHttp.responseText == 'true') {
                window.open(e, '', 'scrollbars=1,height=' + Math.min(h, screen.availHeight) + ',width=' + Math.min(w, screen.availWidth) + ',left=' + Math.max(0, (screen.availWidth - w) / 2) + ',top=' + Math.max(0, (screen.availHeight - h) / 2));
            }
        } else {
            window.open(e, '', 'scrollbars=1,height=' + Math.min(h, screen.availHeight) + ',width=' + Math.min(w, screen.availWidth) + ',left=' + Math.max(0, (screen.availWidth - w) / 2) + ',top=' + Math.max(0, (screen.availHeight - h) / 2));
        }
>>>>>>> Stashed changes
    }
</script>
</body>
</html>
<?php $this->endPage() ?>
