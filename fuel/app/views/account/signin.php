<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
    <div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

			   <?php echo Form::input('username', Input::post('username'), array('class' => 'col-md-4 form-control', 'placeholder'=>'username')); ?>

		</div>
    <div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

			   <?php echo Form::password('password', '', array('class' => 'col-md-4 form-control', 'placeholder'=>'password')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
