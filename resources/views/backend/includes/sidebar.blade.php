<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('admin.dashboard.index') }}" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Quick Access</li>
                <li class="nav-item">
                    <a href="{{ route('admin.mastertable.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Master Table
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>