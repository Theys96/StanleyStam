<div class="card my-3">
	<div class="card-header">
		<h4 class="card-title text-center">Instellingen</h4>
	</div>
	<div class="card-block">

			<h5>Stijl</h5>
			<?php
			$style = (isset($_COOKIE['style']) ? $_COOKIE['style'] : 'dark');
			?>
			<form method='post'>
				<div class="custom-controls-stacked">
					<label class="style-radio custom-control custom-radio">
						<input name="style" value="dark" type="radio" class="custom-control-input"<?php echo ($style == 'dark' ? ' checked' : '') ?>>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Standaard</span>
					</label>
					<label class="style-radio custom-control custom-radio">
						<input name="style" value="light" type="radio" class="custom-control-input"<?php echo ($style == 'light' ? ' checked' : '') ?>>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Licht</span>
					</label>
					<label class="style-radio custom-control custom-radio">
						<input name="style" value="lollypop" type="radio" class="custom-control-input"<?php echo ($style == 'lollypop' ? ' checked' : '') ?>>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Walgelijk</span>
					</label>
					<label class="style-radio custom-control custom-radio">
						<input name="style" value="hyves" type="radio" class="custom-control-input"<?php echo ($style == 'hyves' ? ' checked' : '') ?>>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">Hyves</span>
					</label>
					<label class="custom-control custom-radio" onClick="window.location='/rsa'">
						<input name="style" value="rsa" type="radio" class="custom-control-input"<?php echo ($style == 'rsa' ? ' checked' : '') ?>>
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">RSA</span>
					</label>
				</div>
			</form>


	</div>
	<div class="card-footer"></div>
</div>
<script>
$(function() {
	$('.style-radio').on('change', function() {
		this.form.submit();
	});
});
</script>
