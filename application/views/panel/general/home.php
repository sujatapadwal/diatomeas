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
						<h2><i class="icon-shopping-cart"></i> Ventas pendientes de pago</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">

						<table class="table table-striped table-bordered bootstrap-datatable">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Serie-Folio</th>
                  <th>Cliente</th>
                  <th>Empresa</th>
                  <th>Forma de Pago</th>
                  <th>Estado</th>
                  <th>Opc</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach($facturas_pendientes['fact'] as $fact) {?>
                <tr>
                  <td><?php echo $fact->fecha; ?></td>
                  <td><?php echo $fact->serie.' - '.$fact->folio; ?></td>
                  <td><?php echo $fact->nombre_fiscal; ?></td>
                  <td><?php echo $fact->empresa; ?></td>
                  <td><?php echo $fact->condicion_pago==='cr' ? 'Credito' : 'Contado'; ?></td>
                  <td><?php echo ($fact->status === 'p') ? 'Pendiente' : (($fact->status === 'pa') ? 'Pagada' : 'Cancelada'); ?></td>
                  <td class="center">
                    <?php
                      if ($fact->status === 'p')
                      {
                        echo $this->empleados_model->getLinkPrivSm('facturacion/pagar/', array(
                          'params'   => 'id='.$fact->id_factura,
                          'btn_type' => 'btn-success',
                          'attrs' => array('onclick' => "msb.confirm('Estas seguro de Pagar la factura?', 'Facturas', this); return false;"))
                        );
                      }

                      if ($fact->status !== 'ca')
                      {
                        echo $this->empleados_model->getLinkPrivSm('facturacion/cancelar/', array(
                          'params'   => 'id='.$fact->id_factura,
                          'btn_type' => 'btn-danger',
                          'attrs' => array('onclick' => "msb.confirm('Estas seguro de Cancelar la factura?', 'Facturas', this); return false;"))
                        );
                      }

                      echo $this->empleados_model->getLinkPrivSm('facturacion/imprimir/', array(
                          'params'   => 'id='.$fact->id_factura,
                          'btn_type' => 'btn-info',
                          'attrs' => array('target' => "_blank"))
                      );
                    ?>
                  </td>
                </tr>
            <?php }?>
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