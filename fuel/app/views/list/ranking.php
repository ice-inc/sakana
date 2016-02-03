<br>
<div class="col-xs-10 col-xs-offset-1">
<div class="pull-left">
    <h2 style="margin:auto;">日別ランキング</h2>
    <br>
    <div class="panel panel-info" style="margin:3px">
        <div class="panel-heading">
            <h4 style="margin:auto;">
                <div class="center-block" style="width: 100%; text-align: center;">
                    <a id="before_day" class="day btn btn-default glyphicon glyphicon-chevron-left" aria-hidden="true" data-inc="-1"></a>
                    <span id="title_day"></span>
                    <a id="next_day" class="day btn btn-default glyphicon glyphicon-chevron-right" aria-hidden="true" data-inc="1"></a>
                </div>
            </h4>
        </div>

        <div id="daily" class="panel-body">

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
                    <a id="before_month" class="month btn btn-default glyphicon glyphicon-chevron-left" aria-hidden="true" data-inc="-1"></a>
                    <span id="title_month"></span>
                    <a id="next_month" class="month btn btn-default glyphicon glyphicon-chevron-right" aria-hidden="true" data-inc="1"></a>
                </div>
            </h4>
        </div>

        <div id="monthly" class="panel-body">

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
                    <a id="before_year" class="year btn btn-default glyphicon glyphicon-chevron-left" aria-hidden="true" data-inc="-1"></a>
                    <span id="title_year"></span>
                    <a id="next_year" class="year btn btn-default glyphicon glyphicon-chevron-right" aria-hidden="true" data-inc="1"></a>
                </div>
            </h4>
        </div>

        <div id="yearly" class="panel-body">

        </div>
    </div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(function() {
        var day = new Date();
        var month = new Date();
        var year = new Date();

        $.ajax({
            type: "GET",
            url: '<?php echo Uri::create("ranking/daily/");?>' + Math.floor(day / 1000),
            dataType: "html",
            success: function(value){
                $('#daily').html(value);
                var date = Number(day.getMonth()) + 1;
                $("#title_day").text(day.getFullYear() + "年" + date + "月" + day.getDate() + "日");
            }
        });

        $.ajax({
            type: "GET",
            url: '<?php echo Uri::create("ranking/monthly/");?>' + Math.floor(month / 1000),
            dataType: "html",
            success: function(value){
                $('#monthly').html(value);
                var date = Number(month.getMonth()) + 1;
                $("#title_month").text(month.getFullYear() + "年" + date + "月");
            }
        });

        $.ajax({
            type: "GET",
            url: '<?php echo Uri::create("ranking/yearly/");?>' + Math.floor(year / 1000),
            dataType: "html",
            success: function(value){
                $('#yearly').html(value);
                $("#title_year").text(year.getFullYear() + "年");
            }
        });

        $('a.day').click(function(e) {
            day.setDate(day.getDate() + $(e.target).data("inc"));
            var next = Math.floor(day.getTime() / 1000);
            console.log(day.toLocaleDateString());
            $.ajax({
                type: "GET",
                url: '<?php echo Uri::create("ranking/daily/");?>' + next,
                dataType: "html",
                success: function(value){
                    $('#daily').html(value);
                    var date = Number(day.getMonth()) + 1;
                    $("#title_day").text(day.getFullYear() + "年" + date + "月" + day.getDate() + "日");
                }
            });
        });

        $('a.month').click(function(e) {
            month.setMonth(month.getMonth() + $(e.target).data("inc"));
            var next = Math.floor(month.getTime() / 1000);
            console.log(month.toLocaleDateString());
            $.ajax({
                type: "GET",
                url: '<?php echo Uri::create("ranking/monthly/");?>' + next,
                dataType: "html",
                success: function(value){
                    $('#monthly').html(value);
                    var date = Number(month.getMonth()) + 1;
                    $("#title_month").text(month.getFullYear() + "年" + date + "月");
                }
            });
        });

        $('a.year').click(function(e) {
            year.setFullYear(year.getFullYear() + $(e.target).data("inc"));
            var next = Math.floor(year.getTime() / 1000);
            $.ajax({
                type: "GET",
                url: '<?php echo Uri::create("ranking/yearly/");?>' + next,
                dataType: "html",
                success: function(value){
                    $('#yearly').html(value);
                    $("#title_year").text(year.getFullYear() + "年");
                }
            });
        });
    });
</script>

