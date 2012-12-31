$(function(){
	//Cargar los productos de una familia
	$(document).on("click", "#prodic_familias tr.fams", function(){
		loader.create();
		$.get(base_url+"panel/productos/ajax_productos_familia/",
			"id="+$(this).attr("data-id")+"&title_familia="+$("td.data-title", this).text(),
			function(data){
			$("#produc_productos").html(data);
			supermodal.on("#link_addprod");
			supermodal.on("#tbl_productos a.btn[rel^=superbox]");
			loader.close();
		}, "html");
	});
	
});


function closeBoxPrdutos(familia){
	$("#rowfam"+familia).click();
	supermodal.close(); //cierra el superbox
}
function buscarProductos(pag){
	pag = parseInt(pag);
	var id_fam = $("#id_familia").val(), 
	txtbuscar = $("#fnombre").val(), pagin = (pag>0? '&pag='+pag: '');
	
	loader.create();
	$.get(base_url+"panel/productos/ajax_productos_tbl/",
		"id="+id_fam+"&fnombre="+txtbuscar+pagin,
		function(data){
			$("#tbl_productos").html(data);
			supermodal.on("#tbl_productos a.btn[rel^=superbox]");
			loader.close();
	});
}

/**
 * Obtiene el listado de familias con ajax y las muestra
 */
function getListaFamilias(){
	loader.create();
	$.get(base_url+"panel/productos/ajax_familia/",
		function(data){
			$("#prodic_familias #conte_tabla").html(data);
			supermodal.on("#prodic_familias .btn[data-sbox=familia]");
			loader.close();
	});
	supermodal.close(); //cierra el superbox
}

/**
 * Elimina una famila de los productos
 * @param obj
 */
function deleteFamilia(obj){
	var id = obj.href.replace(/(.+)\?id=/i, "");
	id = id.replace(".", "-");

	loader.create();
	$.get(obj.href,
		function(resp){
			noty({"text":resp.msg.msg, "layout":"topRight", "type": resp.msg.ico});
			if(resp.msg.ico == 'ok'){
				//si es OK se elimina el row form
				$("#rowfam"+id).remove(); 
			}
			loader.close();
	}, "json");
}

/**
 * Elimina un producto
 * @param obj
 */
function deleteProducto(obj){
	var id = obj.href.replace(/(.+)\?id=/i, "");
	id = id.replace(".", "-");

	loader.create();
	$.get(obj.href,
		function(resp){
			noty({"text":resp.msg.msg, "layout":"topRight", "type": resp.msg.ico});
			if(resp.msg.ico == 'ok'){
				//si es OK se elimina el row form
				$("#rowprod"+id).remove(); 
			}
			loader.close();
	}, "json");
}
