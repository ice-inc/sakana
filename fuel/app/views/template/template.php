<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <?php echo Asset::css('bootstrap.css'); ?>
        <?php echo Asset::render('extra_css'); /*View毎の追加スタイルシート*/ ?>
        <style>
            body { margin: 40px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-12">
                <h1><?php echo $title; ?></h1>
                <hr>
                <?php echo $nav;?>
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
        <footer>
            <p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
            <p>
                <a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
                <small>Version: <?php echo e(Fuel::VERSION); ?></small>
            </p>

            <?php echo Asset::render('extra_js'); /*View毎の追加スクリプト*/ ?>
        </footer>
        </div>
    </body>
</html>