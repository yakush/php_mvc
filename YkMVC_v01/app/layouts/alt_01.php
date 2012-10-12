<html>
<head>

<?php $this->renderSection('header'); ?>

</head>

<body>
	<div>HEADER</div>
	
	<h1>alt_01 layout</h1>
	
	content:
	<div style="border:1px solid gray;padding:5px;">
		<?php $this->renderSection(); ?>
	</div>
	
	<div>FOOTER</div>
</body>
</html>
