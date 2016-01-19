<br>
<div class="btn-toolbar">
    <div class="btn-group">
        <button onclick="location.href='<?php echo Uri::create('list/daily_earn/'.$before);?>'" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </button>
        <button onclick="location.href='<?php echo Uri::create('list/daily_earn/'.$next);?>'" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </button>
        <button id="calendar" type="button" class="btn btn-default" onclick="true">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
        </button>
    </div>
    <div class="btn-group">
        <button onclick="location.href='<?php echo Uri::create('list/monthly_earn/'.$date);?>'" type="button" class="btn btn-default">月別へ</button>
        <button onclick="location.href='<?php echo Uri::create('list/yearly_earn/');?>'" type="button" class="btn btn-default">年別へ</button>
    </div>
</div>
<br>
<div class="center-block" style="width: 100%; text-align: center;">
    <h1 style="margin:auto"><?php echo Date::forge($this_date)->format('%Y');?>年<?php echo Date::forge($this_date)->format('%m');?>月</h1>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr class="info">
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                    </div>
                </th>
                <th>
                    <div class="center-block" style="width: 100%; text-align: center;">
                        売上
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
                        今月累計
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
            <?php foreach($daily as $key => $value):?>
            <tr>
                <th>
                    <div class="pull-right">
                        <?php echo date('j', strtotime($value['date']));?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['sales']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['last_sales']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo round($value['year_on_year'], 1);?>%
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['number_of_guest']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['number_of_guest2']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['total_item']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format(round($value['average'], 0));?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['average2'], 1);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['current_total']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['last_total']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo number_format($value['year_on_year_total'], 1);?>%
                    </div>
                </th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
