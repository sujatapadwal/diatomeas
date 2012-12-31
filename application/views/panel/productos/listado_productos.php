
<form method="get" class="form-inline frmfiltros" onsubmit="buscarProductos(0); return false;">
	<div class="form-actions form-filters">
		<input type="text" name="fnombre" id="fnombre" value="<?php echo set_value_get('fnombre'); ?>" placeholder="Nombre del producto" autofocus>
		<input type="hidden" name="id_familia" id="id_familia" value="<?php echo $this->input->get('id'); ?>">
		<button type="submit" class="btn">Buscar</button>
	</div>
</form>

<?php 
	echo $this->empleados_model->getLinkPrivSm('productos/agregar/', array(
		'params'   => 'familia='.$this->input->get('id'),
		'btn_type' => 'btn-success',
		'attrs'    => array(
				'id'    => 'link_addprod',
				'rel'   => 'superbox-60x500',
				'style' => 'float: right;margin-bottom: 5px;'
				)
		)
	);
?>
<div id="tbl_productos">
<?php 
	if(isset($tabla_produtos)){
		echo $tabla_produtos;
	}
?>
</div>