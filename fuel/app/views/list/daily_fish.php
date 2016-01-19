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
                <?php foreach($commodity as $values):?>
                <th colspan="3">
                    <div class="center-block" style="width: 100%; text-align: center;">
                        <?php echo $values->name;?>
                    </div>
                </th>
                <?php endforeach;?>
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
                        <?php echo number_format($value['number']);?>
                    </div>
                </th>
                <th>
                    <div class="pull-right">
                        <?php echo round($value['guest'], 1);?>%
                    </div>
                </th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
