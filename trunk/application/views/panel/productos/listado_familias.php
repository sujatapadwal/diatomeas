	
	<table class="table table-striped table-bordered bootstrap-datatable">
	  <thead>
		  <tr>
			  <th>Código</th>
				<th>Nombre</th>
				<th>Opc</th>
		  </tr>
	  </thead>
	  <tbody>
	  	<?php foreach($familias['familias'] as $famil){ ?>
			<tr class="fams" id="rowfam<?php echo str_replace('.', '-', $famil->id_familia);?>" data-id="<?php echo $famil->id_familia;?>">
				<td><?php echo $famil->codigo; ?></td>
				<td class="data-title"><?php echo $famil->nombre; ?></td>
				<td class="center">
						<?php 
						echo $this->empleados_model->getLinkPrivSm('productos/modificar_familia/', array(
								'params'    => 'id='.$famil->id_familia,
								'btn_type'  => 'btn-success',
								'text_link' => 'hide',
								'attrs'     => array(
									'rel'       => 'superbox-60x500',
									'data-sbox' => 'familia'
									))
						);

						echo $this->empleados_model->getLinkPrivSm('productos/desactivar_familia/', array(
								'params'    => 'id='.$famil->id_familia,
								'btn_type'  => 'btn-danger',
								'text_link' => 'hide',
								'attrs'     => array('onclick' => "msb.confirm('Estas seguro de Eliminar la Familia? \\n Los productos asociados tambien se eliminaran', 'Productos', this, deleteFamilia); return false;"))
						);
						
						?>
				</td>
			</tr>
	<?php }?>
		</tbody>
	</table>

	