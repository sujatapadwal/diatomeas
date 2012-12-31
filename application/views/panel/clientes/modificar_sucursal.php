		<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url('panel/clientes/'); ?>">Clientes</a> <span class="divider">/</span>
					</li>
					<li>Modificar cliente</li>
				</ul>
			</div>

			<form action="<?php echo base_url('panel/clientes/modificar/?'.String::getVarsLink(array('msg'))); ?>" method="post" class="form-horizontal">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-list-alt"></i> Información Facturación</h2>
							<div class="box-icon">
								<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							</div>
						</div>
						<div class="box-content">
							  <fieldset>
									<legend></legend>

									<div class="span6 mquit">
										<div class="control-group">
											<label class="control-label" for="dnombre_fiscal">*Nombre Fiscal:</label>
											<div class="controls">
												<input type="text" name="dnombre_fiscal" id="dnombre_fiscal" class="span12" 
													value="<?php echo (isset($info['info']->nombre_fiscal)? $info['info']->nombre_fiscal: ''); ?>" maxlength="130" autofocus>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="drfc">RFC:</label>
											<div class="controls">
												<input type="text" name="drfc" id="drfc" class="span12" 
													value="<?php echo (isset($info['info']->rfc)? $info['info']->rfc: ''); ?>" maxlength="13">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dcalle">Calle:</label>
											<div class="controls">
												<input type="text" name="dcalle" id="dcalle" class="span12" 
													value="<?php echo (isset($info['info']->calle)? $info['info']->calle: ''); ?>" maxlength="60">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dno_exterior">No exterior:</label>
											<div class="controls">
												<input type="text" name="dno_exterior" id="dno_exterior" class="span12" 
													value="<?php echo (isset($info['info']->no_exterior)? $info['info']->no_exterior: ''); ?>" maxlength="7">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dno_interior">No interior:</label>
											<div class="controls">
												<input type="text" name="dno_interior" id="dno_interior" class="span12" 
													value="<?php echo (isset($info['info']->no_interior)? $info['info']->no_interior: ''); ?>" maxlength="7">
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="dcolonia">Colonia:</label>
											<div class="controls">
												<input type="text" name="dcolonia" id="dcolonia" class="span12" 
													value="<?php echo (isset($info['info']->colonia)? $info['info']->colonia: ''); ?>" maxlength="60">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dlocalidad">Localidad:</label>
											<div class="controls">
												<input type="text" name="dlocalidad" id="dlocalidad" class="span12" 
													value="<?php echo (isset($info['info']->localidad)? $info['info']->localidad: ''); ?>" maxlength="45">
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="dmunicipio">Municipio / Delegación:</label>
											<div class="controls">
												<input type="text" name="dmunicipio" id="dmunicipio" class="span12" 
													value="<?php echo (isset($info['info']->municipio)? $info['info']->municipio: ''); ?>" maxlength="45">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="destado">Estado:</label>
											<div class="controls">
												<input type="text" name="destado" id="destado" class="span12" 
													value="<?php echo (isset($info['info']->estado)? $info['info']->estado: ''); ?>" maxlength="45">
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="dcp">CP:</label>
											<div class="controls">
												<input type="text" name="dcp" id="dcp" class="span12" 
													value="<?php echo (isset($info['info']->cp)? $info['info']->cp: ''); ?>" maxlength="10">
											</div>
										</div>

									</div> <!--/span-->

									<div class="span6 mquit">
										<div class="control-group">
											<label class="control-label" for="dtelefono">Teléfono:</label>
											<div class="controls">
												<input type="text" name="dtelefono" id="dtelefono" class="span12" 
													value="<?php echo (isset($info['info']->telefono)? $info['info']->telefono: ''); ?>" maxlength="15">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dcelular">Celular:</label>
											<div class="controls">
												<input type="text" name="dcelular" id="dcelular" class="span12" 
													value="<?php echo (isset($info['info']->celular)? $info['info']->celular: ''); ?>" maxlength="20">
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="demail">Email:</label>
											<div class="controls">
												<input type="text" name="demail" id="demail" class="span12" 
													value="<?php echo (isset($info['info']->email)? $info['info']->email: ''); ?>" maxlength="70">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="dpag_web">Pag Web:</label>
											<div class="controls">
												<input type="text" name="dpag_web" id="dpag_web" class="span12" 
													value="<?php echo (isset($info['info']->pag_web)? $info['info']->pag_web: ''); ?>" maxlength="80">
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="dlista_precio">Lista de precio:</label>
											<div class="controls">
												<select name="dlista_precio" id="dlista_precio" class="span10">
												<?php
													if(is_array($listas)){
														foreach($listas as $itm){
															echo '<option class="span12" value="'.$itm->id_lista.'" '.set_select('dlista_precio', $itm->id_lista, false, 
																(isset($info['info']->id_lista_precio)? $info['info']->id_lista_precio: '')).'>'.$itm->nombre.'</option>';
														}
													}
												?>
												</select>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="drecepcion_facturas">Recepción facturas:</label>
											<div class="controls">
												<select name="drecepcion_facturas" id="drecepcion_facturas" class="span10">
													<option value="Lunes" <?php echo set_select('drecepcion_facturas', 'Lunes', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Lunes</option>
													<option value="Martes" <?php echo set_select('drecepcion_facturas', 'Martes', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Martes</option>
													<option value="Miércoles" <?php echo set_select('drecepcion_facturas', 'Miércoles', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Miércoles</option>
													<option value="Jueves" <?php echo set_select('drecepcion_facturas', 'Jueves', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Jueves</option>
													<option value="Viernes" <?php echo set_select('drecepcion_facturas', 'Viernes', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Viernes</option>
													<option value="Sábado" <?php echo set_select('drecepcion_facturas', 'Sábado', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Sábado</option>
													<option value="Domingo" <?php echo set_select('drecepcion_facturas', 'Domingo', false, 
															(isset($info['info']->recepcion_facturas)? $info['info']->recepcion_facturas: '')); ?>>Domingo</option>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="ddias_pago">Dias pago:</label>
											<div class="controls">
												<select name="ddias_pago" id="ddias_pago" class="span10">
													<option value="Lunes" <?php echo set_select('ddias_pago', 'Lunes', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Lunes</option>
													<option value="Martes" <?php echo set_select('ddias_pago', 'Martes', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Martes</option>
													<option value="Miércoles" <?php echo set_select('ddias_pago', 'Miércoles', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Miércoles</option>
													<option value="Jueves" <?php echo set_select('ddias_pago', 'Jueves', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Jueves</option>
													<option value="Viernes" <?php echo set_select('ddias_pago', 'Viernes', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Viernes</option>
													<option value="Sábado" <?php echo set_select('ddias_pago', 'Sábado', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Sábado</option>
													<option value="Domingo" <?php echo set_select('ddias_pago', 'Domingo', false, 
															(isset($info['info']->dias_pago)? $info['info']->dias_pago: '')); ?>>Domingo</option>
												</select>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="ddescuento">Descuento:</label>
											<div class="controls">
												<input type="text" name="ddescuento" id="ddescuento" class="span6 vpositive pull-left" 
													value="<?php echo (isset($info['info']->descuento)? $info['info']->descuento: ''); ?>" maxlength="3"> %
											</div>
										</div>

		              </div> <!--/span-->

							  </fieldset>

						</div>
					</div><!--/box span-->

				</div><!--/row-->

				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-list-alt"></i> Información Empresa</h2>
							<div class="box-icon">
								<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							</div>
						</div>
						<div class="box-content">
							  <fieldset>
									<legend></legend>

									<div class="control-group">
										<label class="control-label" for="demismos_facturacion">Los mismos de Facturación:</label>
										<div class="controls">
											<input type="checkbox" name="demismos_facturacion" id="demismos_facturacion">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="denombre">Nombre:</label>
										<div class="controls">
											<input type="text" name="denombre" id="denombre" class="span6" 
												value="<?php echo (isset($info['info_extra']->nombre)? $info['info_extra']->nombre: ''); ?>" maxlength="130">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="decalle">Calle:</label>
										<div class="controls">
											<input type="text" name="decalle" id="decalle" class="span6" 
												value="<?php echo (isset($info['info_extra']->calle)? $info['info_extra']->calle: ''); ?>" maxlength="60">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="deno_exterior">No exterior:</label>
										<div class="controls">
											<input type="text" name="deno_exterior" id="deno_exterior" class="span6" 
												value="<?php echo (isset($info['info_extra']->no_exterior)? $info['info_extra']->no_exterior: ''); ?>" maxlength="7">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="deno_interior">No interior:</label>
										<div class="controls">
											<input type="text" name="deno_interior" id="deno_interior" class="span6" 
												value="<?php echo (isset($info['info_extra']->no_interior)? $info['info_extra']->no_interior: ''); ?>" maxlength="7">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="decolonia">Colonia:</label>
										<div class="controls">
											<input type="text" name="decolonia" id="decolonia" class="span6" 
												value="<?php echo (isset($info['info_extra']->colonia)? $info['info_extra']->colonia: ''); ?>" maxlength="60">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="delocalidad">Localidad:</label>
										<div class="controls">
											<input type="text" name="delocalidad" id="delocalidad" class="span6" 
												value="<?php echo (isset($info['info_extra']->localidad)? $info['info_extra']->localidad: ''); ?>" maxlength="45">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="demunicipio">Municipio / Delegación:</label>
										<div class="controls">
											<input type="text" name="demunicipio" id="demunicipio" class="span6" 
												value="<?php echo (isset($info['info_extra']->municipio)? $info['info_extra']->municipio: ''); ?>" maxlength="45">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="deestado">Estado:</label>
										<div class="controls">
											<input type="text" name="deestado" id="deestado" class="span6" 
												value="<?php echo (isset($info['info_extra']->estado)? $info['info_extra']->estado: ''); ?>" maxlength="45">
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="decp">CP:</label>
										<div class="controls">
											<input type="text" name="decp" id="decp" class="span6" 
												value="<?php echo (isset($info['info_extra']->cp)? $info['info_extra']->cp: ''); ?>" maxlength="10">
										</div>
									</div>
							  </fieldset>

						</div>
					</div><!--/box span-->

				</div><!--/row-->

				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-user"></i> Contactos</h2>
							<div class="box-icon">
								<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							</div>
						</div>
						<div class="box-content">
							  <fieldset>
									<legend></legend>

									<table class="table table-striped table-bordered bootstrap-datatable">
						  			<thead>
											<tr class="header btn-gray">
												<th>Nombre</th>
												<th>Puesto</th>
												<th>Teléfono</th>
												<th>Extensión</th>
												<th>Celular</th>
												<th>Nextel</th>
												<th>ID Nextel</th>
												<th>Fax</th>
												<th>Opc</th>
											</tr>
										</thead>
						  			<tbody id="tbl_contactos">
										<?php if(isset($info['contactos'])){
											foreach($info['contactos'] as $conta){
										?>
												<tr>
													<td><?php echo $conta->nombre; ?></td>
													<td><?php echo $conta->puesto; ?></td>
													<td><?php echo $conta->telefono; ?></td>
													<td><?php echo $conta->extension; ?></td>
													<td><?php echo $conta->celular; ?></td>
													<td><?php echo $conta->nextel; ?></td>
													<td><?php echo $conta->nextel_id; ?></td>
													<td><?php echo $conta->fax; ?></td>
													<td>
														<?php 
														$priv_ec = $this->empleados_model->getLinkPrivSm('clientes/eliminar_contacto/', array(
																'params'    => 'id='.$conta->id_contacto,
																'btn_type'  => 'btn-danger',
																'text_link' => 'hide',
																'attrs'     => array(
																	'onclick' => "msb.confirm('Estas seguro de eliminar el contacto?', 'Contacto', this, eliminaContacto); return false;") )
														);
														echo $priv_ec;
														//para el js, indica q tiene ese permiso
														$priv_ec = $priv_ec != ''? '<span id="priv_eliminar_contacto" style="display: none;"></span>': '';
														?>
													</td>
												</tr>
										<?php }
										}
										?>
										</tbody>
									</table>

									<?php 
										echo $this->empleados_model->getLinkPrivSm('clientes/agregar_contacto/', array(
												'params'    => 'id='.$info['info']->id_cliente,
												'btn_type'  => 'btn-success pull-right',
												'attrs'     => array('style' => 'margin-top: 10px;',
													'onclick' => "addContacto('tbl_contactos', this); return false;") )
										);
										// echo $this->empleados_model->getLinkPrivSm('clientes/agregar_contacto/', 
										// $info['info']->id_cliente, "addContacto('tbl_contactos', this); return false;");

										echo (isset($priv_ec)? $priv_ec: '');
									?>
							  </fieldset>

						</div>
					</div><!--/box span-->

				</div><!--/row-->
				
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Guardar</button>
				  <button type="reset" class="btn">Cancelar</button>
				</div>

			</form>
				  
       
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



