@extends('layouts.app')
@section('pagetitle')
    Settings
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Settings</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Job Category</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('job_categories.job_category.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Job Title Category</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('job_title_categories.job_title_category.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Job Type</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('job_types.job_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>Language</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('languages.language.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Language Levels</span>
                    <span class="info-box-number">
                        <a href="{{ route('language_levels.language_level.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Marital Status</span>
                    <span class="info-box-number">
                        <a href="{{ route('marital_statuses.marital_status.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Nationality</span>
                    <span class="info-box-number">
                        <a href="{{ route('nationalities.nationality.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Religion</span>
                    <span class="info-box-number">
                        <a href="{{ route('religions.religion.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Region</span>
                    <span class="info-box-number">
                        <a href="{{ route('regions.region.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Skill Category</span>
                    <span class="info-box-number">
                        <a href="{{ route('skill_categories.skill_category.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Relationships</span>
                    <span class="info-box-number">
                        <a href="{{ route('relationships.relationship.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Employee Statuses</span>
                    <span class="info-box-number">
                        <a href="{{ route('employee_statuses.employee_status.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Address Type</span>
                    <span class="info-box-number">
                        <a href="{{ route('address_types.address_type.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Experience Type</span>
                    <span class="info-box-number">
                        <a href="{{ route('experience_types.experience_type.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">License Type</span>
                    <span class="info-box-number">
                        <a href="{{ route('license_types.license_type.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Education Level</span>
                    <span class="info-box-number">
                        <a href="{{ route('education_levels.education_level.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Educational Institute</span>
                    <span class="info-box-number">
                        <a href="{{ route('educational_institutes.educational_institute.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Educational Field</span>
                    <span class="info-box-number">
                        <a href="{{ route('educational_fields.educational_field.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Disaster Cause</span>
                    <span class="info-box-number">
                        <a href="{{ route('disaster_causes.disaster_cause.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Organization Location</span>
                    <span class="info-box-number">
                        <a href="{{ route('organization_locations.organization_location.index') }}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Sex</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('sexes.sex.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Template Type</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('template_types.template_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Templates</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('templates.template.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>Employee Titles</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('titles.title.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Banks</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('banks.bank.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Bank Account Type</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('bank_account_types.bank_account_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Disability Type</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('disability_types.disability_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>GPA Scales</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('gpa_scales.gpa_scale.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Award Type</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('award_types.award_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Commitment For</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('commitment_fors.commitment_for.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4></h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('disability_types.disability_type.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4></h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">12</i>
                </div>
                <a href="{{ route('gpa_scales.gpa_scale.index') }}" class="small-box-footer">
                    Configure <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
