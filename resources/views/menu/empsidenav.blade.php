<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview {{ request()->is(['employees/*/address*','employees/*/bank_account*','employees/*/disability*','employees/*/education*','employees/*/emergency*','employees/*/family*','employees/*/language*','employees/*/license*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>
                        Personal Information
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee_addresses.employee_address.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/address*') ? 'active' : ' ' }}">
                            <i class="fas fa-address-card nav-icon"></i>
                            <p>Address</p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_bank_accounts.employee_bank_account.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/bank_account*') ? 'active' : ' ' }}">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Bank Accounts</p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_disabilities.employee_disability.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/disability*') ? 'active' : ' ' }}">
                            <i class="fas fa-blind nav-icon"></i>
                            <p>Disability </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_educations.employee_education.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/education*') ? 'active' : ' ' }}">
                            <i class="fas fa-school nav-icon"></i>
                            <p>Education </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_emergencies.employee_emergency.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/emergency*') ? 'active' : ' ' }}">
                            <i class="fas fa-ambulance nav-icon"></i>
                            <p>Emeregency </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_families.employee_family.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/family*') ? 'active' : ' ' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Family </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_languages.employee_language.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/language*') ? 'active' : ' ' }}">
                            <i class="fas fa-language nav-icon"></i>
                            <p>Language </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_licenses.employee_license.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/license*') ? 'active' : ' ' }}">
                            <i class="fas fa-certificate nav-icon"></i>
                            <p>License </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['employees/*/experience*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        Experience
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_experiences.employee_experience.create',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/experience/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_experiences.employee_experience.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/experience*') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gavel"></i>
                    <p>
                        Punishment
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>Administrative</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Judiciary</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['employees/*/disaster*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-car-crash"></i>
                    <p>
                        Disaster
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_disasters.employee_disaster.create',['employee'=>$employee])}}" class="nav-link  {{ request()->is('employees/*/disaster/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_disasters.employee_disaster.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/disaster*') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
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
                        <a href="#" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview  {{ request()->is(['employees/*/certification*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-certificate"></i>
                    <p>
                        Certification
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_certifications.employee_certification.create',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/certification/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_certifications.employee_certification.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/certification','employees/*/certification/show*','employees/*/certification/edit*') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Leave
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
            <li class="nav-item has-treeview {{ request()->is(['employees/*/award*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-award"></i>
                    <p>
                        Awards
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_awards.employee_award.create',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/award/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_awards.employee_award.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/award','employees/*/award/show*','employees/*/award/edit*') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-signature"></i>
                    <p>
                        Attendance
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['employees/*/studytraining*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                        Study & Training
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_study_trainings.employee_study_training.create',['employee'=>$employee])}}" class="nav-link  {{ request()->is('employees/*/studytraining/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_study_trainings.employee_study_training.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/studytraining','employees/*/studytraining/show*','employees/*/studytraining/edit*') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->is(['employees/*/file*']) ? 'menu-open' : ' ' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>
                        Files
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_files.employee_file.index',['employee'=>$employee])}}" class="nav-link {{ request()->is('employees/*/file') ? 'active' : ' ' }}">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_files.employee_file.create',['employee'=>$employee])}}" class="nav-link{{ request()->is('employees/*/file/create') ? 'active' : ' ' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-times-circle"></i>
                    <p>
                        Termination 
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>