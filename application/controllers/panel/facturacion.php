<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class facturacion extends MY_Controller {
  /**
   * Evita la validacion (enfocado cuando se usa ajax). Ver mas en privilegios_model
   * @var unknown_type
   */
  private $excepcion_privilegio = array('facturacion/get_folio/', 'facturacion/rvc_pdf/');


  public function _remap($method){

    $this->load->model("empleados_model");
    if($this->empleados_model->checkSession()){
      $this->empleados_model->excepcion_privilegio = $this->excepcion_privilegio;
      $this->info_empleado                         = $this->empleados_model->getInfoEmpleado($this->session->userdata('id_usuario'), true);

      if($this->empleados_model->tienePrivilegioDe('', get_class($this).'/'.$method.'/')){
        $this->{$method}();
      }else
        redirect(base_url('panel/home?msg=1'));
    }else
      redirect(base_url('panel/home'));
  }

  public function index()
  {
    $this->carabiner->js(array(
      array('panel/facturacion/admin.js'),
    ));

    $this->load->library('pagination');
    $this->load->model('facturacion_model');

    $params['info_empleado']  = $this->info_empleado['info'];
    $params['opcmenu_active'] = 'Facturacion'; //activa la opcion del menu
    $params['seo']        = array('titulo' => 'Facturas');

    $params['datos_s'] = $this->facturacion_model->getFacturas();

    if(isset($_GET['msg']{0}))
      $params['frm_errors'] = $this->showMsgs($_GET['msg']);

    $this->load->view('panel/header',$params);
    $this->load->view('panel/general/menu',$params);
    $this->load->view('panel/facturacion/admin',$params);
    $this->load->view('panel/footer',$params);
  }

  /**
   * Agrega una factura a la bd
   */
  public function agregar(){
    $this->carabiner->css(array(
        array('bootstrap/jquery-ui-1.9.2.custom.min.css', 'screen')

    ));
    $this->carabiner->js(array(
        array('libs/jquery.numeric.js'),
        array('general/util.js'),
        array('panel/facturacion/frm_addmod.js')
    ));

    $params['info_empleado']  = $this->info_empleado['info']; //info empleado
    $params['opcmenu_active']   = 'Ventas'; //activa la opcion del menu
    $params['seo']        = array('titulo' => 'Agregar factura');
    $params['pagar_ordent']   = false;

    if(isset($_GET['ordent']{0}))
      $this->asignaOrdenTrabajo($_GET['ordent']);

    $this->configAddModFactura();
    $this->load->model('facturacion_model');

    if($this->form_validation->run() == FALSE){
      $params['frm_errors'] = $this->showMsgs(2, preg_replace("[\n|\r|\n\r]", '', validation_errors()));
    }else{
      $respons = $this->facturacion_model->addFactura();

      if($respons[0]){
        redirect(base_url('panel/facturacion/agregar/?msg=4'));
      }
    }

    $params['series'] = $this->facturacion_model->getSeriesFolios(100);
    $params['fecha']  = date("Y-m-d");

    if(isset($_GET['msg']{0}))
      $params['frm_errors'] = $this->showMsgs($_GET['msg']);

    $this->load->view('panel/header', $params);
    $this->load->view('panel/general/menu', $params);
    $this->load->view('panel/facturacion/agregar', $params);
    $this->load->view('panel/footer');
  }

  public function pagar()
  {
    if (isset($_GET['id']{0}))
    {
      $this->load->model('facturacion_model');
      $this->facturacion_model->pagaFactura();

      redirect(base_url('panel/facturacion/?'.String::getVarsLink(array('msg','id')).'&msg=9'));
    }
  }

  public function cancelar()
  {
    if (isset($_GET['id']{0}))
    {
      $this->load->model('facturacion_model');
      $this->facturacion_model->cancelaFactura();

      redirect(base_url('panel/facturacion/?'.String::getVarsLink(array('msg','id')).'&msg=5'));
    }
  }

  /**
   * Configura los metodos de agregar y modificar
   */
  private function configAddModFactura(){
    $this->load->library('form_validation');
    $rules = array(
        array('field'   => 'did_cliente',
            'label'   => 'Cliente',
            'rules'   => 'required|max_length[25]'),
        array('field'   => 'dserie',
            'label'   => 'Serie',
            'rules'   => 'max_length[25]'),
        array('field'   => 'dfolio',
            'label'   => 'Folio',
            'rules'   => 'required|numeric|callback_seriefolio_check'),
        array('field'   => 'dno_aprobacion',
            'label'   => 'Numero de aprobacion',
            'rules'   => 'required|numeric'),
        array('field'   => 'dano_aprobacion',
            'label'   => 'Fecha de aprobacion',
            'rules'   => 'required|max_length[10]|callback_isValidDate'),
        array('field'   => 'dimg_cbb',
            'label'   => 'Imagen CBB',
            'rules'   => 'required|max_length[60]'),
        array('field'   => 'dfecha',
            'label'   => 'Fecha',
            'rules'   => 'required|max_length[10]|callback_isValidDate'),

        array('field'   => 'total_importe',
            'label'   => 'SubTotal1',
            'rules'   => 'required|numeric'),
        array('field'   => 'total_subtotal',
            'label'   => 'SubTotal',
            'rules'   => 'required|numeric'),

        array('field'   => 'total_descuento',
            'label'   => 'Descuento',
            'rules'   => 'required|numeric'),
        array('field'   => 'total_iva',
            'label'   => 'IVA',
            'rules'   => 'required|numeric'),
        array('field'   => 'total_retiva',
            'label'   => 'Retencion IVA',
            'rules'   => 'required|numeric'),
        array('field'   => 'total_totfac',
            'label'   => 'Total',
            'rules'   => 'required|numeric|callback_val_total'),
        array('field'   => 'dforma_pago',
            'label'   => 'Forma de pago',
            'rules'   => 'required|max_length[80]'),
        array('field'   => 'dmetodo_pago',
            'label'   => 'Metodo de pago',
            'rules'   => 'required|max_length[40]'),
        array('field'   => 'dmetodo_pago_digitos',
            'label'   => 'Ultimos 4 digitos',
            'rules'   => 'max_length[20]'),
        array('field'   => 'dcondicion_pago',
            'label'   => 'Condición de pago',
            'rules'   => 'required|max_length[2]'),
        // array('field'   => 'dplazo_credito',
        //     'label'   => 'Plazo de crédito',
        //     'rules'   => 'required|numeric'),

        array('field'   => 'dcliente',
            'label'   => 'Cliente',
            'rules'   => ''),
        array('field'   => 'dcliente_rfc',
            'label'   => 'Cliente',
            'rules'   => ''),
        array('field'   => 'dcliente_domici',
            'label'   => 'Cliente',
            'rules'   => ''),
        array('field'   => 'dcliente_ciudad',
            'label'   => 'Cliente',
            'rules'   => ''),
        array('field'   => 'dttotal_letra',
            'label'   => 'letra',
            'rules'   => ''),
        array('field'   => 'dreten_iva',
            'label'   => 'Retecion IVA',
            'rules'   => ''),

        array('field'   => 'prod_did_prod[]',
            'label'   => 'prod_did_prod',
            'rules'   => ''),
        array('field'   => 'prod_dcantidad[]',
            'label'   => 'prod_dcantidad',
            'rules'   => ''),
        array('field'   => 'prod_ddescripcion[]',
            'label'   => 'prod_ddescripcion',
            'rules'   => ''),
        array('field'   => 'prod_ddescuento[]',
            'label'   => 'prod_ddescuento',
            'rules'   => ''),
        array('field'   => 'prod_ddescuento_porcent[]',
            'label'   => 'prod_ddescuento_porcent',
            'rules'   => ''),
        array('field'   => 'prod_dpreciou[]',
            'label'   => 'prod_dpreciou',
            'rules'   => ''),
        array('field'   => 'prod_importe[]',
            'label'   => 'prod_importe',
            'rules'   => ''),
        array('field'   => 'prod_diva_total[]',
            'label'   => 'prod_diva_total',
            'rules'   => ''),
        array('field'   => 'prod_dreten_iva_total[]',
            'label'   => 'prod_dreten_iva_total',
            'rules'   => ''),
        array('field'   => 'prod_dreten_iva_porcent[]',
            'label'   => 'prod_dreten_iva_porcent',
            'rules'   => ''),
        array('field'   => 'prod_diva_porcent[]',
            'label'   => 'prod_diva_porcent',
            'rules'   => ''),
        array('field'   => 'prod_dmedida[]',
            'label'   => 'prod_dmedida',
            'rules'   => ''),

    );
    $this->form_validation->set_rules($rules);
  }

  /**
   * Form_validation: Valida si el usuario ya esta usado por alguien mas
   * @param unknown_type $str
   */
  public function seriefolio_check($str){
    if($str != ''){
      $sql = $ms = '';

      $res = $this->db->select('Count(id_factura) AS num')
        ->from('facturas')
        ->where("serie = '".$this->input->post('dserie')."' AND folio = ".$str."".$sql)
      ->get();
      $data = $res->row();
      if($data->num > 0){
        $this->form_validation->set_message('seriefolio_check', 'El serie y folio ya esta utilizado por otra Factura.');
        return false;
      }
    }
    return true;
  }

  /**
   * Form_validation: Valida su una fecha esta en formato correcto
   */
  public function isValidDate($str){
    if($str != ''){
      if(String::isValidDate($str) == false){
        $this->form_validation->set_message('isValidDate', 'El campo %s no es una fecha valida');
        return false;
      }
    }
    return true;
  }

  public function val_total($str){
    if($str <= 0){
      $this->form_validation->set_message('val_total', 'El Total no puede ser 0, verifica los datos ingresados.');
      return false;
    }
    return true;
  }

  /**
   *          SERIES Y FOLIOS
   * ************************************************
   *
   * Permite administrar los series y folios para la facturacion
   */
  public function series_folios(){
    // $this->carabiner->css(array(
    //     array('general/forms.css','screen'),
    //     array('general/tables.css','screen')
    // ));

    $this->load->library('pagination');
    $this->load->model('facturacion_model');

    $params['info_empleado']  = $this->info_empleado['info'];
    $params['opcmenu_active'] = 'Ventas'; //activa la opcion del menu
    $params['seo']        = array('titulo' => 'Administrar Series y Folios');

    $params['datos_s'] = $this->facturacion_model->getSeriesFolios();

    $this->load->view('panel/header',$params);
    $this->load->view('panel/general/menu',$params);
    $this->load->view('panel/facturacion/series_folios/admin',$params);
    $this->load->view('panel/footer',$params);
  }

  public function agregar_serie_folio()
  {
    $this->carabiner->js(array(
        array('panel/facturacion/series_folios/frm_addmod.js')
    ));

    $params['info_empleado']  = $this->info_empleado['info'];
    $params['opcmenu_active']   = 'Ventas'; //activa la opcion del menu
    $params['seo']  = array('titulo' => 'Agregar Series y Folios');

    $this->load->model('facturacion_model');
    $this->configAddSerieFolio();

    if($this->form_validation->run() == FALSE)
    {
      $params['frm_errors'] = $this->showMsgs(2,preg_replace("[\n|\r|\n\r]", '', validation_errors()));
    }
    else
    {
      $model_resp = $this->facturacion_model->addSerieFolio();
      if($model_resp[0])
        redirect(base_url('panel/facturacion/agregar_serie_folio/?'.String::getVarsLink(array('msg')).'&msg=6'));
      else
        $params['frm_errors'] = $this->showMsgs(2,$model_resp[1]);
    }

    if(isset($_GET['msg']{0}))
        $params['frm_errors'] = $this->showMsgs($_GET['msg']);

    $this->load->view('panel/header',$params);
    $this->load->view('panel/general/menu',$params);
    $this->load->view('panel/facturacion/series_folios/agregar',$params);
    $this->load->view('panel/footer',$params);
  }

  public function modificar_serie_folio(){

    if(isset($_GET['id']{0})){
      $this->carabiner->js(array(
          array('panel/facturacion/series_folios/frm_addmod.js')
      ));

      $this->load->model('facturacion_model');
      $this->configAddSerieFolio('edit');

      if($this->form_validation->run() == FALSE)
      {
        $params['frm_errors'] = $this->showMsgs(2,preg_replace("[\n|\r|\n\r]", '', validation_errors()));
      }
      else
      {
        $model_resp = $this->facturacion_model->editSerieFolio($_GET['id']);
        if($model_resp[0])
          $params['frm_errors'] = $this->showMsgs(7);
      }

      $params['info_empleado']  = $this->info_empleado['info'];
      $params['opcmenu_active']   = 'Ventas'; //activa la opcion del menu
      $params['seo']['titulo']  = 'Modificar Serie y Folio';

      $params['serie_info'] = $this->facturacion_model->getInfoSerieFolio($_GET['id']);

      if(isset($_GET['msg']{0}))
          $params['frm_errors'] = $this->showMsgs($_GET['msg']);

        $this->load->view('panel/header',$params);
        $this->load->view('panel/general/menu',$params);
        $this->load->view('panel/facturacion/series_folios/modificar',$params);
        $this->load->view('panel/footer',$params);
    }
    else
      redirect(base_url('panel/facturacion/index_serie_folios/').String::getVarsLink(array('msg')).'&msg=1');
  }

  /**
   * obtiene el folio siguiente de la serie seleccionada
   */
  public function get_folio(){
    if(isset($_GET['serie']))
    {
      $this->load->model('facturacion_model');
      $res = $this->facturacion_model->getFolioSerie($_GET['serie']);

      $param =  $this->showMsgs(2, $res[1]);
      $param['data'] = $res[0];
      echo json_encode($param);
    }
  }

  private function configAddSerieFolio($tipo='add'){
    $this->load->library('form_validation');

    $rules = array(
//            array('field' => 'fserie',
//                'label' => 'Serie',
//                  'rules' => 'max_lenght[30]|callback_isValidSerie'),
            array('field' => 'fno_aprobacion',
                'label' => 'No Aprobación',
                'rules' => 'required|numeric'),
            array('field' => 'ffolio_inicio',
                'label' => 'Folio Inicio',
                'rules' => 'required|is_natural'),
            array('field' => 'ffolio_fin',
                'label' => 'Folio Fin',
                'rules' => 'required|is_natural'),
            array('field' => 'fano_aprobacion',
                'label' => 'Fecha Aprobación',
                'rules' => 'required|max_length[10]|callback_isValidDate'),
//            array('field' => 'durl_img',
//                'label' => 'Imagen',
//                'rules' => 'required'),
            array('field' => 'fleyenda',
                'label' => 'Leyenda',
                'rules' => ''),
            array('field' => 'fleyenda1',
                'label' => 'Leyenda 1',
                'rules' => ''),
            array('field' => 'fleyenda2',
                'label' => 'Leyenda 2',
                'rules' => '')
        );

    if($tipo=='add'){
      if(isset($_FILES['durl_img']))
        if($_FILES['durl_img']['name']!='')
        $_POST['durl_img'] = 'ok';

      $rules[] = array('field'  => 'fserie',
                'label' => 'Serie',
                  'rules' => 'max_lenght[30]|callback_isValidSerie[add]');
      $rules[] = array('field'  => 'durl_img',
          'label' => 'Imagen',
          'rules' => 'required');
    }

    if($tipo=='edit'){
      $rules[] = array('field'  => 'fserie',
              'label' => 'Serie',
              'rules' => 'max_lenght[30]|callback_isValidSerie[edit]');
    }

    $this->form_validation->set_rules($rules);
  }

  /****************************************
   *           REPORTES                   *
   ****************************************/

  public function rvc()
  {
    $this->carabiner->js(array(
      array('panel/facturacion/admin.js'),
    ));

    $this->load->library('pagination');
    $this->load->model('facturacion_model');

    $params['info_empleado']  = $this->info_empleado['info'];
    $params['opcmenu_active'] = 'Facturacion'; //activa la opcion del menu
    $params['seo']        = array('titulo' => 'Reporte Ventas Cliente');

    $params['datos_s'] = $this->facturacion_model->getFacturas();

    if(isset($_GET['msg']{0}))
      $params['frm_errors'] = $this->showMsgs($_GET['msg']);

    $this->load->view('panel/header',$params);
    $this->load->view('panel/general/menu',$params);
    $this->load->view('panel/facturacion/rvc',$params);
    $this->load->view('panel/footer',$params);
  }


  public function rvc_pdf()
  {
    var_dump($_GET);
  }



  /**
   * Muestra mensajes cuando se realiza alguna accion
   * @param unknown_type $tipo
   * @param unknown_type $msg
   * @param unknown_type $title
   */
  private function showMsgs($tipo, $msg='', $title='Facturacion!'){
    switch($tipo){
      case 1:
        $txt = 'El campo ID es requerido.';
        $icono = 'error';
        break;
      case 2: //Cuendo se valida con form_validation
        $txt = $msg;
        $icono = 'error';
        break;
      case 3:
        $txt = 'La Factura se modifico correctamente.';
        $icono = 'success';
        break;
      case 4:
        $txt = 'La Factura se agrego correctamente.';
        $icono = 'success';
        break;
      case 5:
        $txt = 'La Factura se cancelo correctamente.';
        $icono = 'success';
        break;
      case 6:
        $txt = 'La Serie y Folio se agregaron correctamente.';
        $icono = 'success';
        break;
      case 7:
        $txt = 'La Serie y Folio se modifico correctamente.';
        $icono = 'success';
        break;
      case 8:
        $txt = $msg;
        $icono = 'success';
        break;
      case 9:
        $txt = 'La Factura se pagó correctamente.';
        $icono = 'success';
        break;
    }

    return array(
        'title' => $title,
        'msg' => $txt,
        'ico' => $icono);
  }

}

?>