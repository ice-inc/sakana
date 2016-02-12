<div class="col-md-3 col-md-offset-4">

    <?php echo Form::open(array("class"=>"form-horizontal")); ?>

        <div class="row">
            <div class="form-group">
                    <?php echo Form::label('商品名', 'name', array('class'=>'control-label')); ?>
                    <?php echo Form::input('name',
                        Input::post('name', isset($name) ? $name : ''),
                        array('class' => 'col-md-4 form-control', 'istyle'=>'1', 'placeholder'=>'商品名'));
                    ?>
            </div>
            <div class="form-group">
                    <?php echo Form::label('原価', 'cost', array('class'=>'control-label')); ?>
                    <?php echo Form::input('cost',
                      Input::post('cost', isset($cost) ? $cost : ''),
                      array('class' => 'col-md-8 form-control', 'rows' => 8, 'istyle'=>'4', 'placeholder'=>'原価'));
                    ?>
            </div>
            <div class="form-group">
                    <?php echo Form::label('定価', 'price', array('class'=>'control-label')); ?>
                    <?php echo Form::input('price',
                      Input::post('price', isset($price) ? $price : ''),
                      array('class' => 'col-md-4 form-control', 'istyle'=>'4', 'placeholder'=>'定価'));
                    ?>
            </div>
            <div class="form-group">
                <?php echo Form::label('在庫数', 'number', array('class'=>'control-label')); ?>
                <?php echo Form::input('number',
                    Input::post('number', isset($number) ? $number : ''),
                    array('class' => 'col-md-4 form-control', 'istyle'=>'4', 'placeholder'=>'在庫数'));
                ?>
            </div>
            <div class="form-group">
                <label class='control-label'>&nbsp;</label>
                <?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    <?php echo Form::close(); ?>
</div>
