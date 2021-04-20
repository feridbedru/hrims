@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Setting'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('setting.Setting'))}}</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.AddressType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $addressTypes }}</i>
                </div>
                <a href="{{ route('address_types.address_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.AwardType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $awardType }}</i>
                </div>
                <a href="{{ route('award_types.award_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.Banks')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $bank }}</i>
                </div>
                <a href="{{ route('banks.bank.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.BankAccountType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $bankAccountType }}</i>
                </div>
                <a href="{{ route('bank_account_types.bank_account_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.CertificationVendors')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $certificationVendor }}</i>
                </div>
                <a href="{{ route('certification_vendors.certification_vendor.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.CommitmentFor')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $commitmentFor }}</i>
                </div>
                <a href="{{ route('commitment_fors.commitment_for.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.DisabilityType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $disabilityType }}</i>
                </div>
                <a href="{{ route('disability_types.disability_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.DisasterCause')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $disasterCause }}</i>
                </div>
                <a href="{{ route('disaster_causes.disaster_cause.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.DisasterSeverities')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $disasterSeverity }}</i>
                </div>
                <a href="{{ route('disaster_severities.disaster_severity.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.EducationalField')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $educationalField }}</i>
                </div>
                <a href="{{ route('educational_fields.educational_field.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.EducationalInstitute')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $educationalInstitute }}</i>
                </div>
                <a href="{{ route('educational_institutes.educational_institute.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.EducationLevel')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $educationLevel }}</i>
                </div>
                <a href="{{ route('education_levels.education_level.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.EmployeeStatuses')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $employeeStatus }}</i>
                </div>
                <a href="{{ route('employee_statuses.employee_status.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.ExperienceType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $experienceType }}</i>
                </div>
                <a href="{{ route('experience_types.experience_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__("setting.GPAScales")}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $gPAScale }}</i>
                </div>
                <a href="{{ route('gpa_scales.gpa_scale.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.JobCategory')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $jobCategories }}</i>
                </div>
                <a href="{{ route('job_categories.job_category.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.JobTitleCategory')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $jobTitleCategories }}</i>
                </div>
                <a href="{{ route('job_title_categories.job_title_category.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.JobType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $jobTypes }}</i>
                </div>
                <a href="{{ route('job_types.job_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.Language')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $languages }}</i>
                </div>
                <a href="{{ route('languages.language.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.LanguageLevels')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $languageLevels }}</i>
                </div>
                <a href="{{ route('language_levels.language_level.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.LeaveReasons')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $leftReason }}</i>
                </div>
                <a href="{{ route('left_reasons.left_reason.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.LicenseType')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $licenseType }}</i>
                </div>
                <a href="{{ route('license_types.license_type.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.MaritalStatus')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $maritalStatus }}</i>
                </div>
                <a href="{{ route('marital_statuses.marital_status.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.Nationality')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $nationality }}</i>
                </div>
                <a href="{{ route('nationalities.nationality.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>{{__('setting.OrganizationLocation')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $organizationLocation }}</i>
                </div>
                <a href="{{ route('organization_locations.organization_location.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>{{__('setting.Region')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $region }}</i>
                </div>
                <a href="{{ route('regions.region.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>{{__('setting.Relationships')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $relationship }}</i>
                </div>
                <a href="{{ route('relationships.relationship.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{__('setting.Religion')}}</h4>
                    <p>&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="fas">{{ $religion }}</i>
                </div>
                <a href="{{ route('religions.religion.index') }}" class="small-box-footer">
                    {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>{{__('setting.Sex')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $sex }}</i>
                    </div>
                    <a href="{{ route('sexes.sex.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>{{__('setting.SkillCategory')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $skillcategory }}</i>
                    </div>
                    <a href="{{ route('skill_categories.skill_category.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4>{{__('setting.Templates')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $template }}</i>
                    </div>
                    <a href="{{ route('templates.template.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4>{{__('setting.TemplatesType')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $templateType }}</i>
                    </div>
                    <a href="{{ route('template_types.template_type.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>{{__('setting.Title')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $title }}</i>
                    </div>
                    <a href="{{ route('titles.title.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>{{__('setting.Woredas')}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $woreda }}</i>
                    </div>
                    <a href="{{ route('woredas.woreda.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4>{{(__("setting.Zones"))}}</h4>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fas">{{ $zone }}</i>
                    </div>
                    <a href="{{ route('zones.zone.index') }}" class="small-box-footer">
                        {{(__("setting.Configure"))}} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endsection
