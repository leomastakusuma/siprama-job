<?php if (validation_errors()!="" || !empty($_SESSION['error'])) :?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="fa fa-times"></i>
					</button>
					<?php echo validation_errors();?>
					<?php echo !empty($_SESSION['error']) ? $_SESSION['error'] : '' ;?>
			</div>
		</div>
	</div>
<?php endif?>

<?php if (!empty($_SESSION['success'])) :?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-block alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
							<i class="fa fa-times"></i>
					</button>
					<?php #echo validation_errors();?>
					<?php echo !empty($_SESSION['success']) ? $_SESSION['success'] : '' ;?>
			</div>
		</div>
	</div>
<?php endif?>

<?php if (!empty($_SESSION['warning'])) :?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-block alert-warning fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
							<i class="fa fa-times"></i>
					</button>
					<?php #echo validation_errors();?>
					<?php echo !empty($_SESSION['warning']) ? $_SESSION['warning'] : '' ;?>
			</div>
		</div>
	</div>
<?php endif?>
