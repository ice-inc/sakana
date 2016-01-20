<div id="result">
   <div class="center-block" style="width: 100%; text-align: center;">
    <h3><?php echo $formatted_date;?></h3>

    <h1 style="font-size: 10em;">
        <?php echo Html::anchor('list/index/'.$before,
                                '',
                                array('class'=>"btn btn-default glyphicon glyphicon-chevron-left", 'aria-hidden'=>"true"));?>
        <?php echo $day_of_month;?>
        <?php echo Html::anchor('list/index/'.$next,
                                '',
                                array('class'=>"btn btn-default glyphicon glyphicon-chevron-right", 'aria-hidden'=>"true"));?>
    </h1>
</div>
<br>
<?php if ($client): ?>

<?php foreach($client as $item):?>
<div class="pull-left">
    <div class="panel panel-primary" style="margin:3px">
        <div class="panel-heading">
            <div class="center-block" style="width: 100%; text-align: center;">
                <h4 style="margin:auto">
                    <?php echo "$item->last_name\t$item->first_name";?>
                </h4>
            </div>
        </div>

        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>個数</th>
                        <th>小計</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($item->order->order_child as $orders):?>
                    <tr>
                        <th>
                            <?php echo $orders->commodity->name;?>
                        </th>
                        <td>
                            <?php echo  number_format($orders->commodity->price);?>円
                        </td>
                        <td>
                            <?php echo $orders->number;?>匹
                        </td>
                        <td>
                            <?php echo number_format($orders->price);?>円
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php echo Html::anchor('list/edit/'.$item->id,'編集', array('class'=>'btn btn-primary pull-right', 'style'=>'margin-left:3px'));?>
            <?php echo Html::anchor('list/complete/'.$item->id,'完了', array('class'=>'btn btn-success pull-right', 'onclick'=>"return confirm('完了しますか?')", 'style'=>'margin-left:3px'));?>
            <h4 style="margin:auto" class="pull-right" style="margin:3px">合計<?php echo number_format($item->order->price);?>円</h4>
            
        </div>
    </div>
</div>
<?php endforeach;?>

<?php else: ?>
<div class="center-block" style="width: 100%; text-align: center;">
    <h1>予約がありません</h1>
</div>

<?php endif; ?>
</div>
