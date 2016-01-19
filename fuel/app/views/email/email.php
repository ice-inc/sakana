<!DOCTYPE html>

<head>
    <?php echo Asset::css('bootstrap.css');?>
</head>

<body>
    <div class="center-block" style="width: 100%; text-align: center;">

        <h1 style="font-size: 10em;">明日の予約一覧</h1>

    </div>

    <?php if ($client): ?>

        <h2>予約</h2>
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

                        <p>合計
                            <?php echo $item->order->price;?>円</p>

                    </div>
                </div>
            </div>
            <?php endforeach;?>

                <?php else: ?>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        <h2>予約はありません</h2>
                    </div>

                    <?php endif; ?>
</body>

</html>
