		<div id="content" class="span10">
			<!-- content starts -->


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Clientes</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Clientes</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form action="<?php echo base_url('panel/clientes'); ?>" method="get" class="form-search">
							<div class="form-actions form-filters">
								<label for="fnombre">Nombre</label>
								<input type="text" name="fnombre" id="fnombre" value="<?php echo set_value_get('fnombre'); ?>" class="input-medium search-query" autofocus>

                <label for="fmunicipio">Municipio</label>
                <input type="text" name="fmunicipio" id="fmunicipio" value="<?php echo set_value_get('fmunicipio'); ?>" class="input-medium search-query">

                <label for="festado">Estado</label>
                <input type="text" name="festado" id="festado" value="<?php echo set_value_get('festado'); ?>" class="input-medium search-query">

                <label for="fcalle">Calle</label>
                <input type="text" name="fcalle" id="fcalle" value="<?php echo set_value_get('fcalle'); ?>" class="input-medium search-query">

								<button type="submit" class="btn">Buscar</button>
							</div>
						</form>

						<?php
						echo $this->empleados_model->getLinkPrivSm('clientes/agregar/', array(
										'params'   => '',
										'btn_type' => 'btn-success pull-right',
										'attrs' => array('style' => 'margin-bottom: 10px;') )
								);
						 ?>
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
									<th>Telefono</th>
									<th>Email</th>
									<th>Recepción facturas</th>
								  <th>Dias pago</th>
								  <th>Opc</th>
							  </tr>
						  </thead>
						  <tbody>
						<?php foreach($clientes['clientes'] as $cliente){?>
								<tr>
									<td><?php echo $cliente->nombre_fiscal; ?></td>
									<td><?php echo $cliente->telefono; ?></td>
									<td><?php echo $cliente->email; ?></td>
									<td><?php echo $cliente->recepcion_facturas; ?></td>
									<td><?php echo $cliente->dias_pago; ?></td>
									<td class="center">
											<?php
											echo $this->empleados_model->getLinkPrivSm('clientes/modificar/', array(
													'params'   => 'id='.$cliente->id_cliente,
													'btn_type' => 'btn-success')
											);
											echo $this->empleados_model->getLinkPrivSm('clientes/eliminar/', array(
													'params'   => 'id='.$cliente->id_cliente,
													'btn_type' => 'btn-danger',
													'attrs' => array('onclick' => "msb.confirm('Estas seguro de eliminar?', 'Clientes', this); return false;"))
											);

											?>
									</td>
								</tr>
						<?php }?>
						  </tbody>
					  </table>

					  <?php
						//Paginacion
						$this->pagination->initialize(array(
								'base_url' 			=> base_url($this->uri->uri_string()).'?'.String::getVarsLink(array('pag')).'&',
								'total_rows'		=> $clientes['total_rows'],
								'per_page'			=> $clientes['items_per_page'],
								'cur_page'			=> $clientes['result_page']*$clientes['items_per_page'],
								'page_query_string'	=> TRUE,
								'num_links'			=> 1,
								'anchor_class'	=> 'pags corner-all',
								'num_tag_open' 	=> '<li>',
								'num_tag_close' => '</li>',
								'cur_tag_open'	=> '<li class="active"><a href="#">',
								'cur_tag_close' => '</a></li>'
						));
						$pagination = $this->pagination->create_links();
						echo '<div class="pagination pagination-centered"><ul>'.$pagination.'</ul></div>';
						?>
					</div>
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
