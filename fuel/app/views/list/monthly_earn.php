<br>
<div class="btn-toolbar">
    <div class="btn-group">
        <button onclick="location.href='<?php echo Uri::create('list/monthly_earn/'.$before);?>'" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </button>
        <button onclick="location.href='<?php echo Uri::create('list/monthly_earn/'.$next);?>'" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </button>
    </div>
    <div class="btn-group">
        <button onclick="location.href='<?php echo Uri::create('list/daily_earn/'.$date);?>'" type="button" class="btn btn-default">日別へ</button>
        <button onclick="location.href='<?php echo Uri::create('list/yearly_earn/');?>'" type="button" class="btn btn-default">年別へ</button>
    </div>
</div>
<div class="center-block" style="width: 100%; text-align: center;">
<h1><?php echo Date::forge($this_date)->format('%Y');?>年</h1>
</div>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
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
                                点数
                            </div>
                        </th>
                        <th>
                            <div class="center-block" style="width: 100%; text-align: center;">
                                客数
                            </div>
                        </th>
                        <th>
                            <div class="center-block" style="width: 100%; text-align: center;">
                                一点単価
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($monthly as $key => $value):?>
                    <tr>
                        <th>
                            <div class="pull-right">
                                <?php echo date('m', strtotime($value['date']));?>月
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['sales']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['sum_number']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['number_of_guest']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['unit_price']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['average_spending']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['set_ratio']);?>
                            </div>
                        </th>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
