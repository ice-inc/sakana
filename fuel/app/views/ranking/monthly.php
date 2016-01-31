<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php echo Asset::css('bootstrap.css'); ?>
    </head>
    <body>
        <?php if ($result): ?>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>売り上げ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $key => $value):?>
                <tr>
                    <th>
                        <?php echo $key + 1;?>
                    </th>
                    <td>
                        <?php echo $value['name'];?>
                    </td>
                    <td>
                        <?php echo $value['sum_number'];?>匹
                    </td>
                    <td>
                        ￥<?php echo number_format($value['sales']);?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <?php else: ?>

        <div class="pull-left">
            <div class="center-block" style="width: 100%; text-align: center;">
                <h3>データがありません</h3>
            </div>
        </div>
        <?php endif; ?>
    </body>
</html>
