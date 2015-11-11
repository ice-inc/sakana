<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index" ); ?>'>
        <?php echo Html::anchor('sakana/index','商品一覧');?>
    </li>
    <li class='<?php echo Arr::get($subnav, "create" ); ?>'>
        <?php echo Html::anchor('sakana/create','商品登録');?>
    </li>
    <li class='<?php echo Arr::get($subnav, "list" ); ?>'>
        <?php echo Html::anchor('list/index','予約一覧');?>
    </li>

</ul>

<div class="center-block" style="width: 100%; text-align: center;">
    <h3><?php echo $date;?></h3>
    <h1 style="font-size: 10em;"><?php echo $day_of_month;?></h1>
</div>

<?php if ($client): ?>

    <?php foreach($client as $item):?>
        <br>
        <div class="pull-left">
            <div class="panel panel-default" style="margin:3px">
                <div class="panel-heading">
                    <p>
                        <?php echo "$item->last_name\t$item->first_name";?>
                    </p>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>個数</th>
                                <th>合計</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($item->order->order_child as $orders):?>
                                <tr>
                                    <th>
                                        <?php echo $orders->commodity->name;?>
                                    </th>
                                    <td>
                                        <?php echo $orders->commodity->price;?>円
                                    </td>
                                    <td>
                                        <?php echo $orders->number;?>匹
                                    </td>
                                    <td>
                                        <?php echo $orders->price;?>円
                                    </td>
                                </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>

                    <p>合計<?php echo $item->order->price;?>円</p>
                    <?php echo Html::anchor('sakana/edit/'.$item->id,'編集', array('class'=>'btn btn-primary'));?>
                    <?php echo Html::anchor('sakana/delete/'.$item->id,'完了', array('class'=>'btn btn-success'));?>
                </div>
            </div>
        </div>
        <?php endforeach;?>

            <?php else: ?>

                <h3>予約がありません</h3>

                <?php endif; ?>