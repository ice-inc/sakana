<h2>予約編集</h2>
<br>

<fieldset>
    <?php echo Form::open(array('name'=>'form1'));?>

    <div class="form-inline">
        <div class="row">
            <div class="form-group">
                <div class="col-xs-3">
                    <?php echo Form::label('姓', 'last_name', array('class'=>'control-label'));?>
                    <?php echo Form::input('last_name',
                                           Input::post('last_name', isset($client) ? $client->last_name:$post->last_name),
                                           array('class' => 'form-control', 'placeholder'=>'姓'));?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <?php echo Form::label('名', 'first_name', array('class'=>'control-label'));?>
                    <?php echo Form::input('first_name',
                                           Input::post('first_name', isset($client) ? $client->first_name:$post->first_name),
                                           array('class' => 'form-control', 'placeholder'=>'名'));?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5">
                    <?php echo Form::label('電話番号', 'tell', array('class'=>'control-label'));?>
                    <?php echo Form::input('tell',
                                           Input::post('tell', isset($client) ? $client->tell:$post->tell),
                                           array('class' => 'form-control', 'placeholder'=>'電話番号'));?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-4">
                    <?php echo Form::label('e-mail', 'email', array('class'=>'control-label'));?>
                    <?php echo Form::input('email',
                                           Input::post('email', isset($client) ? $client->email:$post->email),
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
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($post->order->order_child as $item): ?>
            <tr>
                <td><?php echo $item->commodity->name; ?></td>
                <td>￥<?php echo $item->commodity->cost; ?></td>
                <td>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <?php echo Form::label('number', 'number', array('class'=>'sr-only'));?>
                                <?php echo Form::input("order_child[$item->id][number]",
                                                       Input::post('order_child.number', isset($order->order_child) ? $order->order_child->number:$item->number),
                                                       array('class'=>'col-md-8 form-control', 'rows'=>'8', 'placeholder'=>'個数','onChange'=>"price"));?>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <?php echo Form::label('cost', 'cost', array('class'=>'sr-only'));?>
                                <?php echo Form::input("order_child[$item->id][cost]",
                                                       '0',
                                                       array('class' => 'col-md-4 form-control', 'rows' => '8', 'placeholder'=>'小計', 'readonly'));?>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    &nbsp;
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <?php echo Form::input("order_child[$item->id][commodity_id]",
                                                       Input::post('order_child.commodity_id', isset($order->order_child) ? $order->order_child->commodity_id:$item->commodity_id),
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
                                <?php echo Form::input("order_child[$item->id][cost]",
                                                       Input::post('order_child.cost', isset($order->order_child) ? $order->order_child->cost:$item->commodity->cost),
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
                                                       Input::post('order_child.price', isset($order->order_child) ? $order->order_child->cost:$item->commodity->price),
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
                                   '0',
                                   array('class'=>'col-md-8 form-control', 'rows' => '8', 'placeholder'=>'合計', 'readonly'));?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-2">
            <?php echo Form::label('受取日', 'date', array('style'=>'control-label'));?>
            <?php echo Form::input('date',
                                   Input::post('date', isset($order->order_child->date) ? $order->order_child->date:$post->order->date),
                                   array('class' => 'col-md-8 form-control', 'rows' => '8', 'placeholder'=>'受取日'));?>
        </div>
    </div>

    <br>

    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', '変更する', array('class' => 'btn btn-primary')); ?>
    </div>

    <?php echo Form::close();?>

</fieldset>


<script type="text/javascript">
    $(function() {
        $.datepicker.setDefaults($.datepicker.regional['ja']);
        $('#form_date').datepicker({ dateFormat: 'yy/mm/dd' });
    });
</script>
