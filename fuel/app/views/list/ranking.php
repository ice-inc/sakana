<br>
<div class="pull-left">

<h2 style="margin:auto;">日別ランキング</h2>

<br>
    <div class="panel panel-info" style="margin:3px">
        <div class="panel-heading">
            <h4 style="margin:auto;">
                <div class="center-block" style="width: 100%; text-align: center;">
                    <?php echo Html::anchor("list/ranking/$before_day/$month/$year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-left", 'aria-hidden'=>"true"));?>
                    <?php echo "$daily";?>
                    <?php echo Html::anchor("list/ranking/$next_day/$month/$year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-right", 'aria-hidden'=>"true"));?>
                </div>
            </h4>
        </div>

        <div class="panel-body">
            <?php if ($result_daily): ?>

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
                        <?php foreach($result_daily as $key => $value):?>
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
        </div>
    </div>
</div>


<div class="pull-left">

<h2 style="margin:auto;">月間ランキング</h2>

<br>
    <div class="panel panel-success" style="margin:3px">
        <div class="panel-heading">
            <h4 style="margin:auto;">
                <div class="center-block" style="width: 100%; text-align: center;">
                    <?php echo Html::anchor("list/ranking/$day/$before_month/$year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-left", 'aria-hidden'=>"true"));?>
                    <?php echo "$monthly";?>
                    <?php echo Html::anchor("list/ranking/$day/$next_month/$year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-right", 'aria-hidden'=>"true"));?>
                </div>
            </h4>
        </div>

        <div class="panel-body">
            <?php if ($result_monthly): ?>

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
                        <?php foreach($result_monthly as $key => $value):?>
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
        </div>
    </div>
</div>

<div class="pull-left">
<h2 style="margin:auto;">年間ランキング</h2>

<br>
    <div class="panel panel-warning" style="margin:3px">
        <div class="panel-heading">
            <h4 style="margin:auto;">
                <div class="center-block" style="width: 100%; text-align: center;">
                    <?php echo Html::anchor("list/ranking/$day/$month/$before_year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-left", 'aria-hidden'=>"true"));?>
                    <?php echo "$yearly";?>
                    <?php echo Html::anchor("list/ranking/$day/$month/$next_year",
                                            '',
                                            array('class'=>"btn btn-default glyphicon glyphicon-chevron-right", 'aria-hidden'=>"true"));?>
                </div>
            </h4>
        </div>

        <div class="panel-body">
            <?php if ($result_yearly): ?>

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
                        <?php foreach($result_yearly as $key => $value):?>
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
        </div>
    </div>
</div>


