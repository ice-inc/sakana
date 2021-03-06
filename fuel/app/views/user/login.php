<div class="col-md-3 col-md-offset-4">
    <?php echo Form::open(array()); ?>

    <?php if (isset($_GET['destination'])): ?>
    <?php echo Form::hidden('destination', $_GET['destination']); ?>
    <?php endif; ?>

    <?php if (isset($login_error)): ?>
    <div class="error"><h3 class="text-danger"><?php echo $login_error; ?></h3></div>
    <?php endif; ?>

    <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
        <label for="email">Email or Username:</label>
        <?php echo Form::input('email', Input::post('email'), array('class' => 'form-control', 'placeholder' => 'Email or Username', 'autofocus')); ?>

        <?php if ($val->error('email')): ?>
        <span class="control-label"><?php echo $val->error('email')->get_message('ユーザ名もしくはメールアドレスを入力してください'); ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
        <label for="password">Password:</label>
        <?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder' => 'Password')); ?>

        <?php if ($val->error('password')): ?>
        <span class="control-label"><?php echo $val->error('password')->get_message(':label を入力してください'); ?></span>
        <?php endif; ?>
    </div>

    <div class="actions">
        <?php echo Form::submit(array('value'=>'Login', 'name'=>'submit', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
    </div>

    <?php echo Form::close(); ?>
    <br>
    <?php echo Html::anchor('user/create', '新規登録', array('class'=>'btn btn-default btn-block'));?>
</div>
