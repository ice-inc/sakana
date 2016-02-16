
<?php if ($commodity): ?>
    <?php echo Form::open();?>

    <fieldset>
        <div class="form-inline">
            <div class="row">
                <div class="form-group">
                    <div class="col-xs-6">
                        <?php echo Form::label('姓', 'last_name', array('class'=>'control-label'));?>
                        <?php echo Form::input('last_name',
                            Input::post('last_name', ''),
                            array('class' => 'form-control', 'placeholder'=>'姓', 'autofocus'));?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
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
                    <div class="col-xs-6">
                        <?php echo Form::label('電話番号', 'tell', array('class'=>'control-label'));?>
                        <?php echo Form::input('tell',
                            Input::post('tell', ''),
                            array('class' => 'form-control', 'placeholder'=>'電話番号'));?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
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
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span class="table-add btn btn-xs btn-default glyphicon glyphicon-plus pull-left" style="margin-bottom: 4px"></span>
                    </th>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>原価</th>
                    <th>定価</th>
                    <th>在庫</th>
                    <th>小計:原価</th>
                    <th>小計:定価</th>
                    <th>Action</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr>
                    <td>
                        <?php echo Form::input('order[1][id]', Input::post('id', ''), array('class'=>'id hidden', 'id'=>'id1'));?>
                    </td>
                    <td>
                        <?php echo Form::input('order[1][name]',
                            Input::post('name', ''),
                            array('class'=>'name kwd form-control', 'data-id'=>'1', 'type'=>'search', 'placeholder'=>'商品名', 'required'));?>
                    </td>
                    <td>
                        <?php echo Form::input('order[1][number]',
                            Input::post('number', ''),
                            array('class'=>'number form-control', 'data-id'=>'1', 'placeholder'=>'注文数', 'type'=>'number', 'required'));?>
                    </td>
                    <td class="cost" id="cost1"></td>
                    <td class="price" id="price1"></td>
                    <td class="stock" id="stock1"></td>
                    <td class="total_cost" id="total_cost1"></td>
                    <td class="total_price" id="total_price1"></td>
                    <td>
                        <span class="table-remove btn btn-xs btn-default glyphicon glyphicon-remove"></span>
                    </td>
                    <td>
                        <?php
                        echo Form::input('order[1][total_cost]', Input::post('total_cost', ''),
                            array('class'=>'total_cost1 hidden'));
                        ?>
                    </td>
                    <td>
                        <?php
                        echo Form::input('order[1][total_price]', Input::post('total_price', ''),
                            array('class'=>'total_price1 hidden'));
                        ?>
                    </td>
                </tr>
                <!-- この行が追加される -->
                <tr class="hide">
                    <td class="id">
                        <?php echo Form::input('', '0', array('class'=>'id hidden'));?>
                    </td>
                    <td class="name">
                        <?php echo Form::input('', 'dummy',
                            array('class'=>'name kwd form-control', 'type'=>'search', 'placeholder'=>'商品名'));?>
                    </td>
                    <td class="number">
                        <?php echo Form::input('', '0',
                            array('class'=>'number form-control', 'placeholder'=>'注文数', 'type'=>'number'));?>
                    </td>
                    <td class="cost"></td>
                    <td class="price"></td>
                    <td class="stock"></td>
                    <td class="total_cost"></td>
                    <td class="total_price"></td>
                    <td>
                        <button class="table-remove btn btn-xs btn-default glyphicon glyphicon-remove"></button>
                    </td>
                    <td>
                        <?php echo Form::input('', '0', array('class'=>'total_cost')); ?>
                    </td>
                    <td>
                        <?php echo Form::input('', '0', array('class'=>'total_price')); ?>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td><h4>合計</h4></td>
                    <td><h4 class="ttl_num"></h4></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h4 class="ttl_cost"></h4></td>
                    <td><h4 class="ttl_price"></h4></td>
                    <td><h4></h4></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <span class="hidden">
            <?php echo Form::input('ttl_num', Input::post('ttl_number', ''), array('class' => 'ttl_num')); ?>
            <?php echo Form::input('ttl_cst', Input::post('ttl_cost', ''), array('class' => 'ttl_cost')); ?>
            <?php echo Form::input('ttl_prc', Input::post('ttl_price', ''), array('class' => 'ttl_price')); ?>
        </span>

        <span class="form-group">
            <span class="col-xs-2">
                <?php echo Form::label('受取日', 'date', array('style'=>'control-label'));?>
                <?php echo Form::input('date', Input::post('date', ''),
                    array('class' => 'form-control', 'placeholder'=>'受取日', 'required'));
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

    <div class="hidden">
        <?php foreach ($commodity as $value): ?>
            <p class="item_name"><?php echo $value->name; ?></p>
            <p class="item_cost"><?php echo $value->cost; ?></p>
            <p class="item_price"><?php echo $value->price; ?></p>
            <p class="item_stock"><?php echo $value['stock']['number']; ?></p>
        <?php endforeach; ?>
    </div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <?php echo Asset::js(array('toHiragana.js')); ?>
    <script type="text/javascript">
        $(function() {
            // 正規表現でセパレート
            function separate(num){
                return String(num).replace( /(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
            }

            var nameList = [];

            // 予測変換のための配列生成
            $('.item_name').each(function(){
                nameList.push([$.toHiragana($(this).text().toLowerCase()), $(this).text().toLowerCase()]);
            });
            // 追加された要素にも,オートコンプリートを機能させる
            $('.kwd').focus(function() {
                // 予測変換機能
                $(this).autocomplete({
                    source: function(request, response) {
                        var re = new RegExp('^(' + request.term + ')'),
                            list = [];

                        $.each(nameList, function(i, values) {
                            if(values[0].match(re) || values[1].match(re)) {
                                list.push(values[1]);
                            }
                        });
                        response(list);
                    }
                });
            });

            // inputから、フォーカスが離れたとき原価、定価をテーブルに表示
            $('.name').focusout(function(e){
                var id = $(this).data('id');

                $.ajax({
                    type: 'post',
                    url: '<?php echo \Fuel\Core\Uri::create('ajax/create.json') ?>',
                    dataType: 'json',
                    data: {name: $(this).val()},
                    success: function(res){
                        for (var i in res) {
                            $('#id'+id).val(res[i].id);
                            $('td#cost'+id).text(res[i].cost);
                            $('td#price'+id).text(res[i].price);
                            // stockがnullの場合０
                            if (res[i].stock) $('#stock'+id).text(res[i].stock.number);
                            else $('#stock'+id).text(0);
                        }
                    }
                });
            });

            // 合計を求める
            function calculate() {
                var cost = 0, price = 0, number = 0;

                $('#tbody').find('input.number').each(function(i, tr, s){
                    number += Number($(this).val());
                });
                $('#tbody').find('.total_cost').each(function(i, tr, s){
                    cost += Number($(this).text());
                });
                $('#tbody').find('.total_price').each(function(i, tr, s){
                    price += Number($(this).text());
                });

                // tfootに挿入
                $('.ttl_num').val(number).text(separate(number));
                $('.ttl_cost').val(cost).text(separate(cost));
                $('.ttl_price').val(price).text(separate(price));
            }

            $('.number').keyup(function(e){
                var id = $(this).data('id');
                var cost = $('#cost'+id).text();
                var price = $('#price'+id).text();
                var number = $(this).val();
                var total_cost = cost * number;
                var total_price = price * number;
                var tc = $('#total_cost'+id);
                var tp = $('#total_price'+id);

                tc.text(total_cost);
                $('input.total_cost'+id).val(total_cost);
                tp.text(total_price);
                $('input.total_price'+id).val(total_price);
                calculate();

            }).click(function(e){
                var id = $(this).data('id');
                var cost = $('#cost'+id).text();
                var price = $('#price'+id).text();
                var number = $(this).val();
                var total_cost = cost * number;
                var total_price = price * number;
                var tc = $('#total_cost'+id);
                var tp = $('#total_price'+id);

                tc.text(total_cost);
                $('input.total_cost'+id).val(total_cost);
                tp.text(total_price);
                $('input.total_price'+id).val(total_price);
                calculate();
            });

            // date pickerの表示
            $.datepicker.setDefaults($.datepicker.regional['ja']);
            $('#form_date').datepicker({ dateFormat: 'yy/mm/dd' });

            var $TABLE = $('#table');
            var $BTN = $('#export-btn');
            var $EXPORT = $('#export');
            var i = 1;

            // 行の追加
            $('.table-add').click(function () {
                i++;
                // 要素を複製
                var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
                // 子の要素変更
                $clone.find('input.id').attr({
                    'id': 'id'+i,
                    'name': 'order['+i+'][id]',
                    'value': ''
                });
                $clone.find('input.name').attr({
                    'data-id': i,
                    'name': 'order['+i+'][name]',
                    'value': ''
                });
                $clone.find('input.number').attr({
                    'data-id': i,
                    'name': 'order['+i+'][number]',
                    'value': ''
                });
                $clone.find('input.total_cost').attr({
                    'id': 'form_order['+i+'][total_cost]',
                    'name': 'order['+i+'][total_cost]',
                    'class': 'total_cost'+i+' hidden',
                    'value': ''
                });$clone.find('input.total_price').attr({
                    'id': 'form_order['+i+'][total_price]',
                    'name': 'order['+i+'][total_price]',
                    'class': 'total_price'+i+' hidden',
                    'value': ''
                });
                $clone.find('td.cost').attr('id', 'cost'+i);
                $clone.find('td.price').attr('id', 'price'+i);
                $clone.find('td.stock').attr('id', 'stock'+i);
                $clone.find('td.total_cost').attr('id', 'total_cost'+i);
                $clone.find('td.total_price').attr('id', 'total_price'+i);
                // 行の追加
                $TABLE.find('table').append($clone);
            });

            // 行の削除
            $('.table-remove').click(function () {
                $(this).parents('tr').detach();
                calculate();
            });

            jQuery.fn.pop = [].pop;
            jQuery.fn.shift = [].shift;

            $BTN.click(function () {
                var $rows = $TABLE.find('tr:not(:hidden)');
                var headers = [];
                var data = [];

                // ヘッダーを取得
                $($rows.shift()).find('th:not(:empty)').each(function () {
                    headers.push($(this).text().toLowerCase());
                });

                // 全ての行を回る
                $rows.each(function () {
                    var $td = $(this).find('td');
                    var h = {};

                    headers.forEach(function (header, i) {
                        h[header] = $td.eq(i).text();
                    });

                    data.push(h);
                });

                $EXPORT.text(JSON.stringify(data));
            });

        });
    </script>

<?php else: ?>

    <h3>商品が登録されていません</h3>

<?php endif; ?>
