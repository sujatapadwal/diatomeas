		<div id="content" class="span10">
			<!-- content starts -->


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Listas de precio</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> Listas de precio</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<form action="<?php echo base_url('panel/listas_precio'); ?>" method="get" class="form-inline">
							<div class="form-actions form-filters">
								<input type="text" name="fnombre" id="fnombre" value="<?php echo $this->input->get('fnombre'); ?>" placeholder="Nombre del producto" autofocus>
								<select name="ffamilia" id="ffamilia">
									<option value="0">Todos</option>
							<?php foreach($familias['familias'] as $row){ 
									echo '<option value="'.$row->id_familia.'"'.set_select_get('ffamilia', $row->id_familia).'>'.$row->nombre.'</option>';
							}?>
								</select>
								<button type="submit" class="btn">Buscar</button>
							</div>
						</form>

						<a href="" id="lnkImprimir" class="btn pull-right" target="_blank">Imprimir</a>
						<?php 
							echo $this->empleados_model->getLinkPrivSm('listas_precio/agregar/', array(
								'params'   => '',
								'btn_type' => 'btn-success',
								'attrs'    => array(
											'style' => 'float: right;margin: 0px 5px 5px 0px;'
											))
							);
						?>

						<div class="clearfix"></div>

						<?php 
							//Creamos la tabla en html
							//checo si tiene permiso de editar precios
							$editar = $this->empleados_model->tienePrivilegioDe('', 'listas_precio/cambiar_precio/');
							$strtabla = ''; $strtabla_head = '';
							$wtabla = count($tbl_precios['tabla'][0])*120+250;
							foreach($tbl_precios['tabla'] as $key => $rows){
								if ($key != 0)
									$strtabla .= '<tr>';
								
								foreach($rows as $key2 => $cols){
									if($key2==0) //codigo producto
										$attr = ' style="width:120px;"';
									elseif($key2==1) //nombre producto
										$attr = ' style="width:350px;"';
									else{ //listas precios
										$cols = explode('|', $cols); //id_producto|precio|id_lista
										
										$attr = ' style="width:120px;"';
										if($editar && $key != 0){
											$cols[1] = '$<input type="text" data-producto="'.$cols[0].'" data-lista="'.$cols[2].'" 
												class="input-small vpositive col-updatechange" value="'.$cols[1].'"  maxlength="9">';
										}elseif($key != 0)
											$cols[1] = String::formatoNumero($cols[1]);
										elseif($key == 0){
											$ccl = isset($tbl_precios['tabla'][1][$key2])? explode('|', $tbl_precios['tabla'][1][$key2]): '';
											$cols[0] = '<input type="checkbox" value="'.$cols[0].'|'.(isset($ccl[2])? $ccl[2]: '').'" name="printcheck" class="chkPrintLista"> '.$cols[0];
										}
										
										$cols = isset($cols[1])? $cols[1]: $cols[0];
									}
									
									if ($key == 0)
										$strtabla_head .= '<th'.$attr.'>'.$cols.'</th>';
									else
										$strtabla .= '<td'.$attr.'>'.$cols.'</td>';
								}

								if ($key != 0)
									$strtabla .= '</tr>';
							}
						?>
							<div style="overflow-x: auto;">
								<table class="table table-striped table-bordered bootstrap-datatable" style="width: <?php echo $wtabla; ?>px;">
									<thead>
										<?php echo $strtabla_head; ?>
									</thead>
									<tbody>
										<?php echo $strtabla; ?>
									</tbody>
								</table>
							</div>
							
						<?php
						//Paginacion
						$this->pagination->initialize(array(
								'base_url' 			=> base_url($this->uri->uri_string()).'?'.String::getVarsLink(array('pag')).'&',
								'total_rows'		=> $tbl_precios['pag']['total_rows'],
								'per_page'			=> $tbl_precios['pag']['items_per_page'],
								'cur_page'			=> $tbl_precios['pag']['result_page']*$tbl_precios['pag']['items_per_page'],
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



