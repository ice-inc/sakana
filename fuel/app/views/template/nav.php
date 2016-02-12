<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-7" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo \Fuel\Core\Uri::base();?>">Sakana</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-7">
            <ul class="nav navbar-nav">
                <li class='<?php echo Arr::get($subnav, "list" ); ?>'><?php echo Html::anchor('list/index/'.$date,'予約一覧');?></li>
                <li class='<?php echo Arr::get($subnav, "ranking" ); ?>'><?php echo Html::anchor('list/ranking/','予約ランキング');?></li>
                <li class='<?php echo Arr::get($subnav, "earn" ); ?>'><?php echo Html::anchor('list/daily_earn/'.$date,'売り上げ');?></li>
                <li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('sakana/index','商品一覧');?></li>
                <li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('sakana/create','商品登録');?></li>
                <li class='<?php echo Arr::get($subnav, "order" ); ?>'><?php echo Html::anchor('order/create','予約');?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('user/logout','ログアウト');?></li>
            </ul>
        </div>
    </div>
</nav>