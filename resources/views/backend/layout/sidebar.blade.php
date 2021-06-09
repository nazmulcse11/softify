<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="{{ asset('backend/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">AdminLTE 3</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{ asset('backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Nazmul Hoque</a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
         <li class="nav-item">
          @if(Session::get('page')=='dashboard')
          <?php $active = 'active'?>
          @else
          <?php $active = ''?>
          @endif
         <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ $active }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Dashboard</p>
         </a>
         </li>
         @if(Session::get('page')=='update-admin-details' || Session::get('page')=='update-admin-password')
          <?php $menu_open = 'menu-open'?>
          @else
          <?php $menu_open = ''?>
          @endif
         <li class="nav-item {{ $menu_open }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Seetings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                @if(Session::get('page')=='update-admin-details')
                <?php $active = 'active'?>
                @else
                <?php $active = ''?>
                @endif
                <a href="{{ url('/admin/update-admin-details') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
              <li class="nav-item">
                @if(Session::get('page')=='update-admin-password')
                <?php $active = 'active'?>
                @else
                <?php $active = ''?>
                @endif
                <a href="{{ url('/admin/update-admin-password') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            @if(Session::get('page')=='products')
            <?php $active = 'active'?>
            @else
            <?php $active = ''?>
            @endif
           <a href="{{ url('/admin/products') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Products</p>
           </a>
           </li>

           <li class="nav-item">
            @if(Session::get('page')=='orders')
            <?php $active = 'active'?>
            @else
            <?php $active = ''?>
            @endif
           <a href="{{ url('/admin/orders') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Orders</p>
           </a>
           </li>

       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>