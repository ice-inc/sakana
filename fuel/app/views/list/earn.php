
<br>
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr class="info">
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        <?php echo $month;?>月
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        今年売上
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        前年売上
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        前年同日比
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        客数
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        前年客数
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        点数
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        客単価
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        セット率
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        今年累計
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        前年累計
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        前年同月比
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($earn as $key => $value):?>
            <tr>
                <th>
                    <div class="pull-right">
                        <?php echo date('j', strtotime($value['date']));?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo $value['sales'];?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo $value['last_sales'];?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo round($value['year_on_year'], 1);?>%
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo $value['number_of_guest'];?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo $value['number_of_guest2'];?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo $value['total_item'];?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo round($value['average'], 0);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo round($value['average2'], 1);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                    </div>
                </th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php //echo print_r($year_on_year);?>
