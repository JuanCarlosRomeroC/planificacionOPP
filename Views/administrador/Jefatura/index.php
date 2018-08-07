<div class="fab" data-target="#newjefaturaModal" data-toggle="modal"> + </div>
<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">LISTA DE JEFATURAS</h2></div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="tablejefaturas" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="10%">nro</th>
					<th width="80%">Nombre</th>
					<th width="10%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado)): ?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5 class="rowtable_nombre<?php echo $row['id'];?>"><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
							<td>
								<a data-target="#updatejefaturaModal" data-toggle="modal" onclick="updateAjax(<?php echo $row['id'];?>)"><button title="ver jefatura" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button></a>
								<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="dar de baja jefatura" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
							</td>
							<?php $aux++; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" id="alert_empty"> <!-- SECTION EMPTY TABLE -->
	<?php if(mysql_num_rows($resultado)<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron JEFATURAS registradas.
			</div>
		</div>
	<?php endif;?>
</div>
<?php 	include 'modalnewjefatura.php';
		include 'modalupdatejefatura.php';?>
<script>
	var id_jefatura_u,row_updatetable;
    $(document).ready(function(){
		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"tablejefaturas","No se encontraron JEFATURAS registradas.");});
		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>5){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Jefatura/crear',
				type: 'post',
				data:{nombre:$('#inputnombre').val()},
					success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
						swal("Mensaje de Alerta!", obj , "success");
					setInterval(function(){ location.reload(); }, 2000);
				}}});});

		function function_validate(validate){
			if(validate!="false"&&validate=="true"){
				if($('.fila1').hasClass('has-success')){
						$("#btnregistrar").attr('disabled', false);}else{$("#btnregistrar").attr('disabled', true);}
			}else{
				if($('.fila1_u').hasClass('has-success') && $('#inputnombre_u').attr('placeholder')!=$('#inputnombre_u').val().trim().toLowerCase()){
					$("#buttonupdate").attr('disabled', false);
				}else{$("#buttonupdate").attr('disabled', true);}
			}
		}
		//UPDATE jefatura
		$('#buttonupdate').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Jefatura/editar/'+id_jefatura_u,
				type: 'post',
				data:{
					nombre:$('#inputnombre_u').val().trim(),nombre_original:$('#inputnombre_u').attr('placeholder')
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
					}
				}
			});
		});
	});
	function updateAjax(val){
		row_updatetable=val;
		$.ajax({
			url: '<?php echo URL;?>Jefatura/ver/'+val,
			type: 'get',
			success:function(obj){
				var data = JSON.parse(obj);$("#buttonupdate").attr('disabled', true);
				small_error(".fila1_u",true);$('#editbox_update').hide();$('#listuserbox_update').show();$('#buttoneditar_update').attr('disabled', false);
				$('.unombre').text(data.jefatura.nombre);
				$('.uunidad').text(data.unidades.length);
				$('.uestado').text(data.jefatura.estado=="1" ? ("Activo") : ("Inactivo"));
				$("#tablejefatura").empty();$("#alert_empty_unidad").hide();
				$('#inputnombre_u').val(data.jefatura.nombre.toLowerCase());
				$('#inputnombre_u').attr('placeholder',data.jefatura.nombre.toLowerCase());
				id_jefatura_u=data.jefatura.id;

				if (data.unidades.length>0) {
					for (var i = 0; i < data.unidades.length; i++) {
						$('#tablejefatura').append('<tr><td style="text-align:left;padding-left:10px">'+parseInt(i+1)+'. '+data.unidades[i].nombre+'</td></tr>');
					}
				}else {
					$("#alert_empty_unidad").show();
				}
			}
		});
	}
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere dar de baja a la Jefatura?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Jefatura/eliminar/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ window.location.href = "/planificationSoft/Jefatura"; }, 1500);
					}
				}
			});
		});
	}
</script>
