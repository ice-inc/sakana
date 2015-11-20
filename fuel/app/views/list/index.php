<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('sakana/index','商品一覧');?></li>
    <li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('sakana/create','商品登録');?></li>
    <li class='<?php echo Arr::get($subnav, "list" ); ?>'><?php echo Html::anchor('list/index/'.$date,'予約一覧');?></li>
    <li class='<?php echo Arr::get($subnav, "ranking" ); ?>'><?php echo Html::anchor('list/ranking','予約ランキング');?></li>
    <li class='<?php echo Arr::get($subnav, "earn" ); ?>'><?php echo Html::anchor('list/earn','売り上げ');?></li>
    <li class='<?php echo Arr::get($subnav, "order" ); ?>'><?php echo Html::anchor('order/create','予約');?></li>
    <li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('user/logout','ログアウト');?></li>
</ul>

<div class="center-block" style="width: 100%; text-align: center;">
    <h3><?php echo $date;?></h3>
    
    <h1 style="font-size: 10em;"><?php echo $day_of_month;?></h1>
    <!--button type="button" class="btn btn-default glyphicon glyphicon-chevron-left" aria-hidden="true"-->
    <?php echo Html::anchor('list/index/'.$before, '', array('class'=>"btn btn-default glyphicon glyphicon-chevron-left", 'aria-hidden'=>"true"));?>
    <!--/button>
    <button type="button" class="btn btn-default glyphicon glyphicon-chevron-right" aria-hidden="true"-->
    <?php echo Html::anchor('list/index/'.$next, '', array('class'=>"btn btn-default glyphicon glyphicon-chevron-right", 'aria-hidden'=>"true"));?>
    <!--/button-->
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
                    <?php echo Html::anchor('list/edit/'.$item->id,'編集', array('class'=>'btn btn-primary'));?>
                    <?php echo Html::anchor('list/complete/'.$item->id,'完了', array('class'=>'btn btn-success', 'onclick'=>"return confirm('完了しますか?')"));?>
                </div>
            </div>
        </div>
        <?php endforeach;?>

            <?php else: ?>
<div class="center-block" style="width: 100%; text-align: center;">
                <h1>予約がありません</h1>
</div>

                <?php endif; ?>