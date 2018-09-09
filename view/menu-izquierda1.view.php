<!-- Menú de opciones -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="fotos/<?php echo $fotoUsuario; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nombreUsuario; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Mi Área</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Postualaciones</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Hoja de Vida</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="perfil.usuario.view.php"><i class="fa fa-user"></i> Información Personal</a></li>
              <li><a href="perfil.usuario.estudios.view.php"><i class="fa fa-graduation-cap"></i> Formación Académica</a></li>
            <li><a href="#"><i class="fa fa-certificate"></i> Estudios de Especialización</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Conocimiento Técnico</a></li>
            <li><a href="#"><i class="fa fa-laptop"></i> Conocimiento Informático</a></li>
            <li><a href="#"><i class="fa fa-globe"></i> Idiomas</a></li>
            <li><a href="perfil.usuario.experiencia.view.php"><i class="fa fa-clipboard"></i> Experiencia Laboral</a></li>
<!--            <li><a href="laboratorio.view.php"><i class="fa fa-circle-o"></i> Laboratorios</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Genéricos</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Familias</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Unidades de presentación</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Proveedores</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Productos</a></li>-->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Mis Postualaciones</a></li>
            <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i>
            <span>Recomendaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="venta.view.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li><a href="../../xdocumentation/index.html"><i class="fa fa-users"></i> <span>Administración del sistema</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>