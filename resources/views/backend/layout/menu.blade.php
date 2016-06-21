<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! gravatarUrl(Auth::user()->email) !!}" class="img-circle" alt="User Image" />

            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name || Auth::user()->email }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ setActive('admin') }}"><a href="{{ url('/admin') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a></li>
            <li class="treeview {{ setActive('admin/category*') }}"><a href="#"> <i class="fa fa-th"></i> <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/category') }}"><i class="fa fa-calendar"></i> All Categories</a>
                    </li>
                    <li><a href="{{ url('/admin/category/create') }}"><i class="fa fa-plus-square"></i> Add Category</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ setActive('admin/post*') }}"><a href="#"> <i class="fa fa-book"></i> <span>Articles</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/post') }}"><i class="fa fa-archive"></i> All Articles</a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/post/create') }}"><i class="fa fa-plus-square"></i> Add Article</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ setActive(['admin/user*', 'admin/group*']) }}"><a href="#"> <i class="fa fa-user"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/user') }}"><i class="fa fa-user"></i> All Users</a>
                    </li>
                    <li><a href="{{ url('/admin/role') }}"><i class="fa fa-group"></i> Add Role</a>
                    </li>
                </ul>
            </li>
            <li class="{{ setActive('admin/logout*') }}">
                <a href="{{ url('/admin/logout') }}"> <i class="fa fa-sign-out"></i> <span>Logout</span> </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>