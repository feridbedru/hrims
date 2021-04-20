<a href="#" class="brand-link text-center">
    @php
        $abbreviation = DB::table('organizations')
            ->whereNotNull('abbreviation')
            ->pluck('abbreviation')
            ->first();
    @endphp
    @if (is_null($abbreviation))
        <span class="brand-text font-weight-light">[Abbreviation] </span>
    @else
        <span class="brand-text font-weight-light">{{ $abbreviation }}</span>
    @endif

</a>
<div class="sidebar">
    <div class=" mt-3 pb-3 mb-3 d-flex">
        <div class="info bg-light">
            @php
                $logo = DB::table('organizations')
                    ->whereNotNull('logo')
                    ->pluck('logo')
                    ->first();
            @endphp
            @if (is_null($logo))
                <h2>No Logo</h2>
            @else
                <img src="{{ asset('uploads/organization/' . $logo) }}" width="100%" alt="Logo">
            @endif
        </div>
    </div>
    <hr>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li
                class="nav-item has-treeview {{ request()->is(['organizations*', 'organization_units*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>
                        {{(__('setting.Structure'))}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('organizations.organization.index') }}"
                            class="nav-link {{ request()->is('organizations*') ? 'active' : ' ' }}">
                            <i class="fas fa-building nav-icon"></i>
                            <p>{{(__('setting.Organization'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('organization_units.organization_unit.index') }}"
                            class="nav-link {{ request()->is('organization_units*') ? 'active' : ' ' }}">
                            <i class="fas fa-laptop-house nav-icon"></i>
                            <p>{{(__('setting.OrganizationUnits'))}}</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['employees*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        {{__('setting.Employees')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employees.employee.create') }}"
                            class="nav-link {{ request()->is('employees/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>{{(__('setting.New'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employees.employee.index') }}"
                            class="nav-link {{ request()->is('employees') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>{{(__('setting.List'))}}</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item has-treeview {{ request()->is(['job_positions/create', 'job_positions', 'job_positions/show/*', 'job_positions/*/edit']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon  fas fa-suitcase"></i>
                    <p>
                        {{__('setting.jobs')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('job_positions.job_position.create') }}"
                            class="nav-link {{ request()->is('job_positions/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>{{(__('setting.New'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('job_positions.job_position.index') }}"
                            class="nav-link {{ request()->is(['job_positions', 'job_positions/show/*', 'job_positions/*/edit']) ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>{{(__('setting.List'))}}</p>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item has-treeview">
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
                            <a href="#" class="nav-link">
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
                </li> --}}
            <li
                class="nav-item has-treeview {{ request()->is(['salaries*', 'salary_scales*', 'salary_heights*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link ">
                    <i class="nav-icon  fas fa-money-check-alt"></i>
                    <p>
                        {{__('setting.payement')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('salary_scales.salary_scale.index') }}"
                            class="nav-link {{ request()->is('salary_scales*') ? 'active' : ' ' }}">
                            <i class="fas fa-balance-scale nav-icon"></i>
                            <p>{{(__('setting.SalaryScale'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('salary_heights.salary_height.index') }}"
                            class="nav-link {{ request()->is('salary_heights*') ? 'active' : ' ' }}">
                            <i class="fas fa-sort nav-icon"></i>
                            <p>{{(__('setting.SalaryHeight'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('#') }}" class="nav-link">
                            <i class="fas fa-receipt nav-icon"></i>
                            <p>{{(__('setting.Payroll'))}}</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item has-treeview {{ request()->is(['reports/create', 'reports', 'reports/show/*', 'reports/*/edit']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>
                        {{(__('setting.Report'))}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('reports.report.create') }}"
                            class="nav-link {{ request()->is('reports/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus nav-icon"></i>
                            <p>{{(__('setting.New'))}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports.report.index') }}"
                            class="nav-link {{ request()->is(['reports', 'reports/show/*', 'reports/*/edit']) ? 'active' : ' ' }}">
                            <i class="fas fa-list nav-icon"></i>
                            <p>{{(__('setting.List'))}}</p>
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
                                <p>Role</p>
                            </a>
                        </li>
                    </ul>
                </li>

            <li class="nav-item">
                <a href="{{ route('settings.setting.index') }}"
                    class="nav-link {{ request()->is('settings*') ? 'active' : ' ' }}">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                        {{(__('setting.Setting'))}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('helps.help.index') }}"
                    class="nav-link {{ request()->is('help*') ? 'active' : ' ' }}">
                    <i class="nav-icon fa fa-question"></i>
                    <p>
                        {{(__('setting.help'))}}
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>
