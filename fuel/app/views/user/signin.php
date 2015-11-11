<?php echo Form::open(); ?>
  <fieldset>
    <h4>ログインID : </h4><?php echo Form::input('login_id', null, array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'ログインID')); ?>
    <h4>パスワード : </h4><?php echo Form::input('password', null, array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'パスワード')); ?>
    <label class='control-label'>&nbsp;</label>
    <?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>
  </fieldset>
<?php echo Form::close(); ?>
