			</div>
		</div>
		<footer class="footer">
			<div class="container-fluid">
				
				<p class="copyright pull-right">
					&copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.facebook.com/imlogicgates">Service Inspection</a>
				</p>
			</div>
		</footer>
	</div>
</div>
<?php global $data ?>
<?php if(isset($data['scripts'])) : ?>
	<?php foreach ($data['scripts'] as $key => $row) : ?>
		<script type="text/javascript" src="<?php URI::script($row) ?>"></script>
	<?php endforeach ?>
<?php endif; ?>
	<script type="text/javascript">var base_url = "<?php URI::baseUrl(); ?>";</script>
<?php if(isset($data['list'])) : ?>
	<script type="text/javascript"><?=$data['list'];?></script>
<?php endif ?>
	
</body>
</html>