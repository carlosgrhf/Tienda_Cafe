<div id="marco" style="background-color: #99aab0;">
<div class="contenedor_marco" style="background-color: #99aab0">


    <div style="float:left;">        
        <a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=1" title="Inicio">
            <img src="<?php echo $INC_url; ?>/administrador/iconos/blacks/32x32/home.png" alt="Home" style="margin-top:-12px; vertical-align: middle;">
            <span style="margin-left: 5px;">Inicio</span>
        </a>
    </div>

    <div style="float:left; margin-left: 27%;">
        
        <strong>PANEL DE ADMINISTRACIÓN</strong>
    
    </div>
    <div style="float:right;"> 
        <img src="<?php echo $INC_url; ?>/administrador/iconos/blacks/32x32/user.png" alt="Home" style="margin-top:-12px; vertical-align: middle;">
        <?php
        if($_SESSION[Aid]!=""){
            echo "Hola <strong> $_SESSION[Anombre]</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '<a class="linkmenu" href="'.$INC_url.'/administrador/cerrar_sesion.php">
                <img src="'.$INC_url.'/administrador/iconos/blacks/32x32/on-off.png" alt="Home" style="margin-top:-12px; vertical-align: middle;">
                <span style="margin-left: 5px;">Salir</span></a>';
        }
        ?>        
    </div>
</div>
</div>

<div id="cabecera">
<div class="contenedor_cabecera">
    
    <div id="marco_logo2">            
        <a class="logo" href="<?php echo $INC_url; ?>" title="Inicio">
            <p>Café en Cápsula</p>
        </a>
    </div>
    <div class="accesos_admin">
        <p><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=20">Newsletter</a></p><br />
        <p><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=1000">Estadísticas</a></p><br />
        <p><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2000">Log</a></p>
    </div>
</div>
</div>

<?php
if($_SESSION[Aid]!=""){
?>
<div id="menu">
<div class="contenedor_menu">
        
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/users.png" alt="Usuarios" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=2">Usuarios</a></p> 
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/document.png" alt="Páginas" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=3">Paginas</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=4"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/layers_1.png" alt="Blog" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=4">Blog</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=5"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/picture.png" alt="Imágenes" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=5">Imágenes</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=6"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/folder.png" alt="Ficheros" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=6">Ficheros</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=7"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/2x2_grid.png" alt="Slider" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=7">Slider</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=8"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/emotion_smile.png" alt="Clientes" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=8">Clientes</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/doc_edit.png" alt="Pedidos" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=9">Pedidos</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=10"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/db.png" alt="Productos" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=10">Productos</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=12"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/cog.png" alt="Portes" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=12">Portes</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=13"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/doc_lines_stright.png" alt="Facturas" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=13">Facturas</a></p>
        <p class="recuadro"><a href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=14"><img src="<?php echo $INC_url; ?>/administrador/iconos/white/32x32/star.png" alt="Vales" style="height: 27px; margin-bottom:3px;"></a><br /><a class="linkmenu" href="<?php echo $INC_url; ?>/administrador/panel_administrador.php?var=14">Vales</a></p>
    
        
            
    
    
        <div class="limpiar"></div>    
        
</div>
</div>
<?php
}
?>
        
    
