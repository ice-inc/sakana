<br>
<div class="btn-toolbar">
    <div class="btn-group">
        <button onclick="location.href='<?php echo Uri::create('list/daily_earn/'.$date);?>'" type="button" class="btn btn-default">日別へ</button>
        <button onclick="location.href='<?php echo Uri::create('list/monthly_earn/'.$date);?>'" type="button" class="btn btn-default">月別へ</button>
    </div>
</div>
<br>
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
                                客数
                            </div>
                        </th>
                        <th>
                            <div class="center-block" style="width: 100%; text-align: center;">
                                点数
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
                    <?php foreach($yearly as $key => $value):?>
                    <tr>
                        <th>
                            <div class="pull-right">
                                <?php echo $value['date'];?>年
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                ￥<?php echo number_format($value['sales']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['number_of_guest']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['sum_number']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['unit_price']);?>
                            </div>
                        </th>
                        <th>
                            <div class="pull-right">
                                <?php echo number_format($value['average']);?>
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
