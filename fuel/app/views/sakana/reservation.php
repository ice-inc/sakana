<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('sakana/index','商品一覧');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('sakana/create','商品登録');?></li>
</ul>
<h2>予約</h2>
<br>
<?php if ($commodity): ?>
	<fieldset>
	<div class="form-inline">
		<?php echo Form::open();?>
		<div class="row">
					<div class="form-group">
						<div class="col-xs-3">
					<?php echo Form::label('姓', 'last_name', array('class'=>'control-label'));?>
					<?php echo Form::input('last_name',
					Input::post('last_name', isset($client) ? $client->last_name:''),
					array('class' => 'col-md-4 form-control', 'placeholder'=>'姓'));
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<?php echo Form::label('名', 'first_name', array('class'=>'control-label'));?>
					<?php echo Form::input('first_name',
					Input::post('first_name', isset($client) ? $client->first_name:''),
					array('class' => 'col-md-4 form-control', 'placeholder'=>'名'));
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<?php echo Form::label('電話番号', 'tell', array('class'=>'control-label'));?>
					<?php echo Form::input('tell',
					Input::post('tell', isset($client) ? $client->tell:''),
					array('class' => 'col-md-4 form-control', 'placeholder'=>'電話番号'));
					?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<?php echo Form::label('e-mail', 'email', array('class'=>'control-label'));?>
					<?php echo Form::input('email',
					Input::post('email', isset($client) ? $client->email:''),
					array('class' => 'col-md-4 form-control', 'placeholder'=>'e-mail'));
					?>
				</div>
			</div>
		</div>
		</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th>商品名</th>
			<th>価格</th>
			<th>個数</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($commodity as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td>￥<?php echo $item->cost; ?></td>
			<td>
				<div class="row">
				<div class="col-xs-2">
				<?php echo Form::input('number',
					Input::post('number', isset($order) ? $order->number:''),
					array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'個数'));
				?>
			</div>
			</div>
		</td>

		</tr>
<?php endforeach; ?>	</tbody>
</table>
</div>
<div class="form-group">
	<label class='control-label'>&nbsp;</label>
	<?php echo Form::submit('submit', '予約する', array('class' => 'btn btn-primary')); ?>
</div>
<?php echo Form::close();?>
</fieldset>

<?php else: ?>
<h3>商品が登録されていません</h3>

<?php endif; ?><p>
