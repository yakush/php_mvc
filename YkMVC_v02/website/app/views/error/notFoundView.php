<div>
	hello
</div>

<div>
	this page could not be found...
</div>

<?php $this->renderPartial('test','SOME MODEL (main section)');?>

<?php $this->startSection('third');?>
	<div style="border:1px solid gray;padding:5px;">
		-this is a 3rd section-
		<?php $this->renderPartial('test','SOME MODEL');?>
	</div>
<?php $this->endSection(); //second ?>

<?php $this->startSection('second');?>
	<div style="border:1px solid gray;padding:5px;">
		-this is a second section-
	</div>
<?php $this->endSection(); //second ?>

and back to the main section