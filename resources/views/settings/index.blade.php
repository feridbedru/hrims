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
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Job Category</span>
                    <span class="info-box-number">
                        <a href="{{route('job_categories.job_category.index')}}">Configure</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Job Title Category</span>
                    <span class="info-box-number">
                        <a href="{{route('job_title_categories.job_title_category.index')}}">Configure</a>
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
                    <span class="info-box-text">Job Type</span>
                    <span class="info-box-number">
                        <a href="{{route('job_types.job_type.index')}}">Configure</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"></span>
                <div class="info-box-content">
                    <span class="info-box-text">Language</span>
                    <span class="info-box-number">
                        <a href="{{route('languages.language.index')}}">Configure</a>
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
                  <span class="info-box-text">Language Levels</span>
                  <span class="info-box-number">
                      <a href="{{route('language_levels.language_level.index')}}">Configure</a>
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
                      <a href="{{route('marital_statuses.marital_status.index')}}">Configure</a>
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
                      <a href="{{route('nationalities.nationality.index')}}">Configure</a>
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
                    <a href="{{route('regions.region.index')}}">Configure</a>
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
                    <a href="{{route('skill_categories.skill_category.index')}}">Configure</a>
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
                    <a href="{{route('relationships.relationship.index')}}">Configure</a>
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
                    <a href="{{route('employee_statuses.employee_status.index')}}">Configure</a>
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
                  <a href="{{route('address_types.address_type.index')}}">Configure</a>
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
                  <a href="{{route('experience_types.experience_type.index')}}">Configure</a>
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
                  <a href="{{route('license_types.license_type.index')}}">Configure</a>
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
                  <a href="{{route('educational_institutes.educational_institute.index')}}">Configure</a>
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
                  <a href="{{route('educational_fields.educational_field.index')}}">Configure</a>
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
                  <a href="{{route('disaster_causes.disaster_cause.index')}}">Configure</a>
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
                  <a href="{{route('organization_locations.organization_location.index')}}">Configure</a>
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
            <span class="info-box-text">Sex</span>
            <span class="info-box-number">
                <a href="{{route('sexes.sex.index')}}">Configure</a>
            </span>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"></span>
        <div class="info-box-content">
            <span class="info-box-text">Template Type</span>
            <span class="info-box-number">
                <a href="{{route('template_types.template_type.index')}}">Configure</a>
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
            <span class="info-box-text"></span>
            <span class="info-box-number">
                <a href="{{route('license_types.license_type.index')}}">Configure</a>
            </span>
        </div>
    </div>
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"></span>
        <div class="info-box-content">
            <span class="info-box-text"></span>
            <span class="info-box-number">
                <a href="{{ route('education_levels.education_level.index') }}">Configure</a>
            </span>
        </div>
    </div>
</div>
</div>
@endsection