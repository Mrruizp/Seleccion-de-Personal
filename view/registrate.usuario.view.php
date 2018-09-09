
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> RR. HH. | Registrar Usuario</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include_once 'estilos.view.php'; ?>
    </head>

    <body>
        <div class="container">
            <div class="login-box-body">  
                <div class="logo">
                    <img src="../images/logo_1.jpg" class="col-ms-2">   
                </div>    
                <div class="login-logo">
                    <a href=".#"><b>Crear una</b> Cuenta</a>
                </div>
                <!-- /.login-logo -->

                <p class="login-box-msg">Registre correctamente sus datos</p>

                <!--<form id="frmgrabar">-->
                <form id="frmgrabar">
                    <!--<form id="frmgrabar" role="form" enctype="multipart/form-data" action="../controller/registrate.usuario.agregar.editar.controller.php" method="post">-->

                    <div class="row">  

                        <div class="col-xs-3">
                            <p>
                                <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">
                                Código <input type="text" 
                                              name="txtCodigo" 
                                              id="txtCodigo" 
                                              class="form-control input-sm text-bold" 
                                              readonly="">
                            </p>
                        </div>   
                        <div class="col-xs-2">
                            <div class="form-group has-feedback">
                                <label>Dni</label>
                                
                            </div>
                        </div>   
                    </div>   
                    <div class="row">  
                        <div class="col-xs-6">
                            <div class="form-group has-feedback">
                                <label>Nombres</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" required="" autofocus="">
                            </div>
                        </div>   
                        <div class="col-xs-6">
                            <div class="form-group has-feedback">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" id="txtApellidos" name="txtApellidos" required="" autofocus="">
                            </div>
                        </div>   
                    </div>   
                    <div class="row">  
                        <div class="col-xs-6">
                            <div class="form-group has-feedback">
                                <label>Dirección</label>
                                <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" required="" autofocus="">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-2">
                                <label>Estado Civil</label>
                                <select size="1" id="estado_civil" name="estado_civil" class="form-control has-feedback-left" required> 
                                    <option>-</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Viudo">Viudo</option>
                                    <option value="Divorciado">Divorciado</option>
                                </select>
                            </div>
                        </div>   
                    </div>   
                    <div class="row">  
                        <div class="col-xs-3">
                            <div class="form-group has-feedback">
                                <label>Departamento</label>
                                
                            </div>
                        </div>   
                        <div class="col-xs-3">
                            <div class="form-group has-feedback">
                                <label>Provincia</label>
                                
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group has-feedback">
                                <label>Email</label>
                                <input type="email" id="txtEmail" class="form-control" name="txtEmail" required="" onChange="javascript:document.getElementById('cuenta').value = this.value;">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>         
                    </div>   
                    <div class="row">       
                        <div class="col-xs-2">
                            <div class="form-group has-feedback">
                                <label>Teléfono</label>
                                <input type="text" id="txtTelefono" class="form-control" name="txtTelefono" required="" autofocus="">
                            </div>
                        </div>   
                        <div class="col-xs-2">
                            <div class="form-group has-feedback">
                                <label>Sexo</label>
                                <select size="1" id="sexo" name="sexo" class="form-control has-feedback-left" required> 
                                    <option>-</option>
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                </select>
                            </div>
                        </div>      
                        <div class="col-xs-2">
                            <div class="form-group has-feedback">
                                <label>Edad</label>
                                <select size="1" id="edad" name="edad" class="form-control has-feedback-left" required> 
                                    <option>-</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                    <option value="60">60</option>
                                </select>
                            </div>
                        </div>      
                        <div class="col-xs-2">
                            <div class="form-group has-feedback">
                                <label>Núm. de Hijos</label>
                                <select size="1" id="hijo" name="hijo" class="form-control has-feedback-left" required> 
                                    <option>-</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="a más">a más</option>
                                </select>
                            </div>
                        </div>      
                        <!--           <div class="col-xs-2">
                                    <div class="form-group has-feedback">
                                      <label>Disp. Laboral</label>
                                      <select size="1" name="dispLaboral" class="form-control has-feedback-left" id="dispLaboral" required> 
                                            <option>-</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>
                                    </div>
                                   </div>      -->
                        <!--           <div class="col-xs-2">
                                    <div class="form-group has-feedback">
                                      <label>C. de Residencia</label>
                                      <select size="1" name="cambio_residencia" class="form-control has-feedback-left" id="cambio_residencia" required> 
                                            <option>-</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>
                                    </div>
                                   </div>   -->
                    </div>
                    <div class="row">  
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group has-feedback">
                                <label>Usuario</label>
                                <input type="text" name="cuenta" class="form-control has-feedback-left" id="cuenta" readonly="true">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>     
                        <div class="col-xs-5">
                            <div class="form-group has-feedback">
                                <label>Contraseña</label>
                                <input type="password" name="contrasenia" class="form-control has-feedback-left" id="contrasenia" required>
                                <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning btn-block btn-flat" aria-hidden="true"> <i class=""></i> CREAR CUENTA </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!--<div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div> -->
                <!-- /.social-auth-links -->
                <br/><br/>
                <!--                <div class="text-center">
                                    <p>¿No tiene una cuenta?</p>
                                    <a href="registrate.usuario.view.php" class=""> Cree una.</a>
                                    <a href="register.html" class="text-center">Register a new membership</a>
                                </div>-->
            </div>
            <!-- /.login-box-body -->
        </div>
        <div class="text-center">
            <p class="text-black">
                ©<?php echo date('Y'); ?> 
                Copyright - VICSAC. Todos los derechos reservados.
            </p>
        </div>
        <!-- /.login-box -->
        <?php include_once 'scripts.view.php'; ?>>
        <script src="js/registrate.usuario.js" type="text/javascript"></script>
    </body>
</html>