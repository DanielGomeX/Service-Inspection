<?php 	$scripts = [	
				"vendor/jquery.min",
				"vendor/materialize.min",
				"main/auth",
		];
?>
<?php foreach ($scripts as $key):?>
		<script src="<?php URI::script($key); ?>"></script>
<?php endforeach;?>
<script type="text/javascript">var base_url = "<?php URI::baseUrl(); ?>";</script>
<script type="text/javascript">
	$(document).ready(function(){
		jQuery(document).on('submit', '#formLogin', function(){
				User.Login('/app/admin/userController.php', $(this).serialize());
				return false;
		});
	});
</script>
</body>
</html>