<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            @if (Auth::user()->role == 'admin')
            <a href="{{url('admin_dashboard')}}" class="nav-link">
            @elseif (Auth::user()->role == 'manager') 
            <a href="{{url('manager_dashboard')}}" class="nav-link">
            @else
            <a href="{{url('user_dashboard')}}" class="nav-link">             
            @endif
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @can('isAdmin')
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configurations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('about-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{url('service-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Foods
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('food-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Foods</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('foodorder-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Food Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Accommodation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('room-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rooms</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('roomorder-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Room Orders</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Recreation Facilities
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('recreation-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Facilities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('recreationorder-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Facility Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('user-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
            </ul>
          </li>            
          @endcan

          @can('isManager')
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Foods
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('food-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Foods</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Food Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Accommodation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('room-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rooms</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Room Orders</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Recreation Facilities
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('recreation-datatable')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Facilities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Facility Orders</p>
                </a>
              </li>
            </ul>
          </li>            
          @endcan

          @can('isUser')
          <li class="nav-item">
            <a href="{{url('myfoodorder-datatable')}}" class="nav-link">
              <i class="fas fa-th nav-icon"></i>
              <p>My Food Orders</p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="{{url('myroomorder-datatable')}}" class="nav-link">
              <i class="fas fa-th nav-icon"></i>
              <p>My Room Orders</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{url('myrecreationorder-datatable')}}" class="nav-link">
              <i class="fas fa-th nav-icon"></i>
              <p>My Recreation Orders</p>
            </a>
          </li>         
          @endcan


        </ul>
      </nav>