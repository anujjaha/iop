<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('admin.dashboard.index') }}" class="d-block">{{ access()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Quick Access</li>
                <!-- <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mastertable.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Master Table(ADMIN)
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ route('admin.clientdetail.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Client Details
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ipodetails.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            IPO Details
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ipoassignments.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            IPO Assignments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ipoassignments.alloted-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Allotment
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.fees.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Fees
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.loss.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Company Loss
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.stock.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Stock
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.stocktransaction.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Transactions
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ route('admin.profit.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Profit
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ route('admin.tax.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Profit
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.expense.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Expense
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.gift.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Gift
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>