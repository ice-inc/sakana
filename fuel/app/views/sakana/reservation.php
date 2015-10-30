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
                                           Input::post('client.last_name', isset($client) ? $client->last_name:''),
                                           array('class' => 'form-control', 'placeholder'=>'姓'));?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<?php echo Form::label('名', 'first_name', array('class'=>'control-label'));?>
					<?php echo Form::input('first_name',
                                           Input::post('client.first_name', isset($client) ? $client->first_name:''),
                                           array('class' => 'form-control', 'placeholder'=>'名'));?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-5">
					<?php echo Form::label('電話番号', 'tell', array('class'=>'control-label'));?>
					<?php echo Form::input('tell',
                                           Input::post('client.tell', isset($client) ? $client->tell:''),
                                           array('class' => 'form-control', 'placeholder'=>'電話番号'));?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<?php echo Form::label('e-mail', 'email', array('class'=>'control-label'));?>
					<?php echo Form::input('email',
                                           Input::post('client.email', isset($client) ? $client->email:''),
                                           array('class' => 'form-control', 'placeholder'=>'e-mail'));?>
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
			<th>小計</th>
			<th>&nbsp;</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($commodity as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td>￥<?php echo $item->cost; ?></td>
			<td>
				<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<?php echo Form::label('number', 'number', array('class'=>'sr-only'));?>
                            <?php echo Form::input("order_child[$item->id][name]",
                                                   Input::post('order_child.number', isset($client->order->child->number) ? $client->order->child->number:''),
                                                   array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'個数'));?>
						</div>
					</div>
				</div>
			</td>
			<td>
				<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<?php echo Form::label('cost', 'cost', array('class'=>'sr-only'));?>
							<?php echo Form::input('cost',
                                                   null,
                                                   array('class' => 'col-md-4 form-control', 'rows' => 8, 'placeholder'=>'小計', 'readonly'));?>
						</div>
					</div>
				</div>
			</td>
			<td>
			    &nbsp;
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-3">
                            <?php echo Form::input("order_child[$item->id][cost]",
                                                   Input::post('order_child.cost', isset($client->order->child->cost) ? $client->order->child->cost:$item->cost),
                                                   array('class' => 'hidden'));?>
                        </div>
                    </div>
                </div>
			</td>
        <td>
            &nbsp;
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">
                        <?php echo Form::input("order_child[$item->id][price]",
                                               Input::post('order_child.price', isset($client->order->child->price) ? $client->order->child->cost:$item->price),
                                               array('class' => 'hidden'));?>
                    </div>
                </div>
            </div>
        </td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>

<div class="form-group">
	<div class="col-xs-2">
		<?php echo Form::label('合計', 'price', array('class'=>'control-label'));?>
		<?php echo Form::input('price',
                               null,
                               array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'合計', 'readonly'));?>
	</div>
</div>

<div class="form-group">
	<div class="col-xs-2">
		<?php echo Form::label('受取日', 'date', array('style'=>'control-label'));?>
		<?php echo Form::input('date',
                               Input::post('order_child.date', isset($client->order->child->date) ? $client->order->child->date:''),
                               array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'受取日'));?>
	</div>
</div>

<br>

<div class="form-group">
	<label class='control-label'>&nbsp;</label>
	<?php echo Form::submit('submit', '予約する', array('class' => 'btn btn-primary')); ?>
</div>

<?php echo Form::close();?>

</fieldset>

<link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
<?php echo Asset::js(array('jquery-1.11.3.min.js', 'jquery-ui.min.js')); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/i18n/jquery-ui-i18n.min.js"></script>
<script type="text/javascript">
	$(function() {
		$.datepicker.setDefaults($.datepicker.regional['ja']);
		$('#form_date').datepicker({ dateFormat: 'yy/mm/dd' });
	});
</script>

<?php else: ?>
<h3>商品が登録されていません</h3>

<?php endif; ?><p>
