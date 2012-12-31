		<div id="content" class="span10">
			<!-- content starts -->


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url('panel/listas_precio'); ?>">Listas de precio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Agregar Lista</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-plus"></i> Agregar listas de precio</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<form action="<?php echo base_url('panel/listas_precio/agregar'); ?>" method="post" class="form-horizontal">
						  <fieldset>
								<legend></legend>

								<div class="span12">
									<div class="control-group">
									  <label class="control-label" for="dnombre">*Nombre </label>
									  <div class="controls">
											<input type="text" name="dnombre" id="dnombre" class="span6" value="<?php echo set_value('dnombre'); ?>" maxlength="30" autofocus required>
									  </div>
									</div>

									<div class="control-group">
									  <label class="control-label" for="des_default">Es default </label>
									  <div class="controls">
									  	<input type="checkbox" name="des_default" id="des_default" value="si" <?php echo set_checkbox('des_default', 'si'); ?>>
									  </div>
									</div>
									
								</div><!-- /span -->
								
								<div class="clearfix"></div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Guardar</button>
								</div>
						  </fieldset>
						</form>

					</div><!-- /box -->
				</div><!--/span-->

			</div><!--/row-->

					<!-- content ends -->
		</div><!--/#content.span10-->


<!-- Bloque de alertas -->
<?php if(isset($frm_errors)){
	if($frm_errors['msg'] != ''){
?>
<script type="text/javascript" charset="UTF-8">
	$(document).ready(function(){
		noty({"text":"<?php echo $frm_errors['msg']; ?>", "layout":"topRight", "type":"<?php echo $frm_errors['ico']; ?>"});
	});
</script>
<?php }
}?>
<!-- Bloque de alertas -->

