<?php
class facturacion_model extends privilegios_model{

	function __construct(){
		parent::__construct();
	}



	/**
	 * 					FACTURACION
	 * **********************************************
	 * Obtiene el listado de facturas
	 */
	public function getFacturas(){
		$sql = '';
		//paginacion
		$params = array(
				'result_items_per_page' => '30',
				'result_page' 			=> (isset($_GET['pag'])? $_GET['pag']: 0)
		);
		if($params['result_page'] % $params['result_items_per_page'] == 0)
			$params['result_page'] = ($params['result_page']/$params['result_items_per_page']);

		//Filtros para buscar
		if($this->input->get('ffecha1') != '' && $this->input->get('ffecha2') != '')
			$sql = " AND Date(f.fecha) BETWEEN '".$this->input->get('ffecha1')."' AND '".$this->input->get('ffecha2')."'";
		elseif($this->input->get('ffecha1') != '')
			$sql = " AND Date(f.fecha) = '".$this->input->get('ffecha1')."'";
		elseif($this->input->get('ffecha2') != '')
			$sql = " AND Date(f.fecha) = '".$this->input->get('ffecha2')."'";

		// if($this->input->get('fserie') != '')
		// 	$sql .= " AND c.serie = '".$this->input->get('fserie')."'";
		if($this->input->get('ffolio') != '')
			$sql .= " AND f.folio = '".$this->input->get('ffolio')."'";
		if($this->input->get('fstatus') != '')
			$sql .= " AND f.status = '".$this->input->get('fstatus')."'";
		if($this->input->get('fid_cliente') != '')
			$sql .= " AND c.id_sucursal = '".$this->input->get('fid_cliente')."'";

		$query = BDUtil::pagination("
				SELECT f.id_factura, Date(f.fecha) AS fecha, f.serie, f.folio, c.nombre_fiscal, f.condicion_pago, f.status
				FROM facturas AS f
        INNER JOIN clientes as c ON c.id_cliente = f.id_cliente
				WHERE 1 = 1".$sql."
				ORDER BY (Date(f.fecha)) DESC
				", $params, true);
		$res = $this->db->query($query['query']);

		$response = array(
				'fact' => array(),
				'total_rows' 		=> $query['total_rows'],
				'items_per_page' 	=> $params['result_items_per_page'],
				'result_page' 		=> $params['result_page']
		);
		if($res->num_rows() > 0)
			$response['fact'] = $res->result();

		return $response;
	}

	/**
	 * Obtiene la informacion de una factura
	 */
	public function getInfoFactura($id, $info_basic=false){
		$res = $this->db
			->select("*, (SELECT SUM(total) FROM facturas_abonos WHERE id_factura = facturas.id_factura) AS ab_total")
			->from('facturas')
			->where("id_factura = '".$id."'")
		->get();
		if($res->num_rows() > 0){
			$response['info'] = $res->row();
			$response['info']->fecha = substr($response['info']->fecha, 0, 10);
			$res->free_result();
			if($info_basic)
				return $response;

			$this->load->model('clientes_model');
			$prov = $this->clientes_model->getInfoCliente($response['info']->id_cliente, true);
			$response['info']->cliente = $prov['info'];

			//ordenes t
			$response['ordenest'] = array();
			$res = $this->db
				->select('id_ordent')
				->from('facturas_ordenest')
				->where("id_factura = '".$id."'")
			->get();
			if($res->num_rows() > 0){
				$response['ordenest'] = $res->result();
			}
			$res->free_result();

			if(count($response['ordenest']) > 0){
				$ids_ordns = '';
				foreach($response['ordenest'] as $itm){
					$ids_ordns .= "','".$itm->id_ordent;
				}
				$ids_ordns = substr($ids_ordns, 3);

				//productos
				$res = $this->db
					->select('p.id_producto, p.codigo, p.nombre, pu.abreviatura as unidad, pu.nombre as unidad2, cp.taza_iva,
							cp.cantidad, cp.precio_unitario, cp.importe, cp.importe_iva, cp.total')
					->from('ordenest_productos AS cp')
						->join('productos AS p', 'p.id_producto = cp.id_producto', 'inner')
						->join('productos_unidades AS pu', 'p.id_unidad = pu.id_unidad', 'inner')
					->where("cp.id_ordent IN ('".$ids_ordns."')")
				->get();
				if($res->num_rows() > 0){
					$response['productos'] = $res->result();
				}
				$res->free_result();
			}

			return $response;
		}else
			return false;
	}

	/**
	 * Obtiene el folio de acuerdo a la serie seleccionada
	 */
	public function getFolioSerie($serie){
		$res = $this->db->select('folio')->from('facturas')
			->where("serie = '".$serie."'")->order_by('folio', 'DESC')
			->limit(1)->get()->row();
		$folio = (isset($res->folio)? $res->folio: 0)+1;

		$res = $this->db->select('*')->from('facturas_series_folios')
			->where("serie = '".$serie."'")->limit(1)->get()->row();

		if(is_object($res)){
			if($folio < $res->folio_inicio)
				$folio = $res->folio_inicio;

			$res->folio = $folio;
			$msg = 'ok';

			if($folio > $res->folio_fin || $folio < $res->folio_inicio)
				$msg = "El folio ".$folio." está fuera del rango de folios para la serie ".$serie.". <br>
					Verifique las configuraciones para asignar un nuevo rango de folios";
		}else
			$msg = 'La serie no existe.';

		return array($res, $msg);
	}

	/**
	 * Agrega una factura a la bd
	 */
	public function addFactura(){
		$status = ($this->input->post('dcondicion_pago')=='co'? 'pa': 'p');


		$data = array(
      // 'id_factura'       => $id_factura,
      'id_cliente'          => $this->input->post('did_cliente'),
      'id_usuario'          => $this->session->userdata('id_usuario'),
      'serie'               => $this->input->post('dserie'),
      'folio'               => $this->input->post('dfolio'),
      'no_aprobacion'       => $this->input->post('dno_aprobacion'),
      // 'ano_aprobacion'   => $this->input->post('dano_aprobacion'),
      'fecha'               => $this->input->post('dfecha'),
      'domicilio'           => $this->input->post('dcliente_domici'),
      'ciudad'              => $this->input->post('dcliente_ciudad'),
      'subtotal'            => $this->input->post('total_importe'),
      'importe_iva'         => $this->input->post('total_iva'),
      'retencion_iva'       => $this->input->post('total_retiva'),
      'descuento'           => $this->input->post('total_descuento'),
      'total'               => $this->input->post('total_totfac'),
      'total_letra'         => $this->input->post('dttotal_letra'),
      'img_cbb'             => $this->input->post('dimg_cbb'),
      'forma_pago'          => $this->input->post('dforma_pago'),
      'metodo_pago'         => $this->input->post('dmetodo_pago'),
      'metodo_pago_digitos' => $this->input->post('dmetodo_pago_digitos'),
      'condicion_pago'      => $this->input->post('dcondicion_pago'),
      // 'plazo_credito'    => $this->input->post('dplazo_credito'),
      'status'              => $status
		);
		$this->db->insert('facturas', $data);
    $id_factura = $this->db->insert_id();

    $data_productos = array();
    foreach ($_POST['prod_did_prod'] as $k => $v)
    {
      if ($_POST['prod_dreten_iva_porcent'][$k] === '0.04')
        $porc_reten = 4;
      elseif ($_POST['prod_dreten_iva_porcent'][$k] === '0.6666')
        $porc_reten = 66.66;
      elseif ($_POST['prod_dreten_iva_porcent'][$k] === '1')
        $porc_reten = 100;
      else
        $porc_reten = 0;

      $importe_iva = (floatval($_POST['prod_dpreciou'][$k]) * floatval($_POST['prod_diva_porcent'])) / 100;
      $data_productos[] = array(
                                'id_factura'      => $id_factura,
                                'id_producto'     => (empty($v)) ? NULL : $v ,
                                'descripcion'     => $_POST['prod_ddescripcion'][$k],
                                'taza_iva'        => $_POST['prod_diva_porcent'][$k],
                                'cantidad'        => $_POST['prod_dcantidad'][$k],
                                'precio_unitario' => floatval($_POST['prod_dpreciou'][$k]),
                                'importe'         => floatval($_POST['prod_importe'][$k]),
                                'importe_iva'     => $importe_iva,
                                'total'           => floatval($_POST['prod_importe'][$k]) + $importe_iva,
                                'descuento'       => $_POST['prod_ddescuento_porcent'][$k],
                                'retencion'       => $porc_reten,
                              );
    }
    $this->db->insert_batch('facturas_productos', $data_productos);
		return array(true, $status, $id_factura);
	}

	/**
	 * Cancela una factura, la elimina
	 */
	public function cancelaFactura(){
		$this->db->update('facturas', array('status' => 'ca'), "id_factura = '".$_GET['id']."'");

		return array(true, '');
	}

  /**
   * Paga una factura
   */
  public function pagaFactura(){
    $this->db->update('facturas', array('status' => 'pa'), "id_factura = '".$_GET['id']."'");
    return array(true, '');
  }

	/**
	 * Actualiza los digitos del metodo de pago de una factura
	 */
	public function metodo_pago(){
		$this->db->update('facturas', array('metodo_pago_digitos' => $_POST['mp_digitos']), "id_factura = '".$_POST['id_factura']."'");
		return array(true, '');
	}


	/**
	 * Agrega abono a una factura
	 * @param unknown_type $id_factura
	 * @param unknown_type $concepto
	 */
	public function addAbono($id_factura=null, $concepto=null, $registr_bancos=true){
		$id_factura = $id_factura==null? $this->input->get('id'): $id_factura;
		$concepto = $concepto==null? $this->input->post('dconcepto'): $concepto;

		$data = $this->obtenTotalAbonosC($id_factura);
		if($data->abonos < $data->total){ //Evitar que se agreguen abonos si esta pagada
			$pagada = false;
			//compruebo si se pasa el abono al total de la factura y activa a pagado
			if(($this->input->post('dmonto')+$data->abonos) >= $data->total){
				if(($this->input->post('dmonto')+$data->abonos) > $data->total)
					$_POST['dmonto'] = $this->input->post('dmonto') - (($this->input->post('dmonto')+$data->abonos) - $data->total);
				$pagada = true;
			}

			$id_abono = BDUtil::getId();
			$data_abono = array(
					'id_abono' => $id_abono,
					'id_factura' => $id_factura,
					'fecha' => $this->input->post('dfecha'),
					'concepto' => $concepto,
					'total' => $this->input->post('dmonto')
			);
			$this->db->insert('facturas_abonos', $data_abono);

			if($pagada){
				$this->db->update('facturas', array('status' => 'pa'), "id_factura = '".$id_factura."'");
			}

			if($registr_bancos){
				//Registramos la Operacion en Bancos
				$this->load->model('banco_model');
				$respons = $this->banco_model->addOperacion($this->input->post('dcuenta'));
			}

			return array(true, 'Se agregó el abono correctamente.', $id_abono);
		}
		return array(true, 'La orden de trabajo ya esta pagada.', '');
	}

	/**
	 * Elimina abonos de cobranza (de una factura)
	 * @param unknown_type $id_abono
	 * @param unknown_type $id_factura
	 */
	public function deleteAbono($id_abono, $id_factura){
		$this->db->delete('facturas_abonos', "id_abono = '".$id_abono."'");

		$data = $this->obtenTotalAbonosC($id_factura);
		if($data->abonos >= $data->total){ //si abonos es = a la factura se pone pagada
			$this->db->update('facturas', array('status' => 'pa'), "id_factura = '".$id_factura."'");
		}else{ //si abonos es menor se pone pendiente
			$this->db->update('facturas', array('status' => 'p'), "id_factura = '".$id_factura."'");
		}

		return array(true, '');
	}

	private function obtenTotalAbonosC($id){
		$data = $this->db->query("
				SELECT
						c.total,
						COALESCE(ab.abonos, 0) AS abonos
				FROM facturas AS c
					LEFT JOIN (
						SELECT id_factura, Sum(total) AS abonos
						FROM facturas_abonos
						WHERE id_factura = '".$id."' AND tipo <> 'ca'
						GROUP BY id_factura
					) AS ab ON c.id_factura = ab.id_factura
				WHERE c.id_factura = '".$id."'", true);
		return $data->row();
	}




	/**
	 * 					SERIES Y FOLIOS
	 * ***************************************************
	 * Obtiene el listado de series y folios para administrarlos
	 */
	public function getSeriesFolios($per_pag='30'){

		//paginacion
		$params = array(
				'result_items_per_page' => $per_pag,
				'result_page' => (isset($_GET['pag'])? $_GET['pag']: 0)
		);
		if($params['result_page'] % $params['result_items_per_page'] == 0)
			$params['result_page'] = ($params['result_page']/$params['result_items_per_page']);

		$sql = '';
// 		if($this->input->get('fserie')!='')
// 			$this->db->where('serie',$this->input->get('fserie'));

		$query = BDUtil::pagination("SELECT fsf.id_serie_folio, fsf.id_empresa, fsf.serie, fsf.no_aprobacion, fsf.folio_inicio, 
					fsf.folio_fin, fsf.imagen, fsf.leyenda, fsf.leyenda1, fsf.leyenda2, fsf.ano_aprobacion, e.nombre_fiscal AS empresa 
				FROM facturas_series_folios AS fsf 
					INNER JOIN empresas AS e ON e.id_empresa = fsf.id_empresa
				WHERE lower(serie) LIKE '".mb_strtolower($this->input->get('fserie'), 'UTF-8')."' ".$sql."
				ORDER BY fsf.serie", $params, true);
		$res = $this->db->query($query['query']);

		$data = array(
				'series' 			=> array(),
				'total_rows' 		=> $query['total_rows'],
				'items_per_page' 	=> $params['result_items_per_page'],
				'result_page' 		=> $params['result_page']
		);

		if($res->num_rows() > 0)
			$data['series'] = $res->result();

		return $data;
	}

	/**
	 * Obtiene la informacion de una serie/folio
	 * @param unknown_type $id_serie_folio
	 */
	public function getInfoSerieFolio($id_serie_folio = ''){
		$id_serie_folio = ($id_serie_folio != '') ? $id_serie_folio : $this->input->get('id');

		$res = $this->db->select('fsf.id_serie_folio, fsf.id_empresa, fsf.serie, fsf.no_aprobacion, fsf.folio_inicio, 
				fsf.folio_fin, fsf.imagen, fsf.leyenda, fsf.leyenda1, fsf.leyenda2, fsf.ano_aprobacion, e.nombre_fiscal AS empresa')
			->from('facturas_series_folios AS fsf')
				->join('empresas AS e', 'e.id_empresa = fsf.id_empresa', 'inner')
			->where('fsf.id_serie_folio', $id_serie_folio)->get()->result();
		return $res;
	}

	/**
	 * Agrega una serie/folio a la base de datos
	 */
	public function addSerieFolio(){
		$path_img = '';
		//valida la imagen
		$upload_res = UploadFiles::uploadImgSerieFolio();

		if(is_array($upload_res)){
			if($upload_res[0] == false)
				return array(false, $upload_res[1]);
			$path_img = $upload_res[1]['file_name']; //APPPATH.'images/series_folios/'.$upload_res[1]['file_name'];
		}

		$id_serie_folio	= BDUtil::getId();
		$data	= array(
				'id_empresa'     => $this->input->post('fid_empresa'),
				'serie'          => strtoupper($this->input->post('fserie')),
				'no_aprobacion'  => $this->input->post('fno_aprobacion'),
				'folio_inicio'   => $this->input->post('ffolio_inicio'),
				'folio_fin'      => $this->input->post('ffolio_fin'),
				'ano_aprobacion' => $this->input->post('fano_aprobacion'),
				'imagen'         => $path_img,
		);

		if($this->input->post('fleyenda')!='')
			$data['leyenda'] = $this->input->post('fleyenda');

		if($this->input->post('fleyenda1')!='')
			$data['leyenda1'] = $this->input->post('fleyenda1');

		if($this->input->post('fleyenda2')!='')
			$data['leyenda2'] = $this->input->post('fleyenda2');

		$this->db->insert('facturas_series_folios',$data);
		return array(true);
	}

	/**
	 * Modifica la informacion de un serie/folio
	 * @param unknown_type $id_serie_folio
	 */
	public function editSerieFolio($id_serie_folio=''){
		$id_serie_folio = ($id_serie_folio != '') ? $id_serie_folio : $this->input->get('id');

		$path_img = '';
		//valida la imagen
		$upload_res = UploadFiles::uploadImgSerieFolio();

		if(is_array($upload_res)){
			if($upload_res[0] == false)
				return array(false, $upload_res[1]);
			$path_img = $upload_res[1]['file_name']; //APPPATH.'images/series_folios/'.$upload_res[1]['file_name'];

			/*$old_img = $this->db->select('imagen')->from('facturas_series_folios')->where('id_serie_folio',$id_serie_folio)->get()->row()->imagen;

			UploadFiles::deleteFile($old_img);*/
		}

		$data	= array(
				'id_empresa'     => $this->input->post('fid_empresa'),
				'serie'          => strtoupper($this->input->post('fserie')),
				'no_aprobacion'  => $this->input->post('fno_aprobacion'),
				'folio_inicio'   => $this->input->post('ffolio_inicio'),
				'folio_fin'      => $this->input->post('ffolio_fin'),
				'ano_aprobacion' => $this->input->post('fano_aprobacion')
		);

		if($path_img!='')
			$data['imagen'] = $path_img;

		if($this->input->post('fleyenda')!='')
			$data['leyenda'] = $this->input->post('fleyenda');

		if($this->input->post('fleyenda1')!='')
			$data['leyenda1'] = $this->input->post('fleyenda1');

		if($this->input->post('fleyenda2')!='')
			$data['leyenda2'] = $this->input->post('fleyenda2');

		$this->db->update('facturas_series_folios',$data, array('id_serie_folio'=>$id_serie_folio));

		return array(true);
	}

	public function exist($table, $sql, $return_res=false){
		$res = $this->db->get_where($table, $sql);
		if($res->num_rows() > 0){
			if($return_res)
				return $res->row();
			return TRUE;
		}
		return FALSE;
	}


}