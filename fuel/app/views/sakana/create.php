<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('sakana/index','商品一覧');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('sakana/create','商品登録');?></li>
</ul>
<?php echo render('sakana/_form'); ?>
