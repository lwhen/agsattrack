<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta name="language" content="en" />

	    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body class='easyui-layout default' style="display: none" id="body">
	    <?php echo $content; ?>
    </body>
</html>
