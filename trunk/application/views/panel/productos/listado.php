		<div id="content" class="span10">
			<!-- content starts -->


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Productos</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid">
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Familias</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div id="prodic_familias" class="">
							<?php 
							echo $this->empleados_model->getLinkPrivSm('productos/agregar_familia/', array(
									'params'   => '',
									'btn_type' => 'btn-success',
									'attrs'    => array(
											'rel'   => 'superbox-60x500',
											'style' => 'float: right;margin-bottom: 5px;'
											)
									)
								);
							?>
							<div id="conte_tabla">
							<?php
								//imprimimos la tabla de familias
								if(isset($tabla_familias)){
									echo $tabla_familias;
								} 
							?>
							</div>
						</div>

					</div><!-- /box -->
				</div><!--/span-->

				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Productos</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div id="produc_productos" class="">
							
						</div>

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
