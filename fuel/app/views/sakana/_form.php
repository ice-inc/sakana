<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
    <div class="row">
  		<div class="form-group">
        <div class="col-xs-3">
	  			<?php echo Form::label('商品名', 'name', array('class'=>'control-label')); ?>
	  			<?php echo Form::input('name',
		        Input::post('name', isset($post) ? $post->name : ''),
		        array('class' => 'col-md-4 form-control', 'placeholder'=>'商品名', 'istyle'=>'1'));
	        ?>
				</div>
  		</div>
  		<div class="form-group">
        <div class="col-xs-2">
	  			<?php echo Form::label('原価', 'cost', array('class'=>'control-label')); ?>
	  			<?php echo Form::input('cost',
	          Input::post('cost', isset($post) ? $post->cost : ''),
	          array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'原価', 'istyle'=>'4'));
	        ?>
				</div>
  		</div>
  		<div class="form-group">
        <div class="col-xs-2">
	  			<?php echo Form::label('定価', 'price', array('class'=>'control-label')); ?>
	  			<?php echo Form::input('price',
	          Input::post('price', isset($post) ? $post->price : ''),
	          array('class' => 'col-md-4 form-control', 'placeholder'=>'定価', 'istyle'=>'4'));
	        ?>
				</div>
  		</div>
  		<div class="form-group">
  			<label class='control-label'>&nbsp;</label>
  			<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>
      </div>
    </div>
	</fieldset>
<?php echo Form::close(); ?>
<?php echo Asset::js('jquery-1.11.3.min.js');?>