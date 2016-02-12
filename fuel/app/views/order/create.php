
<?php if ($commodity): ?>
    <?php echo Form::open();?>

    <fieldset>
        <div class="form-inline">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-4">
                        <?php echo Form::label('姓', 'last_name', array('class'=>'control-label'));?>
                        <?php echo Form::input('last_name',
                            Input::post('last_name', ''),
                            array('class' => 'form-control', 'placeholder'=>'姓'));?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <?php echo Form::label('名', 'first_name', array('class'=>'control-label'));?>
                        <?php echo Form::input('first_name',
                            Input::post('first_name', ''),
                            array('class' => 'form-control', 'placeholder'=>'名'));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-inline">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-4">
                        <?php echo Form::label('電話番号', 'tell', array('class'=>'control-label'));?>
                        <?php echo Form::input('tell',
                            Input::post('tell', ''),
                            array('class' => 'form-control', 'placeholder'=>'電話番号'));?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-4">
                        <?php echo Form::label('e-mail', 'email', array('class'=>'control-label'));?>
                        <?php echo Form::input('email',
                            Input::post('email', ''),
                            array('class' => 'form-control', 'placeholder'=>'e-mail'));?>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div id="table" class="table-editable">
            <span class="table-add btn btn-xs btn-default glyphicon glyphicon-plus" style="margin-bottom: 4px"></span>
            <table class="table">
                <tr>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>原価</th>
                    <th>定価</th>
                    <th>小計:原価</th>
                    <th>小計:定価</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td class="name" contenteditable="true">商品名を入力してください</td>
                    <td class="number" contenteditable="true">個数を入力してください</td>
                    <td class="cost"></td>
                    <td class="price"></td>
                    <td class="total_cost"></td>
                    <td class="total_price"></td>
                    <td>
                        <span class="table-remove btn btn-xs btn-default glyphicon glyphicon-remove"></span>
                    </td>
                </tr>
                <!-- このテーブルが追加される -->
                <tr class="hide">
                    <td contenteditable="true">商品名を入力してください</td>
                    <td contenteditable="true">個数を入力してください</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="table-remove btn btn-xs btn-default glyphicon glyphicon-remove"></button>
                    </td>
                </tr>
            </table>
        </div>

        <!--        <button id="export-btn" class="btn btn-primary">Export Data</button>
                <p id="export"></p>
                </div>-->

        <spans class="form-group">
            <span class="col-xs-3">
                <?php echo Form::label('合計', 'total', array('class'=>'control-label'));?>
                <?php echo Form::input('total', '0',
                    array(
                        'class'=>'form-control',
                        'id'=>'total',
                        'placeholder'=>'合計',
                        'readonly'
                    )
                );
                ?>
            </span>
        </spans>

        <span class="form-group">
            <span class="col-xs-2">
                <?php echo Form::label('受取日', 'date', array('style'=>'control-label'));?>
                <?php echo Form::input('date', Input::post('date', ''),
                    array(
                        'class' => 'form-control',
                        'placeholder'=>'受取日'
                    )
                );
                ?>
            </span>
        </span>
        <br>
        <div class="form-group">
            <label class='control-label'> &nbsp;</label>
            <?php echo Form::submit('submit', '予約する', array('class' => 'btn btn-primary from-control')); ?>
        </div>
    </fieldset>
    <?php echo Form::close();?>

    <script type="text/javascript">
        $(function() {
            $.datepicker.setDefaults($.datepicker.regional['ja']);
            $('#form_date').datepicker({ dateFormat: 'yy/mm/dd' });
        });

        // 正規表現でセパレート
        function separate(num){
            return String(num).replace( /(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
        }

        var $TABLE = $('#table');
        var $BTN = $('#export-btn');
        var $EXPORT = $('#export');

        // 行の追加
        $('.table-add').click(function () {
            var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
            $TABLE.find('table').append($clone);
        });

        // 行の削除
        $('.table-remove').click(function () {
            $(this).parents('tr').detach();
        });

        $('.name').blur(function(){
            $.ajax({
                type: "GET",
                url: '<?php echo Uri::create("ranking/yearly/");?>' + Math.floor(year / 1000),
                dataType: "html",
                success: function(value){

                }
            })
        });

        jQuery.fn.pop = [].pop;
        jQuery.fn.shift = [].shift;

        $BTN.click(function () {
            var $rows = $TABLE.find('tr:not(:hidden)');
            var headers = [];
            var data = [];

            // ヘッダを取得（ここでは特別なヘッダロジックを追加）
            $($rows.shift()).find('th:not(:empty)').each(function () {
                headers.push($(this).text().toLowerCase());
            });

            // ループ配列にすべての行を回す
            $rows.each(function () {
                var $td = $(this).find('td');
                var h = {};

                // ハッシュキーに名前を付けるために、ヘッダーを使用
                headers.forEach(function (header, i) {
                    h[header] = $td.eq(i).text();
                });

                data.push(h);
            });

            // 結果出力
            $EXPORT.text(JSON.stringify(data));
        });

        // 小計、合計を求める
        function calculate() {
            var num = 0, num2 = 0;
            var price, number, id = [];
            var tBody = $('#tbody');
            var subTotal = document.getElementsByName('cost');
            var total = $('#total');
            var rowLen = tBody.rows.length;

            // 配列に値を追加
            <?php foreach($commodity as $item):?>
            <?php echo "id.push('form_order_child[$item->id][number]');";?>
            <?php endforeach;?>

            for(var i = 0; i < rowLen; i++){
                var str = tBody.rows[i].cells[2].firstChild.data;
                // 数に変換
                price = parseInt(str);
                number = document.getElementById(id[i]).value;
                num = price * number;
                subTotal[i].value = separate(num) + "円";
                num2 = num2 + num;
            }

            total.value = separate(num2) + "円";
        }
    </script>

<?php else: ?>

    <h3>商品が登録されていません</h3>

<?php endif; ?>
