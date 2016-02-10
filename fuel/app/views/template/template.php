<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::js(array('jquery-1.11.3.min.js', 'jquery-ui.min.js')); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/i18n/jquery-ui-i18n.min.js"></script>
    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.min.css" />
</head>
<body>
<?php echo $nav;?>
<div class="container" style="margin: 60px">
    <div class="col-md-12">
        <h1><?php echo $title; ?></h1>
        <hr>
        </ul>
        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <strong>Success</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger">
                <strong>Error</strong>
                <p>
                    <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-12">
        <?php echo $content; ?>
    </div>
</div>
</body>
</html>
