	<table class="table table-striped table-bordered bootstrap-datatable">
		<caption><?php echo $title_familia; ?></caption>
	  <thead>
		  <tr>
			  <th>Código</th>
				<th>Nombre</th>
				<th>Opc</th>
		  </tr>
	  </thead>
	  <tbody>
	  	<?php foreach($productos['productos'] as $produc){ ?>
				<tr id="rowprod<?php echo str_replace('.', '-', $produc->id_producto);?>">
					<td><?php echo $produc->codigo; ?></td>
					<td><?php echo $produc->nombre; ?></td>
					<td class="center">
							<?php 
							echo $this->empleados_model->getLinkPrivSm('productos/modificar/', array(
									'params'    => 'id='.$produc->id_producto.'&familia='.$this->input->get('id'),
									'btn_type'  => 'btn-success',
									'text_link' => 'hide',
									'attrs'     => array(
										'rel'       => 'superbox-60x500'
										))
							);

							echo $this->empleados_model->getLinkPrivSm('productos/desactivar/', array(
									'params'    => 'id='.$produc->id_producto,
									'btn_type'  => 'btn-danger',
									'text_link' => 'hide',
									'attrs'     => array('onclick' => "msb.confirm('Estas seguro de Eliminar el Producto?', 'Productos', this, deleteProducto); return false;"))
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
		'base_url' 			=> '',
		'javascript'		=> "javascript:buscarProductos({pag});",
		'total_rows'		=> $productos['total_rows'],
		'per_page'			=> $productos['items_per_page'],
		'cur_page'			=> $productos['result_page']*$productos['items_per_page'],
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