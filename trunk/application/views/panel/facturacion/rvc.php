    <div id="content" class="span10">
      <!-- content starts -->


      <div>
        <ul class="breadcrumb">
          <li>
            <a href="<?php echo base_url('panel'); ?>">Inicio</a> <span class="divider">/</span>
          </li>
          <li>
            Facturación
          </li>
        </ul>
      </div>

      <div class="row-fluid">
        <div class="box span12">
          <div class="box-header well" data-original-title>
            <h2><i class="icon-file"></i> Facturas</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
          </div>
          <div class="box-content">
            <form action="<?php echo base_url('panel/facturacion/rvc_pdf'); ?>" method="GET" class="form-search" target="rvcReporte">
              <div class="form-actions form-filters">
                <label for="ffolio">Folio</label>
                <input type="text" name="ffolio" id="ffolio" value="<?php echo set_value_get('ffolio'); ?>" class="input-mini search-query" autofocus>

                <label for="dcliente">Cliente</label>
                <input type="text" name="dcliente" class="input-medium search-query" id="dcliente" value="<?php echo set_value_get('dcliente'); ?>" size="73">
                <input type="hidden" name="fid_cliente" id="fid_cliente" value="<?php echo set_value_get('fid_cliente'); ?>">


                <label for="ffecha1">Fecha del</label>
                <input type="text" name="ffecha1" class="input-medium search-query" id="ffecha1" value="<?php echo set_value_get('ffecha1'); ?>" size="10">

                <label for="ffecha2">Al</label>
                <input type="text" name="ffecha2" class="input-medium search-query" id="ffecha2" value="<?php echo set_value_get('ffecha2'); ?>" size="10">

                <label for="fstatus">Estado</label>
                <select name="fstatus" class="input-medium" id="fstatus">
                  <option value="">TODAS</option>
                  <option value="pa" <?php echo set_select_get('fstatus', 'pa'); ?>>PAGADAS</option>
                  <option value="p" <?php echo set_select_get('fstatus', 'p'); ?>>PENDIENTE</option>
                  <option value="ca" <?php echo set_select_get('fstatus', 'ca'); ?>>CANCELADAS</option>
                </select>
                <input type="submit" name="enviar" value="Enviar" class="btn">
              </div>
            </form>


            <div class="row">
              <div class="span12">
                <iframe name="rvcReporte" id="iframe-reporte" class="" src="<?php echo base_url('panel/facturacion/rvc_pdf')?>">
                  Reporte
                </iframe>
              </div>

            </div>



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
