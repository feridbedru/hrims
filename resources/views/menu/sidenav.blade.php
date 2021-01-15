<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light">TECHIN</span>
    </a>
    <div class="sidebar">
        <div class=" mt-3 pb-3 mb-3 d-flex">
            <div class="info bg-light">
                <img src="{{ asset('logo.png') }}" width="100%" alt="Logo">
            </div>
        </div>
        <hr>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Structure
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link active">
                                <i class="fas fa-building nav-icon"></i>
                                <p>Organization</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link ">
                                <i class="fas fa-laptop-house nav-icon"></i>
                                <p>Units</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Employees
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon  fas fa-suitcase"></i>
                        <p>
                            Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Evaluation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cafe_student_preference') }}" class="nav-link">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>New</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            ID Card
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link ">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Template Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Print</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>RFID Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>RFID Mapping</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Log</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-business-time"></i>
                        <p>
                            Shift
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Shift Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Recruitment
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link ">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Vacancy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Applicants</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-award"></i>
                        <p>
                            Promotion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link ">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Leave
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link ">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Build Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Saved Report</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('#') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('#') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>User Group</p>
                            </a>
                        </li>
                    </ul>
                </li>
        </nav>
    </div>
</aside>