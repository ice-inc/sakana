<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('sakana/index','商品一覧');?></li>
    <li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('sakana/create','商品登録');?></li>
    <li class='<?php echo Arr::get($subnav, "list" ); ?>'><?php echo Html::anchor('list/index/'.$date,'予約一覧');?></li>
    <li class='<?php echo Arr::get($subnav, "ranking" ); ?>'><?php echo Html::anchor('list/ranking/'.$date.'/'.$date.'/'.$date,'予約ランキング');?></li>
    <li class='<?php echo Arr::get($subnav, "earn" ); ?>'><?php echo Html::anchor('list/earn/'.$date,'売り上げ');?></li>
    <li class='<?php echo Arr::get($subnav, "order" ); ?>'><?php echo Html::anchor('order/create','予約');?></li>
    <li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('user/logout','ログアウト');?></li>
</ul>
