<?php
	$users=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
?>
<div class="fab" data-target="#newplanificacionModal" data-toggle="modal"> + </div>
<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE PLANIFICACIONES</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 tab-content" style="margin:0px">

		</div>
	</div>
</div>

<?php 	include 'modalnewplanificacion.php';
		include 'modalupdateplanificacion.php';?>
<script>
   	var id_lugar_u,id_cargo_u,id_user_u,psw_u,id_tipo_u;
	var users_array=['Administrador','Director','Planificador','Jefe de Jefatura','Jefe de Unidad','Normal'];
    $(document).ready(function(){
	    $('#inputsearch').keyup(function(){$('#myTabs a[href="#todos"]').tab('show');
		    var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableusers","No se encontraron PLANIFICACIONES registrados.");});

	    	$('#datetimepicker,#datetimepicker2').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'days'});
	    	$('#datetimepicker_u').datetimepicker({locale: 'es',format: 'YYYY-MM-DD',ignoreReadonly: true,viewMode: 'years'}).on('dp.change', function(e){ function_validate("false");});
		$('#inputobjetivo,#inputobjetivo_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>8){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		//[objetivo:"inputobjetivo",
		//actividad:[actividad1,actividad2,actividadn],
		//fecha_de:fecha,
		//fecha_hasta:fecha,
		//resultados:resultado1|resultado2|resultadon,
		//]
		var aux=0;
		$('#buttonagregar').click(function(){
			if ($('#inputresultado').val().trim()!="") {
				$('#resultado_caja').append('<li class="list-group-item resultado_row'+aux+'" style="padding: 5px 15px 5px 15px;"><span class="badge glyphicon glyphicon-remove badge_click"  row="'+aux+'" aria-hidden="true" style="background:#ca3030;cursor:pointer"> </span>'+$('#inputresultado').val()+'</li>');
				aux++;$('#inputresultado').val("");
			}
			$('.badge_click').click(function(){
				$('.resultado_row'+$(this).attr('row')).remove();
			});
		});
		$('#inputapellido,#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

	    	$('#selecttipo').change(function(){
			accion_tipo("#selecttipo",".inputrow1",".inputrow2");
	    	});
		$('#selecttipo_u').change(function(){
			accion_tipo("#selecttipo_u",".inputrow1_u",".inputrow2_u");
	    	});



		$('#inputapellido,#inputapellido_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputci,#inputci_u').keypress(function(e){yes_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputpassword,#inputpassword_u').keyup(function(){if($(this).val().trim().length>4){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});
		$('#inputtelefono,#inputtelefono_u').keypress(function(e){yes_number(e);}).keyup(function(){function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			var id_lugar=0;
			if ($('#selecttipo option:selected').val()==3) {
				id_lugar=$('#selectjefatura option:selected').val();
			}else{
				if (($('#selecttipo option:selected').val()==4)||($('#selecttipo option:selected').val()==5)){
					id_lugar=$('#selectunidad option:selected').val();
				}
			}
			$.ajax({
				url: '<?php echo URL;?>Usuario/crear',
				type: 'post',
				data:{nombre:$('#inputnombre').val(),apellido:$('#inputapellido').val(),ci:$('#inputci').val(),password:$('#inputpassword').val(),id_cargo:$('#selectcargo option:selected').val(),tipo:$('#selecttipo option:selected').val(),id_lugar:id_lugar,telefono:$('#inputtelefono').val(),},
					success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
						swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ window.location.href = "/<?php echo FOLDER; ?>/Usuario"; }, 2000);
				}}});
		});

		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if(($('.fila1').hasClass('has-success'))&&($('.fila2').hasClass('has-success'))&&($('.fila3').hasClass('has-success'))&&($('.fila4').hasClass('has-success'))&&($('#selectcargo option').length>0)&&($('#selectunidad option').length>0)){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success') && $('.fila2_u').hasClass('has-success') && $('.fila3_u').hasClass('has-success')){
					if (($('#inputpassword_u').val().trim()=="") || ($('.fila4_u').hasClass('has-success'))) {
						if($('#selecttipo_u option:selected').attr('value')==id_tipo_u){
							if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
								($('#inputapellido_u').attr('placeholder')!=$('#inputapellido_u').val().toLowerCase()) ||
								($('#inputci_u').attr('placeholder')!=$('#inputci_u').val()) ||
			                  		($('#inputtelefono_u').attr('placeholder')!=$('#inputtelefono_u').val()) ||
			                  		($('#selectcargo_u option:selected').attr('value')!=id_cargo_u) ||
								($('#selectunidad_u option:selected').attr('value')!=id_lugar_u)
							){
								$("#buttonupdate").attr('disabled', false);
							}else{
								if(($('#selecttipo_u option:selected').val()==4)||($('#selecttipo_u option:selected').val()==5)){
									if($('#selectunidad_u option:selected').attr('value')!=id_lugar_u) {
										$("#buttonupdate").attr('disabled', false);
									}else{$("#buttonupdate").attr('disabled', true);}
								}else{
									if($('#selecttipo_u option:selected').val()==3){
										if ($('#selectjefatura_u option:selected').attr('value')!=id_lugar_u) {
											$("#buttonupdate").attr('disabled', false);
										}else{$("#buttonupdate").attr('disabled', true);}
									}
								}
							}
						}else{$("#buttonupdate").attr('disabled', false);}
					}else{$("#buttonupdate").attr('disabled', true);}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		//UPDATE planificacion
		$('#buttonupdate').click(function(){
			var lugar_update=0;
			if(($('#selecttipo_u option:selected').val()==4)||($('#selecttipo_u option:selected').val()==5)){
				lugar_update=$('#selectunidad_u option:selected').val();
			}else{
				if($('#selecttipo_u option:selected').val()==3){
					lugar_update=$('#selectjefatura_u option:selected').val();
				}
			}
			$.ajax({
				url: '<?php echo URL;?>Usuario/editar/'+id_user_u,
				type: 'post',
				data:{
					nombre:$('#inputnombre_u').val(),apellido:$('#inputapellido_u').val(),
					ci_original:$('#inputci_u').val(),ci:$('#inputci_u').attr('placeholder'),
					id_cargo:$('#selectcargo_u option:selected').val(),id_lugar:lugar_update,
					telefono:$('#inputtelefono_u').val(),tipo:$('#selecttipo_u option:selected').val(),
					password:$('#inputpassword').val(),password_original:psw_u
				},
				success:function(obj){
					if (obj=="false") {
						$('#error_update').show();
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/planificationSoft/Usuario"; }, 1500);
					}
				}
			});
		});
         $('#selectcargo_u, #selectunidad_u, #selectjefatura_u, #selecttipo_u').change(function(){function_validate("false");});
	});
	function updateAjax(val){
		$.ajax({
			url: '<?php echo URL;?>Usuario/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				$('.unombre h5').html(data.nombre+"<br>"+data.apellido);$('.unombre p').text(data.ci);$('.unombre em').text(users_array[data.tipo]);$('.utelefono').text("(+591) "+data.telefono);$('.ucargo').text(data.cargo);$('.uunidad').text(data.unidad==null ? ("No Asignado"):(data.unidad));$('.ujefatura').text(data.jefatura==null ? ("No Asignado"):(data.jefatura));
				$('#inputnombre_u').val(data.nombre.toLowerCase());$('#inputnombre_u').attr('placeholder',data.nombre.toLowerCase());
				$('#inputapellido_u').val(data.apellido.toLowerCase());$('#inputapellido_u').attr('placeholder',data.apellido.toLowerCase());
				$('#inputci_u').val(data.ci);$('#inputci_u').attr('placeholder',data.ci);
				$('#inputpassword_u').val("");$('#inputpassword_u').removeClass('has-success').addClass('has-error');
				$('#inputtelefono_u').val(data.telefono);$('#inputtelefono_u').attr('placeholder',data.telefono);
				$('#selectunidad_u option[value='+data.id_lugar+']').attr('selected','selected');
				$('#selectcargo_u option[value='+data.id_cargo+']').attr('selected','selected');
				$('#selecttipo_u option[value='+data.tipo+']').attr('selected','selected');
				$("#selectunidad_u,#selectcargo_u,#selecttipo_u").selectpicker('refresh');
				accion_tipo("#selecttipo_u",".inputrow1_u",".inputrow2_u");
				id_lugar_u=data.id_lugar;id_cargo_u=data.id_cargo;id_user_u=data.id;id_tipo_u=data.tipo;psw_u=data.password;
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja al Usuario?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Usuario/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Usuario"; }, 1000);
					}
				}
			});
		});
	}
	function altaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de alta al Usuario?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#24be66",
			confirmButtonText: "Dar de Alta!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Usuario/alta/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/<?php echo FOLDER;?>/Usuario"; }, 1000);
					}
				}
			});
		});
	}
</script>
