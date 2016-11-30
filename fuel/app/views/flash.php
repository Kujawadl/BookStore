<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success alert-dismissable">
				<strong>Success</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>

<?php if (Session::get_flash('warning')): ?>
			<div class="alert alert-warning alert-dismissable">
				<strong>Warning</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>

<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger alert-dismissable">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>

<?php if (Session::get_flash('info')): ?>
			<div class="alert alert-info alert-dismissable">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
