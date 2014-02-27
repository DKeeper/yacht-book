<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 27.02.14
 * @time 9:11
 * Created by JetBrains PhpStorm.
 */
/* @var $this Controller */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
    <?php Yii::app()->clientScript->registerCoreScript('migrate'); ?>
    <?php Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD); ?>
    <style>
        html, body, #map_container {
            height: 100%;
            margin: 0px;
            padding: 0px
        }
    </style>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php echo $content; ?>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/tooltip.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=true&language=<?php echo Yii::app()->language; ?>"></script>
</body>
</html>