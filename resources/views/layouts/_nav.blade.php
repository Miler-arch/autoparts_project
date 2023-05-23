<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-image">
            <img src="{{asset('image/perfil.png')}}" alt="image" style="width:65px"/>
          </div>
          <div class="profile-name">
            <p class="name">
              {{ Auth::user()->name }}
            </p>
            <p class="designation">
              {{ Auth::user()->email }}
            </p>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fa fa-home menu-icon"></i>
          <span class="menu-title">Dashboard 0.1</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-layouts3" aria-expanded="false" aria-controls="page-layouts3">
          <i class="fa menu-icon">&#xf013;</i>
          <span class="menu-title">Configuración</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-layouts3">
          <ul class="nav flex-column sub-menu">
            @can('category_index')
              <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                 
                  <span class="menu-title"><i class="fa fa-box-open mr-2"></i>Categorias</span>
                </a>
              </li>
            @endcan

            <li class="nav-item">
              <a class="nav-link" href="{{ route('marcas.index') }}">
               
                <span class="menu-title"><i class="fa fa-bookmark mr-3"></i>Marcas</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('medidas.index') }}">
               
                <span class="menu-title"><i class="fa fa-ruler mr-2"></i>Medidas</span>
              </a>
            </li>

            @can('provider_index')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('providers.index') }}">
                
                <span class="menu-title"><i class="fa fa-box mr-2"></i>Proveedores</span>
              </a>
            </li>
            @endcan

            <li class="nav-item">
              <a class="nav-link" href="{{ route('warehouses.index') }}">
                <span class="menu-title"><i class="fa fa-warehouse mr-2"></i>Almacenes</span>
              </a>
            </li>

            @can('product_index')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">
                <span class="menu-title"><i class="fa fa-newspaper mr-2"></i>Artículos</span>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('transfers.index') }}">
          <i class="fa fa-users menu-icon"></i>
          <span class="menu-title">Transferencia de Inventario</span>
        </a>
      </li>



      @can('client_index')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
          <i class="fa fa-users menu-icon"></i>
          <span class="menu-title">Clientes</span>
        </a>
      </li>
      @endcan

      @can('purchase_index')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('purchases.index') }}">
          <i class="fas fa-cart-plus menu-icon"></i>
          <span class="menu-title">Compras</span>
        </a>
      </li>
      @endcan

      @can('sale_index')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('sales.index') }}">
          <i class="fas fa-shopping-cart menu-icon"></i>
          <span class="menu-title">Ventas</span>
        </a>
      </li>
      @endcan

      @can('sale_indexProformas')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('proformas.index') }}">
          <i class="fa fa-book menu-icon"></i>
          <span class="menu-title">Proformas</span>
        </a>
      </li>
      @endcan

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
          <i class="fa fa-user-times menu-icon"></i>
          <span class="menu-title">Usuarios</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-layouts">
          <ul class="nav flex-column sub-menu">
            @can('user_index')
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-user mr-2"></i> Usuario</a></li>
            @endcan

            @can('role_index')
              <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-users mr-1"></i>Roles</a></li>
            @endcan

            @can('permissions_index')
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('permissions.index') }}"><i class="fa fa-lock mr-2"></i>Permisos</a></li>
            @endcan
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-layouts2" aria-expanded="false" aria-controls="page-layouts2">

          <i class="fas fa-chart-bar menu-icon"></i>
          <span class="menu-title">Reportes</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-layouts2">
          <ul class="nav flex-column sub-menu">
            @can('reports_day')
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('reports.day') }}"><i class="fa fa-align-justify mr-2"></i>Dia</a></li>
            @endcan

            @can('reports_date')
              <li class="nav-item"> <a class="nav-link" href="{{ route('reports.date') }}"><i class="fa fa-calendar-check mr-2"></i>Fecha</a></li>
            @endcan
          </ul>
        </div>
      </li>
      
      {{-- <li class="nav-item">
        <a class="nav-link" href="pages/documentation.html">
          <i class="far fa-file-alt menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li> --}}
    </ul>
  </nav>