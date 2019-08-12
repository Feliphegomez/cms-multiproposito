
	<?php if(ControladorBase::isUser() == true){ ?>
		<div class="pull-right">
		<?php echo TITLE_MD; ?> | <?php echo $this->getCopyright(); ?>
		</div>
		<div class="clearfix"></div>
	<?php } ?>