<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>
                        Personal Information
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee_addresses.employee_address.index')}}" class="nav-link active">
                            <i class="fas fa-address-card nav-icon"></i>
                            <p>Address</p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_bank_accounts.employee_bank_account.index')}}" class="nav-link ">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Bank Accounts</p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_disabilities.employee_disability.index')}}" class="nav-link ">
                            <i class="fas fa-blind nav-icon"></i>
                            <p>Disability </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_educations.employee_education.index')}}" class="nav-link ">
                            <i class="fas fa-school nav-icon"></i>
                            <p>Education </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_emergencies.employee_emergency.index')}}" class="nav-link ">
                            <i class="fas fa-ambulance nav-icon"></i>
                            <p>Emeregency </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_families.employee_family.index')}}" class="nav-link ">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Family </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_languages.employee_language.index')}}" class="nav-link ">
                            <i class="fas fa-language nav-icon"></i>
                            <p>Language </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('employee_licenses.employee_license.index')}}" class="nav-link ">
                            <i class="fas fa-certificate nav-icon"></i>
                            <p>License </p>
                            <span class="badge badge-pill badge-primary"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        Experience
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee_experiences.employee_experience.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_experiences.employee_experience.create')}}" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gavel"></i>
                    <p>
                        Discipline
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
                    <i class="nav-icon fas fa-car-crash"></i>
                    <p>
                        Disaster
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_disasters.employee_disaster.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_disasters.employee_disaster.create')}}" class="nav-link">
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
                        <a href="#" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-certificate"></i>
                    <p>
                        Certification
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee_certifications.employee_certification.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_certifications.employee_certification.create')}}" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
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
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-award"></i>
                    <p>
                        Awards
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_awards.employee_award.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_awards.employee_award.create')}}" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
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
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                        Study & Training
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee_study_trainings.employee_study_training.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_study_trainings.employee_study_training.create')}}" class="nav-link">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>
                        Files
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employee_files.employee_file.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_files.employee_file.create')}}" class="nav-link">
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