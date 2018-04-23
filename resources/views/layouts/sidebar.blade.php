  <div class="container-fluid" >
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky" style="padding-top: 45">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('/')) ? 'active' : '' }}" href="/">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                   <a class="nav-link {{ (Request::is('stockitems/*')||Request::is('stockitems')) ? 'active' : '' }}" href="/stockitems">
                  <span data-feather="database"></span>
                  Stock Items
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ (Request::is('orders/*')||Request::is('orders')) ? 'active' : '' }}" href="/orders">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ (Request::is('tasks/*')||Request::is('tasks')) ? 'active' : '' }}" href="/tasks">
                  <span data-feather="layers"></span>
                  Tasks
                </a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{ (Request::is('reports/*')||Request::is('reports')) ? 'active' : '' }}" href="/reports">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
            <li>
            </ul>


@include('layouts.logtable')

        </nav>


