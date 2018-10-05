<div class="fab" data-target="#newusuarioModal" data-toggle="modal"> + </div>
<div class="row"><h2 class="text-center" style="margin:20px 0 1px 0;font-weight:300">USUARIOS CON PERMISOS DE VER AGENDA DEL DIRECTOR</h2></div>
<div class="row" style="margin:10px"> <!-- SECTION TABLE USERS -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="table_datas" class="table table-striped table-condensed table-hover">
				<thead>
					<th width="15%">nro</th>
					<th width="50%">Nombres</th>
                         <th width="20%">ci</th>
					<th width="15%">Opciones</th>
				</thead>
				<?php $aux=1; ?>
				<tbody>
					<?php while($row=mysql_fetch_array($resultado['director_users'])): ?>
						<tr>
							<td><h5><?php echo $aux;?></h5></td>
							<td style="text-align:left;padding-left:9px"><h5><?php echo ucwords(strtolower($row['nombre'])); ?></h5></td>
                                   <td><h5><?php echo ucwords(strtolower($row['ci'])); ?></h5></td>
							<td>
								<a  onclick="bajaAjax(<?php echo $row['id'];?>)"><button title="quitar permisos para ver la agenda del director" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a>
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
	<?php if(mysql_num_rows($resultado['director_users'])<1):?>
		<div class="col-md-12">
			<div class="alert alert-error alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>MENSAJE DE ALERTA!</strong> No se encontraron responsables de AUDITORIO registrados.
			</div>
		</div>
	<?php endif;?>
</div>
<?php  include 'modalnewdirector.php';?>
<script>
	var id_jefatura_u,row_updatetable;
    $(document).ready(function(){
          <?php if(mysql_num_rows($resultado['usuarios'])<1){?>
               $("#btnregistrar").attr('disabled', true);
          <?php }?>
		$('#inputsearch').keyup(function(){var data=$(this).val().toLowerCase().trim();SEARCH_DATA(data,"table_datas","No se encontraron JEFATURAS registradas.");});
		$('#inputnombre,#inputnombre_u').keypress(function(e){not_number(e);}).keyup(function(){if($(this).val().trim().length>5){small_error($(this).attr('toggle'),true);}else{small_error($(this).attr('toggle'),false);}function_validate($(this).attr('validate'));});

		$('#btnregistrar').click(function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/alta_usuario_director/'+$('#selectusuario option:selected').val(),
				type: 'get',
				success:function(obj){if (obj=="false") {$('#error_registro').show();}else{
					swal("Mensaje de Alerta!", obj , "success");
				setInterval(function(){
                         location.reload();
                    }, 1000);
			}}});});
	});
	function bajaAjax(val){
		swal({
			title: "¿Estás seguro?",
			text: "Esta Seguro que quiere quitar los permisos para ver la agenda del Director?",
			type: "warning",
			showCancelButton: true,confirmButtonColor: "#d93333",
			confirmButtonText: "Dar de Baja!",
			closeOnConfirm: false
		},function(){
			$.ajax({
				url: '<?php echo URL;?>Configuracion/baja_usuario_director/'+val,
				type: 'get',
				success:function(obj){
					if (obj=="false") {
					}else{
						swal("Mensaje de Alerta!", obj , "success");
						setInterval(function(){ location.reload();}, 1000);
					}
				}
			});
		});
	}
</script>
