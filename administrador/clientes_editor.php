<?php
$Uid=$_GET[Uid];

$sql = "SELECT * FROM Usuarios WHERE Uid='$Uid'";
    if(!$result = $mysqli->query($sql)){
        die("Query invalido: " . $sql);
    }          
    /* fetch array asociativo*/
    while ($fila = $result->fetch_assoc()) {
        $Uid = utf8_encode($fila["Uid"]);        
        $Uempresa = utf8_encode($fila["Uempresa"]);  
        $Unombre = utf8_encode($fila["Unombre"]);   
        $Uapellidos = utf8_encode($fila["Uapellidos"]);        
        $Udnicif = utf8_encode($fila["Udnicif"]);  
        $Udireccion = utf8_encode($fila["Udireccion"]);
        $Ucp = utf8_encode($fila["Ucp"]);
        $Ulocalidad = utf8_encode($fila["Ulocalidad"]);
        $Uprovincia = utf8_encode($fila["Uprovincia"]);
        $Upais = utf8_encode($fila["Upais"]);
        $Utlf = utf8_encode($fila["Utlf"]);
        $Uemail = utf8_encode($fila["Uemail"]);
        $Ucondiciones = utf8_encode($fila["Ucondiciones"]);
        $Unews = utf8_encode($fila["Unews"]);
        $Utipo = utf8_encode($fila["Utipo"]);
        $Upassword = utf8_encode($fila["Upassword"]);
        $Uvalidado = utf8_encode($fila["Uvalidado"]);
        $Unumerocompras = utf8_encode($fila["Unumerocompras"]);
        $Ufechaultimacompra = utf8_encode($fila["Ufechaultimacompra"]);
        $Ugastototal = utf8_encode($fila["Ugastototal"]);
        
                
    }
    /* liberamos la memoria asociada al resultado */
    $result->close();
?>


<h2>Editar Cliente</h2><br />
<p class="semillas">Inicio > Clientes > Editar Cliente</p><br />

<form id="formulario_login" method="post" action="<?php echo $INC_url; ?>/administrador/fun_clientes_editor.php">    
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Tipo (Activo: <?php echo strtoupper($Utipo); ?>) :</label>
            </div>
                <select name="Utipo" id="Utipo" class="imput_editar">
                    <option value="<?php echo $Utipo; ?>"><?php echo ''.strtoupper($Utipo).' (Activo)'; ?></option>
                    <option value="PARTICULAR">PARTICULAR</option>
                    <option value="EMPRESA">EMPRESA</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
    
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Empresa:</label>
            </div>
                <input class="imput_editar" name="Uempresa" type="text" id="Uempresa" class=":required" value="<?php echo $Uempresa; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nombre:</label>
            </div>
                <input class="imput_editar" name="Unombre" type="text" id="Unombre" class=":required" value="<?php echo $Unombre; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Apellidos:</label>
            </div>
                <input class="imput_editar" name="Uapellidos" type="text" id="Uapellidos" class=":required" value="<?php echo $Uapellidos; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* DNI / CIF:</label>
            </div>
                <input class="imput_editar" name="Udnicif" type="text" id="Udnicif" class=":required" value="<?php echo $Udnicif; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Udireccion:</label>
            </div>
                <input class="imput_editar" name="Udireccion" type="text" id="Udireccion" class=":required" value="<?php echo $Udireccion; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Código Postal:</label>
            </div>
                <input class="imput_editar" name="Ucp" type="text" id="Ucp" class=":required" value="<?php echo $Ucp; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Localidad:</label>
            </div>
                <input class="imput_editar" name="Ulocalidad" type="text" id="Ulocalidad" class=":required" value="<?php echo $Ulocalidad; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Provincia:</label>
            </div>
                <input class="imput_editar" name="Uprovincia" type="text" id="Uprovincia" class=":required" value="<?php echo $Uprovincia; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Pais:</label>
            </div>
                <input class="imput_editar" name="Upais" type="text" id="Upais" class=":required" value="<?php echo $Upais; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Email:</label>
            </div>
                <input class="imput_editar" name="Uemail" type="text" id="Uemail" class=":required" value="<?php echo $Uemail; ?>" />
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Condiciones (Activo: <?php echo strtoupper($Ucondiciones); ?>) :</label>
            </div>
                <select name="Ucondiciones" id="Ucondiciones" class="imput_editar">
                    <option value="<?php echo $Ucondiciones; ?>"><?php echo ''.strtoupper($Ucondiciones).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* News (Activo: <?php echo strtoupper($Unews); ?>) :</label>
            </div>
                <select name="Unews" id="Unews" class="imput_editar">
                    <option value="<?php echo $Unews; ?>"><?php echo ''.strtoupper($Unews).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Validado (Activo: <?php echo strtoupper($Uvalidado); ?>) :</label>
            </div>
                <select name="Uvalidado" id="Uvalidado" class="imput_editar">
                    <option value="<?php echo $Uvalidado; ?>"><?php echo ''.strtoupper($Uvalidado).' (Activo)'; ?></option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
                                   
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Nº Compras:</label>
            </div>
                <p class="imput_editar"><?php echo $Unumerocompras; ?></p> 
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Ultima Compra:</label>
            </div>
            <p class="imput_editar"><?php echo cambiaf_a_normal($Ufechaultimacompra); ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
            
            <!-- -------------------------------------------------------------------------------------------- -->
            <div class="label_editar">
                <label>* Gasto total €:</label>
            </div>
                <p class="imput_editar"><?php echo $Ugastototal; ?></p>
            <div class="limpiar"></div>
            <!-- -------------------------------------------------------------------------------------------- -->
                        
            
             
             <input type="hidden" name="action" value="1" />
            <input type="hidden" name="Uid" value="<?php echo $Uid; ?>" />

            <div class="colocar_boton">         
            <input class="boton" type="submit" value="Editar" />
            </div>           
            <div class="limpiar"></div>            

        </form>
<br />

