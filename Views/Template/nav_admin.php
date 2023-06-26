    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
      <div>
          <p class="app-sidebar__user-name"><?php echo($_SESSION['userData']['Nombre']); ?></p>  
          <p class="app-sidebar__user-designation"><?php echo($_SESSION['userData']['Nombre_Rol']); ?></p>
        </div>
      </div>
      <ul class="app-menu">
       
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
       
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                <span class="app-menu__label">Seguridad</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/preguntas_seguridad"><i class="icon fa fa-circle-o"></i> Preguntas seguridad</a></li>
            </ul>
        </li>
       
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Clientes</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/bitacora">
                <i class="app-menu__icon fa fa-book" aria-hidden="true"></i>
                <span class="app-menu__label">Bitacora</span>
            </a>
        </li>
       
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                <span class="app-menu__label">Tienda</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                
                <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa fa-circle-o"></i> Productos</a></li>
                
                <li><a class="treeview-item" href="<?= base_url(); ?>/categorias"><i class="icon fa fa-circle-o"></i> Categorías</a></li>
              
            </ul>
        </li>
       
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="app-menu__label">Pedidos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/objetos">
                <i class="icon fa fa-desktop" aria-hidden="true"></i>
                <span class="app-menu__label">Objetos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/parametros">
                <i class="icon fa fa-key" aria-hidden="true"></i>
                <span class="app-menu__label">Parametros</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar sesión</span>
            </a>
        </li>
      </ul>
    </aside>