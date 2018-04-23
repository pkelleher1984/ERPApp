<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
 


       <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name"></p>
          <p class="app-sidebar__user-designation"></p>
        </div>
      </div>




      <ul class="app-menu">


        <li><a class="app-menu__item {{ (Request::is('/')) ? 'active' : '' }}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>



        <li class="treeview {{ (Request::is('stockitems/*')||Request::is('stockitems')) ? 'is-expanded' : '' }}"><a class="app-menu__item {{ (Request::is('stockitems/*')||Request::is('stockitems')) ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Stock Items</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
            <li><a class="treeview-item {{ (Request::is('stockitems/book*')||stripos(request::fullUrl(),'/stockitems/create?type=book')) ? 'active' : '' }}" href="/stockitems/book"><i class="icon fa fa-circle-o"></i> Books</a></li>
            <li><a class="treeview-item {{ (Request::is('stockitems/disc*')||stripos(request::fullUrl(),'/stockitems/create?type=disc')) ? 'active' : '' }}" href="/stockitems/disc"><i class="icon fa fa-circle-o"></i> Discs</a></li>
            <li><a class="treeview-item {{ (Request::is('stockitems/combo*')||stripos(request::fullUrl(),'/stockitems/create?type=combo')) ? 'active' : '' }}" href="/stockitems/combo"><i class="icon fa fa-circle-o"></i> Combos</a></li>
        
          </ul>



        </li>



        <li class="treeview  {{ (Request::is('orders/*')||Request::is('orders')) ? 'is-expanded' : '' }}"><a class="app-menu__item {{ (Request::is('orders/*')||Request::is('orders')) ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Orders</span><i class="treeview-indicator fa fa-angle-right"></i></a>


 <ul class="treeview-menu">
            <li><a class="treeview-item {{ (Request::is('orders/book*')||stripos(request::fullUrl(),'/orders/create?type=Book')) ? 'active' : '' }}" href="/orders/book"><i class="icon fa fa-circle-o"></i> Books</a></li>
            <li><a class="treeview-item {{ (Request::is('orders/disc*')||stripos(request::fullUrl(),'/orders/create?type=Disc')) ? 'active' : '' }}" href="/orders/disc"><i class="icon fa fa-circle-o"></i> Discs</a></li>
            <li><a class="treeview-item {{ (Request::is('orders/combo*')||stripos(request::fullUrl(),'/orders/create?type=Combo')) ? 'active' : '' }}" href="/orders/combo"><i class="icon fa fa-circle-o"></i> Combos</a></li>

          </ul>



        </li>


        <li class="treeview  {{ (Request::is('tasks/*')||Request::is('tasks')) ? 'is-expanded' : '' }}"><a class="app-menu__item {{ (Request::is('tasks/*')||Request::is('tasks')) ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Tasks</span><i class="treeview-indicator fa fa-angle-right"></i></a>
 <ul class="treeview-menu">
            <li><a class="treeview-item {{ (Request::is('tasks/print*')) ? 'active' : '' }}" href="/tasks/print"><i class="icon fa fa-circle-o"></i> Print</a></li>
            <li><a class="treeview-item {{ (Request::is('tasks/bind*')) ? 'active' : '' }}" href="/tasks/bind"><i class="icon fa fa-circle-o"></i> Bind</a></li>
            <li><a class="treeview-item {{ (Request::is('tasks/build*')) ? 'active' : '' }}" href="/tasks/build"><i class="icon fa fa-circle-o"></i> Build</a></li>

          </ul>




        </li>

        
        <li><a class="app-menu__item {{ (Request::is('controlpanel/*')||Request::is('controlpanel')) ? 'active' : '' }}" href="/controlpanel"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Control Panel</span></a></li>


        <li><a class="app-menu__item {{ (Request::is('reports/*')||Request::is('reports')) ? 'active' : '' }}" href="/reports"><i class="app-menu__icon fa fa-signal"></i><span class="app-menu__label">Reports</span></a></li>
   





      </ul>

    </aside>

