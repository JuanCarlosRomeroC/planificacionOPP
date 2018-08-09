<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="padding:0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div class="col-md-12" style="background:#17c1e7;padding:0">
        <div class="col-md-12">
            <img src="<?php echo URL; ?>public/images/icons/user_circle.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0">
        </div>
        <h4 class="text-center" style="color:#fff;font-weight:600;margin-bottom:2px">Leo Mamani</h4>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6" style="text-align:right;color:#2289b6;padding-left:0"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 54 años</p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6" style="text-align:left;color:#2289b6;padding-right:0"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Seccion</p>
        </div>
     </div>
     <div class="col-md-12" style="background:#f1f1f1">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/status.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/users.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></div>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">Activo  <span class="glyphicon glyphicon-ok-sign" style="color: #3dd55e" aria-hidden="true"></span></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Administrador</p>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/car.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/location.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></div>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">Mobilidades:<small style="font-size:1.5em;color:#31cfeb;font-weight:700"> 0</small></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Lugares:<small style="font-size:1.5em;color:#31cfeb;font-weight:700"> 0</small></p>

        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/transfer.jpg" alt="profile" class="img-circle center-block hexagon" width="90px" style="margin-top:10px"></div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6"><img src="<?php echo URL; ?>public/images/icons/profile.jpg" alt="profile" class="img-circle center-block" width="90px" style="margin-top:10px"></div>
        <div class="col-md-12">
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-left:0">Planificaciones:<small style="font-size:1.5em;color:#31cfeb;font-weight:700;"> 0</small></p>
            <p class="col-md-6 col-lg-6 col-sm-6 col-xs-6 text-center" style="color:#313131;padding-right:0">Reportes:<small style="font-size:1.5em;color:#31cfeb;font-weight:700"> 0</small></p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7" style="margin:0;padding:0">

</div>
<section>
     <?php
          if (isset($_SESSION['User'])) {
               echo $_SESSION['User']['nombre'];
               foreach ($_SESSION['User'] as $key => $value) {
                    echo $key ."=>".$value."<br>";
               }

          }
     ?>
</section>
