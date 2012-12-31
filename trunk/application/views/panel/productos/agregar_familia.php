<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $seo['titulo'];?></title>
	<meta name="description" content="<?php echo $seo['titulo'];?>">
	<meta name="viewport" content="width=device-width">

<?php
	if(isset($this->carabiner)){
		$this->carabiner->display('css');
		$this->carabiner->display('base_panel');
		$this->carabiner->display('js');
	}
?>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<script type="text/javascript" charset="UTF-8">
	var base_url = "<?php echo base_url();?>";
</script>
</head>
<body>

<div>
	<h2><?php echo $seo['titulo']; ?></h2>

	<form action="<?php echo base_url('panel/productos/agregar_familia'); ?>" method="post" class="form-horizontal">
	  <fieldset>
			<legend></legend>

			<div class="span12">
				<div class="control-group">
				  <label class="control-label" for="dcodigo">*Código </label>
				  <div class="controls">
						<input type="text" name="dcodigo" id="dcodigo" class="span6" value="<?php echo set_value('dcodigo'); ?>" size="5" maxlength="8" autofocus required>
						<p class="help-block">Ej. 1, 8, 12, 20</p>
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="dnombre">*Nombre </label>
				  <div class="controls">
						<input type="text" name="dnombre" id="dnombre" class="span6" value="<?php echo set_value('dnombre'); ?>" size="40" maxlength="60" required>
				  </div>
				</div>

			</div> <!--/span-->

      <div class="clearfix"></div>
			
			<div class="form-actions">
			  <button type="submit" class="btn btn-primary">Guardar</button>
			  <button type="button" class="btn" onclick="parent.supermodal.close();">Cancelar</button>
			</div>
	  </fieldset>
	</form>

</div>


<!-- Bloque de alertas -->
<?php if(isset($frm_errors)){
	if($frm_errors['msg'] != ''){ 
?>
<script type="text/javascript" charset="UTF-8">
	$(document).ready(function(){
		noty({"text":"<?php echo $frm_errors['msg']; ?>", "layout":"topRight", "type":"<?php echo $frm_errors['ico']; ?>"});
	});

	<?php 
		if(isset($load_familias)){
			echo 'window.setTimeout(parent.getListaFamilias, 1200);';
		}
	?>
</script>
<?php }
}?>
<!-- Bloque de alertas -->

</body>
</html>