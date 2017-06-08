<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->image }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->first_name }}</p>
                <p>{{ Auth::user()->last_name }}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-table"></i> All users</a>
                    </li>
                    <li class="active"><a href="{{ route('user.create') }}"><i class="fa fa-edit"></i> Create user</a>
                    </li>
                    <li class="active"><a href="{{ route('user.search') }}"><i class="fa fa-search"></i> Search
                            users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Cars</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('car.index') }}"><i class="fa fa-table"></i> All cars</a></li>
                    <li class="active"><a href="{{ route('car.create') }}"><i class="fa fa-edit"></i> Create car</a>
                    </li>
                    <li class="active"><a href="{{ route('car.search') }}"><i class="fa fa-search"></i> Search car</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Routes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('route.index') }}"><i class="fa fa-table"></i> All routes</a>
                    </li>
                    <li class="active"><a href="{{ route('route.create') }}"><i class="fa fa-edit"></i> Create route</a>
                    </li>
                    <li class="active"><a href="{{ route('route.search') }}"><i class="fa fa-search"></i> Search routes</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Costs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('cost.index') }}"><i class="fa fa-table"></i> All costs</a>
                    </li>
                    <li class="active"><a href="{{ route('cost.create') }}"><i class="fa fa-edit"></i> Create cost</a>
                    </li>
                    <li class="active"><a href="{{ route('cost.search') }}"><i class="fa fa-search"></i> Search
                            costs</a></li>
                </ul>
            </li>

            @if(Auth::user()->role_id == 3)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Companies</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('company.index') }}"><i class="fa fa-table"></i> All
                                companies</a></li>
                        <li class="active"><a href="{{ route('company.create') }}"><i class="fa fa-edit"></i> Create
                                company</a></li>
                        <li class="active"><a href="{{ route('company.search') }}"><i class="fa fa-search"></i> Search
                                companies</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->role_id == 3)
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Roles</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('role.index') }}"><i class="fa fa-table"></i> All roles</a>
                        </li>
                        <li class="active"><a href="{{ route('role.create') }}"><i class="fa fa-edit"></i> Create
                                role</a></li>
                        <li class="active"><a href="{{ route('role.search') }}"><i class="fa fa-search"></i> Search
                                roles</a></li>
                    </ul>
                </li>
            @endif

            <li class="treeview">
                <a href="{{ route('settings.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Settings</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

