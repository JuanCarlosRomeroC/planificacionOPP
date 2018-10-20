<div class="fab" data-target="#newunidadModal" data-toggle="modal"> + </div>
<div class="row">
	<h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE UNIDADES</h2>
</div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tableunidades" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="9%">nro</th>
					<th width="40%">jefatura</th>
					<th width="40%">unidad</th>
					<th width="11%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado["unidades"])): ?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 class="rowtable_jefatura<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['jefatura'])); ?></h5></td>
							<td><h5 class="rowtable_nombre<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
							<td>
								<a data-target="#updateunidadModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="editar unidad" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
								<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja unidad" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
							</td>
						</tr>
						<?php $aux++; ?>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado["unidades"])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron UNIDADES registradas.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewunidad.php';
		include 'modalupdateunidad.php';?>
<script>
   	var id_jefatura_u,id_unidad_u,row_updatetable,nombre_jefaturatext;
    $(document).ready(function(){

		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tableunidades","No se encontraron UNIDADES registradas.");});

		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>6){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Unidad/crear',
				type: 'post',
				data:{nombre:$('#inputnombre').val(),id_jefatura:$('#selectjefatura option:selected').val()},
					success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
						swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 1500);
				}}});});

		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success')){
					if(($('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()) ||
						($('#selectjefatura_u option:selected').attr('value')!=id_jefatura_u)
					){
						$("#buttonupdate").attr('disabled', false);
					}else{
						$("#buttonupdate").attr('disabled', true);
					}
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		//UPDATE unidad

		$('#buttonupdate').click(function(){
			nombre_jefaturatext=$('#selectjefatura_u option:selected').text();
			$.ajax({
				url: '<?php echo URL;?>Unidad/editar/'+id_unidad_u,
				type: 'post',
				data:{
					nombre:$('#inputnombre_u').val().trim(),nombre_original:$('#inputnombre_u').attr('placeholder'),
					id_jefatura:$('#selectjefatura_u option:selected').val()
				},
				success:function(obj){
					$("#buttonupdate").attr('disabled', true);
					if (obj=="false") {
						$('#error_update').show();
					}else{
						$('#error_update').hide();
						$('#buttoneditar_update').attr('disabled', false);
						$( "#editbox_update" ).toggle( "slide" );
						$( "#listuserbox_update" ).toggle( "slide" );
						$('.unombre').text($('#inputnombre_u').val().trim());
						$('#inputnombre_u').attr('placeholder',$('#inputnombre_u').val().trim().toLowerCase());

						$('.rowtable_nombre'+row_updatetable).text($('#inputnombre_u').val());
						$('.rowtable_jefatura'+row_updatetable).text(nombre_jefaturatext);
					}
				}
			});
		});
         $('#selectjefatura_u').change(function(){function_validate("false");});
	});
	function updateAjax(val){
		row_updatetable=val;$("#buttonupdate").attr('disabled', true);
		$.ajax({
			url: '<?php echo URL;?>Unidad/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);
				small_error(".fila1_u",true);
				$('#editbox_update').hide();$('#listuserbox_update').show();$('#buttoneditar_update').attr('disabled', false);
				$('.unombre').text(data.unidad.nombre);
				$('#inputnombre_u').val(data.unidad.nombre.toLowerCase());
				$('#inputnombre_u').attr('placeholder',data.unidad.nombre.toLowerCase());
				$('.uusuarios').text(data.usuarios.length);
				$('.uestado').text(data.unidad.estado=="1" ? ("Activo") : ("Inactivo"));
				$('.ujefe').text(data.encargado.nombre==null?('Sin Encargado'):(data.encargado.nombre));
				$('#selectjefatura_u option[value='+data.unidad.id_jefatura+']').attr('selected','selected');
				$("#selectjefatura_u").selectpicker('refresh');
				id_jefatura_u=data.unidad.id_jefatura;id_unidad_u=data.unidad.id;
				$("#tableunidad").empty();$("#alert_empty_usuario").hide();
				if (data.usuarios.length>0) {
					for (var i = 0; i < data.usuarios.length; i++) {
						$('#tableunidad').append('<tr><td style="text-align:left;padding-left:10px">'+parseInt(i+1)+'. '+data.usuarios[i].nombre+' '+data.usuarios[i].apellido+'</td></tr>');
					}
				}else {
					$("#alert_empty_usuario").show();
				}
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja al Unidad?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Unidad/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload(); }, 1000);
					}
				}
			});
		});
	}
</script>
