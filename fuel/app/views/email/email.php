<div class="center-block" style="width: 100%; text-align: center;">
    <h1>明日の予約一覧</h1>
</div>
<br>

<?php if ($client): ?>

    <div class="pull-left">
        <div class="panel panel-primary" style="margin:3px">
            <div class="panel-heading">
                <h4>
                    <?php echo "予約全体";?>
                </h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>商品名</th>
                            <th>個数</th>
                            <th>合計:原価</th>
                            <th>合計:定価</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach($total as $key => $value):?>
                        <tr>
                            <th>
                                <?php echo $value['name'];?>
                            </th>
                            <td>
                                <?php echo $value['number'];?>匹
                            </td>
                            <td>
                                <?php echo number_format($value['cost']);?>円
                            </td>
                            <td>
                                <?php echo number_format($value['price']);?>円
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php foreach($client as $item):?>
        <div class="pull-left">
            <div class="panel panel-primary" style="margin:3px">
                <div class="panel-heading">
                    <h4>
                        <?php echo "$item->last_name\t$item->first_name";?>  合計<?php echo number_format($item->order->price);?>円
                    </h4>
                </div>
                    <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>商品名</th>
                                <th>定価</th>
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
                                        <?php echo number_format($orders->commodity->price);?>円
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
                </div>
            </div>
        </div>
    <?php endforeach;?>
    
<?php else: ?>
    <div class="center-block" style="width: 100%; text-align: center;">
        <h2>予約はありません</h2>
    </div>
<?php endif; ?>