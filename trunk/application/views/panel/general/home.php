		<div id="content" class="span10">
			<!-- content starts -->
			
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						Panel principal
					</li>
				</ul>
			</div>

			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="<?php echo $venta_semana->num; ?>" class="well span3 top-block">
					<span class="icon32 icon-red icon-shopping-cart"></span>
					<div>Ventas semanal</div>
					<div><?php echo String::formatoNumero($venta_semana->total); ?></div>
					<span class="notification yellow"><?php echo $venta_semana->num; ?></span>
				</a>

				<a data-rel="tooltip" title="<?php echo $venta_mes->num; ?>" class="well span3 top-block">
					<span class="icon32 icon-color icon-shopping-cart"></span>
					<div>Ventas del mes</div>
					<div><?php echo String::formatoNumero($venta_mes->total); ?></div>
					<span class="notification yellow"><?php echo $venta_mes->num; ?></span>
				</a>

				
			</div>
					
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-shopping-cart"></i> Ventas por confirmar</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped datatable">
						  <thead>
							  <tr>
								  <th>Folio</th>
								  <th>Cliente</th>
								  <th>F. creacion</th>
								  <th>Tipo</th>
								  <th>Costo</th>
								  <th>Estado</th>
								  <th>Opciones</th>
							  </tr>
						  </thead>   
						  <tbody>
						  </tbody>
					  </table>
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