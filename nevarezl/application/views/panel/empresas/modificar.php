
<div id="contentAll" class="f-l">
	<form action="<?php echo base_url('panel/empresas/modificar/?'.String::getVarsLink(array('msg'))); ?>" method="post" class="frm_addmod" 
		enctype="multipart/form-data">
		<div class="frmsec-left w100 f-l">
			
			<div id="frmsec-acordion">
				<h3 class="frmsec-acordion"><a href="#">Información Facturación</a></h3>
				<div style="padding: 10px;">

					<div class="w50 f-l">
						<div class="control-group">
							<label class="control-label" for="dnombre_fiscal">*Nombre Fiscal:</label>
							<div class="controls">
								<input type="text" name="dnombre_fiscal" id="dnombre_fiscal" class="w60" 
									value="<?php echo (isset($info['info']->nombre_fiscal)? $info['info']->nombre_fiscal: ''); ?>" maxlength="130" autofocus>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="drfc">RFC:</label>
							<div class="controls">
								<input type="text" name="drfc" id="drfc" class="w60" 
									value="<?php echo (isset($info['info']->rfc)? $info['info']->rfc: ''); ?>" maxlength="13">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dcalle">Calle:</label>
							<div class="controls">
								<input type="text" name="dcalle" id="dcalle" class="w60" 
									value="<?php echo (isset($info['info']->calle)? $info['info']->calle: ''); ?>" maxlength="60">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dno_exterior">No exterior:</label>
							<div class="controls">
								<input type="text" name="dno_exterior" id="dno_exterior" class="w60" 
									value="<?php echo (isset($info['info']->no_exterior)? $info['info']->no_exterior: ''); ?>" maxlength="7">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dno_interior">No interior:</label>
							<div class="controls">
								<input type="text" name="dno_interior" id="dno_interior" class="w60" 
									value="<?php echo (isset($info['info']->no_interior)? $info['info']->no_interior: ''); ?>" maxlength="7">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="dcolonia">Colonia:</label>
							<div class="controls">
								<input type="text" name="dcolonia" id="dcolonia" class="w60" 
									value="<?php echo (isset($info['info']->colonia)? $info['info']->colonia: ''); ?>" maxlength="60">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dlocalidad">Localidad:</label>
							<div class="controls">
								<input type="text" name="dlocalidad" id="dlocalidad" class="w60" 
									value="<?php echo (isset($info['info']->localidad)? $info['info']->localidad: ''); ?>" maxlength="45">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="dmunicipio">Municipio / Delegación:</label>
							<div class="controls">
								<input type="text" name="dmunicipio" id="dmunicipio" class="w60" 
									value="<?php echo (isset($info['info']->municipio)? $info['info']->municipio: ''); ?>" maxlength="45">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="destado">Estado:</label>
							<div class="controls">
								<input type="text" name="destado" id="destado" class="w60" 
									value="<?php echo (isset($info['info']->estado)? $info['info']->estado: ''); ?>" maxlength="45">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="dcp">CP:</label>
							<div class="controls">
								<input type="text" name="dcp" id="dcp" class="w60" 
									value="<?php echo (isset($info['info']->cp)? $info['info']->cp: ''); ?>" maxlength="10">
							</div>
						</div>

					</div> <!--/span-->

					<div class="w50 f-r">
						<div class="control-group">
							<label class="control-label" for="dregimen_fiscal">Régimen fiscal:</label>
							<div class="controls">
								<input type="text" name="dregimen_fiscal" id="dregimen_fiscal" class="w60" 
									value="<?php echo (isset($info['info']->regimen_fiscal)? $info['info']->regimen_fiscal: ''); ?>" maxlength="200">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dtelefono">Teléfono:</label>
							<div class="controls">
								<input type="text" name="dtelefono" id="dtelefono" class="w60" 
									value="<?php echo (isset($info['info']->telefono)? $info['info']->telefono: ''); ?>" maxlength="15">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dcelular">Celular:</label>
							<div class="controls">
								<input type="text" name="dcelular" id="dcelular" class="w60" 
									value="<?php echo (isset($info['info']->celular)? $info['info']->celular: ''); ?>" maxlength="20">
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="demail">Email:</label>
							<div class="controls">
								<input type="text" name="demail" id="demail" class="w60" 
									value="<?php echo (isset($info['info']->email)? $info['info']->email: ''); ?>" maxlength="70">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dpag_web">Pag Web:</label>
							<div class="controls">
								<input type="text" name="dpag_web" id="dpag_web" class="w60" 
									value="<?php echo (isset($info['info']->pag_web)? $info['info']->pag_web: ''); ?>" maxlength="80">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="dlogo">Logo:</label>
							<div class="controls">
								<input type="file" name="dlogo" id="dlogo" class="w60">
							</div>
						</div>

          </div> <!--/span-->

				  <input type="submit" name="enviar" value="Guardar" class="btn-blue corner-all m10-all f-r">
			</div>
			
		</div>
		
	</form>
</div>


<!-- Bloque de alertas -->
<?php if(isset($frm_errors)){
	if($frm_errors['msg'] != ''){ 
?>
<div id="container" style="display:none">
	<div id="withIcon">
		<a class="ui-notify-close ui-notify-cross" href="#">x</a>
		<div style="float:left;margin:0 10px 0 0"><img src="#{icon}" alt="warning" width="64" height="64"></div>
		<h1>#{title}</h1>
		<p>#{text}</p>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript" charset="UTF-8">
$(function(){
	create("withIcon", {
		title: '<?php echo $frm_errors['title']; ?>', 
		text: '<?php echo $frm_errors['msg']; ?>', 
		icon: '<?php echo base_url('application/images/alertas/'.$frm_errors['ico'].'.png'); ?>' });
});
</script>
<?php }
}?>
<!-- Bloque de alertas -->


