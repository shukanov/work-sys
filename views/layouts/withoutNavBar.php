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

    $items = [];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <?php
    if (strpos(Yii::$app->request->url, 'site%2Findex') != false) {
        echo '<div class="container">';
    } else {
        echo '<div class="container-fluid">';
    }
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

        if (e == 'index.php?r=staff/index') {
            var xmlHttp = new XMLHttpRequest();

            xmlHttp.open("GET", 'index.php?r=salary/has-unapproved-salaries&date_start=2016-01-01&date_end=2020-12-31', false); // true for asynchronous
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
