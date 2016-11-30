<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
    <div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

			   <?php echo Form::input('email', Input::post('email'), array('class' => 'col-md-4 form-control', 'placeholder'=>'email')); ?>

		</div>
    <div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

			   <?php echo Form::input('username', Input::post('username'), array('class' => 'col-md-4 form-control', 'placeholder'=>'username')); ?>

		</div>
    <div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

			   <?php echo Form::password('password', Input::post('password'), array('class' => 'col-md-4 form-control', 'placeholder'=>'password')); ?>

		</div>
    <div class="form-group">
			<?php echo Form::label('First Name', 'firstname', array('class'=>'control-label')); ?>

			   <?php echo Form::input('firstname', Input::post('firstname'), array('class' => 'col-md-4 form-control', 'placeholder'=>'firstname')); ?>

		</div>
    <div class="form-group">
			<?php echo Form::label('Last Name', 'lastname', array('class'=>'control-label')); ?>

			   <?php echo Form::input('lastname', Input::post('lastname'), array('class' => 'col-md-4 form-control', 'placeholder'=>'lastname')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Register', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
