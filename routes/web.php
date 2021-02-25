<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Setting\OrganizationLocationsController;
use App\Http\Controllers\Setting\JobCategoriesController;
use App\Http\Controllers\Setting\JobTitleCategoriesController;
use App\Http\Controllers\Setting\JobTypesController;
use App\Http\Controllers\Setting\LanguagesController;
use App\Http\Controllers\Setting\LanguageLevelsController;
use App\Http\Controllers\Setting\MaritalStatusesController;
use App\Http\Controllers\Setting\NationalitiesController;
use App\Http\Controllers\Setting\ReligionsController;
use App\Http\Controllers\Setting\RegionsController;
use App\Http\Controllers\Setting\ZonesController;
use App\Http\Controllers\Setting\WoredasController;
use App\Http\Controllers\Setting\SkillCategoriesController;
use App\Http\Controllers\Setting\RelationshipsController;
use App\Http\Controllers\Setting\EmployeeStatusesController;
use App\Http\Controllers\Setting\AddressTypesController;
use App\Http\Controllers\Setting\ExperienceTypesController;
use App\Http\Controllers\Setting\LicenseTypesController;
use App\Http\Controllers\Setting\EducationLevelsController;
use App\Http\Controllers\Setting\EducationalInstitutesController;
use App\Http\Controllers\Setting\EducationalFieldsController;
use App\Http\Controllers\Setting\DisasterCausesController;
use App\Http\Controllers\Setting\SexesController;
use App\Http\Controllers\Setting\TemplateTypesController;
use App\Http\Controllers\Setting\TemplatesController;
use App\Http\Controllers\Setting\TitlesController;
use App\Http\Controllers\Setting\BanksController;
use App\Http\Controllers\Setting\BankAccountTypesController;
use App\Http\Controllers\Setting\DisabilityTypesController;
use App\Http\Controllers\Setting\GPAScalesController;
use App\Http\Controllers\Setting\AwardTypesController;
use App\Http\Controllers\Setting\CommitmentForsController;
use App\Http\Controllers\Setting\LeftReasonsController;
use App\Http\Controllers\Setting\DisasterSeveritiesController;
use App\Http\Controllers\Setting\CertificationVendorsController;
use App\Http\Controllers\OrganizationUnitsController;
use App\Http\Controllers\HelpsController;
use App\Http\Controllers\SalaryScalesController;
use App\Http\Controllers\SalaryStepsController;
use App\Http\Controllers\SalaryHeightsController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\JobPositionsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EmployeeAddressesController;
use App\Http\Controllers\EmployeeBankAccountsController;
use App\Http\Controllers\EmployeeDisabilitiesController;
use App\Http\Controllers\EmployeeEducationsController;
use App\Http\Controllers\EmployeeEmergenciesController;
use App\Http\Controllers\EmployeeFamiliesController;
use App\Http\Controllers\EmployeeLanguagesController;
use App\Http\Controllers\EmployeeLicensesController;
use App\Http\Controllers\EmployeeExperiencesController;
use App\Http\Controllers\EmployeeDisastersController;
use App\Http\Controllers\EmployeeDisasterIndeminitiesController;
use App\Http\Controllers\EmployeeDisasterWitnessesController;
use App\Http\Controllers\EmployeeCertificationsController;
use App\Http\Controllers\EmployeeAwardsController;
use App\Http\Controllers\EmployeeStudyTrainingsController;
use App\Http\Controllers\EmployeeFilesController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
     'prefix' => 'organizations',
 ], function () {
     Route::get('/', [OrganizationsController::class,'index'])->name('organizations.organization.index');
     Route::get('/create',[OrganizationsController::class,'create'])->name('organizations.organization.create');
     Route::get('/show/{organization}',[OrganizationsController::class,'show'])->name('organizations.organization.show')->where('id', '[0-9]+');
     Route::get('/{organization}/edit',[OrganizationsController::class,'edit'])->name('organizations.organization.edit')->where('id', '[0-9]+');
     Route::post('/', [OrganizationsController::class,'store'])->name('organizations.organization.store');
     Route::put('organization/{organization}', [OrganizationsController::class,'update'])->name('organizations.organization.update')->where('id', '[0-9]+');
     Route::delete('/organization/{organization}',[OrganizationsController::class,'destroy'])->name('organizations.organization.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
      'prefix' => 'settings',
  ], function () {
      Route::get('/', [SettingsController::class,'index'])->name('settings.setting.index');
  });

 Route::group([
     'prefix' => 'settings/organization_locations',
 ], function () {
     Route::get('/', [OrganizationLocationsController::class,'index'])->name('organization_locations.organization_location.index');
     Route::get('/create',[OrganizationLocationsController::class,'create'])->name('organization_locations.organization_location.create');
     Route::get('/{organizationLocation}/edit',[OrganizationLocationsController::class,'edit'])->name('organization_locations.organization_location.edit')->where('id', '[0-9]+');
     Route::post('/', [OrganizationLocationsController::class,'store'])->name('organization_locations.organization_location.store');
     Route::put('organization_location/{organizationLocation}', [OrganizationLocationsController::class,'update'])->name('organization_locations.organization_location.update')->where('id', '[0-9]+');
     Route::delete('/organization_location/{organizationLocation}',[OrganizationLocationsController::class,'destroy'])->name('organization_locations.organization_location.destroy')->where('id', '[0-9]+');
 });

Route::group([
    'prefix' => 'settings/job_category',
], function () {
    Route::get('/', [JobCategoriesController::class, 'index'])->name('job_categories.job_category.index');
    Route::get('/create',[JobCategoriesController::class, 'create'])->name('job_categories.job_category.create');
    Route::get('/{jobCategory}/edit',[JobCategoriesController::class, 'edit'])->name('job_categories.job_category.edit')->where('id', '[0-9]+');
    Route::post('/', [JobCategoriesController::class, 'store'])->name('job_categories.job_category.store');
    Route::put('job_category/{jobCategory}', [JobCategoriesController::class, 'update'])->name('job_categories.job_category.update')->where('id', '[0-9]+');
    Route::post('/delete/{jobCategory}',[JobCategoriesController::class, 'destroy'])->name('job_categories.job_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/job_title_categories',
], function () {
    Route::get('/', [JobTitleCategoriesController::class, 'index'])->name('job_title_categories.job_title_category.index');
    Route::get('/create',[JobTitleCategoriesController::class, 'create'])->name('job_title_categories.job_title_category.create');
    Route::get('/{jobTitleCategory}/edit',[JobTitleCategoriesController::class, 'edit'])->name('job_title_categories.job_title_category.edit')->where('id', '[0-9]+');
    Route::post('/', [JobTitleCategoriesController::class, 'store'])->name('job_title_categories.job_title_category.store');
    Route::put('job_title_category/{jobTitleCategory}', [JobTitleCategoriesController::class, 'update'])->name('job_title_categories.job_title_category.update')->where('id', '[0-9]+');
    Route::post('/delete/{jobTitleCategory}',[JobTitleCategoriesController::class, 'destroy'])->name('job_title_categories.job_title_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/job_types',
], function () {
    Route::get('/', [JobTypesController::class, 'index'])->name('job_types.job_type.index');
    Route::get('/create',[JobTypesController::class, 'create'])->name('job_types.job_type.create');
    Route::get('/{jobType}/edit',[JobTypesController::class, 'edit'])->name('job_types.job_type.edit')->where('id', '[0-9]+');
    Route::post('/', [JobTypesController::class, 'store'])->name('job_types.job_type.store');
    Route::put('job_type/{jobType}', [JobTypesController::class, 'update'])->name('job_types.job_type.update')->where('id', '[0-9]+');
    Route::delete('/job_type/{jobType}',[JobTypesController::class, 'destroy'])->name('job_types.job_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/languages',
], function () {
    Route::get('/', [LanguagesController::class, 'index'])->name('languages.language.index');
    Route::get('/create',[LanguagesController::class, 'create'])->name('languages.language.create');
    Route::get('/{language}/edit',[LanguagesController::class, 'edit'])->name('languages.language.edit')->where('id', '[0-9]+');
    Route::post('/', [LanguagesController::class, 'store'])->name('languages.language.store');
    Route::put('language/{language}', [LanguagesController::class, 'update'])->name('languages.language.update')->where('id', '[0-9]+');
    Route::delete('/language/{language}',[LanguagesController::class, 'destroy'])->name('languages.language.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/language_levels',
], function () {
    Route::get('/', [LanguageLevelsController::class, 'index'])->name('language_levels.language_level.index');
    Route::get('/create',[LanguageLevelsController::class, 'create'])->name('language_levels.language_level.create');
    Route::get('/{languageLevel}/edit',[LanguageLevelsController::class, 'edit'])->name('language_levels.language_level.edit')->where('id', '[0-9]+');
    Route::post('/', [LanguageLevelsController::class, 'store'])->name('language_levels.language_level.store');
    Route::put('language_level/{languageLevel}', [LanguageLevelsController::class, 'update'])->name('language_levels.language_level.update')->where('id', '[0-9]+');
    Route::delete('/language_level/{languageLevel}',[LanguageLevelsController::class, 'destroy'])->name('language_levels.language_level.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/marital_statuses',
], function () {
    Route::get('/', [MaritalStatusesController::class, 'index'])->name('marital_statuses.marital_status.index');
    Route::get('/create',[MaritalStatusesController::class, 'create'])->name('marital_statuses.marital_status.create');
    Route::get('/{maritalStatus}/edit',[MaritalStatusesController::class, 'edit'])->name('marital_statuses.marital_status.edit')->where('id', '[0-9]+');
    Route::post('/', [MaritalStatusesController::class, 'store'])->name('marital_statuses.marital_status.store');
    Route::put('marital_status/{maritalStatus}', [MaritalStatusesController::class, 'update'])->name('marital_statuses.marital_status.update')->where('id', '[0-9]+');
    Route::delete('/marital_status/{maritalStatus}',[MaritalStatusesController::class, 'destroy'])->name('marital_statuses.marital_status.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/nationalities',
], function () {
    Route::get('/', [NationalitiesController::class, 'index'])->name('nationalities.nationality.index');
    Route::get('/create',[NationalitiesController::class, 'create'])->name('nationalities.nationality.create');
    Route::get('/{nationality}/edit',[NationalitiesController::class, 'edit'])->name('nationalities.nationality.edit')->where('id', '[0-9]+');
    Route::post('/', [NationalitiesController::class, 'store'])->name('nationalities.nationality.store');
    Route::put('nationality/{nationality}', [NationalitiesController::class, 'update'])->name('nationalities.nationality.update')->where('id', '[0-9]+');
    Route::delete('/nationality/{nationality}',[NationalitiesController::class, 'destroy'])->name('nationalities.nationality.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/religions',
], function () {
    Route::get('/', [ReligionsController::class, 'index'])->name('religions.religion.index');
    Route::get('/create',[ReligionsController::class, 'create'])->name('religions.religion.create');
    Route::get('/{religion}/edit',[ReligionsController::class, 'edit'])->name('religions.religion.edit')->where('id', '[0-9]+');
    Route::post('/', [ReligionsController::class, 'store'])->name('religions.religion.store');
    Route::put('religion/{religion}', [ReligionsController::class, 'update'])->name('religions.religion.update')->where('id', '[0-9]+');
    Route::delete('/religion/{religion}',[ReligionsController::class, 'destroy'])->name('religions.religion.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/regions',
], function () {
    Route::get('/', [RegionsController::class, 'index'])->name('regions.region.index');
    Route::get('/create',[RegionsController::class, 'create'])->name('regions.region.create');
    Route::get('/{region}/edit',[RegionsController::class, 'edit'])->name('regions.region.edit')->where('id', '[0-9]+');
    Route::post('/', [RegionsController::class, 'store'])->name('regions.region.store');
    Route::put('region/{region}', [RegionsController::class, 'update'])->name('regions.region.update')->where('id', '[0-9]+');
    Route::delete('/region/{region}',[RegionsController::class, 'destroy'])->name('regions.region.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'settings/zones',
 ], function () {
     Route::get('/{region}', [ZonesController::class, 'index'])->name('zones.zone.index');
     Route::get('/create',[ZonesController::class, 'create'])->name('zones.zone.create');
     Route::get('/show/{zone}',[ZonesController::class, 'show'])->name('zones.zone.show')->where('id', '[0-9]+');
     Route::get('/{zone}/edit',[ZonesController::class, 'edit'])->name('zones.zone.edit')->where('id', '[0-9]+');
     Route::post('/', [ZonesController::class, 'store'])->name('zones.zone.store');
     Route::put('zone/{zone}', [ZonesController::class, 'update'])->name('zones.zone.update')->where('id', '[0-9]+');
     Route::delete('/zone/{zone}',[ZonesController::class, 'destroy'])->name('zones.zone.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/woredas',
 ], function () {
     Route::get('/', [WoredasController::class, 'index'])->name('woredas.woreda.index');
     Route::get('/create',[WoredasController::class, 'create'])->name('woredas.woreda.create');
     Route::get('/show/{woreda}',[WoredasController::class, 'show'])->name('woredas.woreda.show')->where('id', '[0-9]+');
     Route::get('/{woreda}/edit',[WoredasController::class, 'edit'])->name('woredas.woreda.edit')->where('id', '[0-9]+');
     Route::post('/', [WoredasController::class, 'store'])->name('woredas.woreda.store');
     Route::put('woreda/{woreda}', [WoredasController::class, 'update'])->name('woredas.woreda.update')->where('id', '[0-9]+');
     Route::delete('/woreda/{woreda}',[WoredasController::class, 'destroy'])->name('woredas.woreda.destroy')->where('id', '[0-9]+');
 });

Route::group([
    'prefix' => 'settings/skill_categories',
], function () {
    Route::get('/', [SkillCategoriesController::class, 'index'])->name('skill_categories.skill_category.index');
    Route::get('/create',[SkillCategoriesController::class, 'create'])->name('skill_categories.skill_category.create');
    Route::get('/{skillCategory}/edit',[SkillCategoriesController::class, 'edit'])->name('skill_categories.skill_category.edit')->where('id', '[0-9]+');
    Route::post('/', [SkillCategoriesController::class, 'store'])->name('skill_categories.skill_category.store');
    Route::put('skill_category/{skillCategory}', [SkillCategoriesController::class, 'update'])->name('skill_categories.skill_category.update')->where('id', '[0-9]+');
    Route::delete('/skill_category/{skillCategory}',[SkillCategoriesController::class, 'destroy'])->name('skill_categories.skill_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/relationships',
], function () {
    Route::get('/', [RelationshipsController::class, 'index'])->name('relationships.relationship.index');
    Route::get('/create',[RelationshipsController::class, 'create'])->name('relationships.relationship.create');
    Route::get('/{relationship}/edit',[RelationshipsController::class, 'edit'])->name('relationships.relationship.edit')->where('id', '[0-9]+');
    Route::post('/', [RelationshipsController::class, 'store'])->name('relationships.relationship.store');
    Route::put('relationship/{relationship}', [RelationshipsController::class, 'update'])->name('relationships.relationship.update')->where('id', '[0-9]+');
    Route::delete('/relationship/{relationship}',[RelationshipsController::class, 'destroy'])->name('relationships.relationship.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/employee_statuses',
], function () {
    Route::get('/', [EmployeeStatusesController::class, 'index'])->name('employee_statuses.employee_status.index');
    Route::get('/create',[EmployeeStatusesController::class, 'create'])->name('employee_statuses.employee_status.create');
    Route::get('/{employeeStatus}/edit',[EmployeeStatusesController::class, 'edit'])->name('employee_statuses.employee_status.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeStatusesController::class, 'store'])->name('employee_statuses.employee_status.store');
    Route::put('employee_status/{employeeStatus}', [EmployeeStatusesController::class, 'update'])->name('employee_statuses.employee_status.update')->where('id', '[0-9]+');
    Route::delete('/employee_status/{employeeStatus}',[EmployeeStatusesController::class, 'destroy'])->name('employee_statuses.employee_status.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/address_types',
], function () {
    Route::get('/', [AddressTypesController::class, 'index'])->name('address_types.address_type.index');
    Route::get('/create',[AddressTypesController::class, 'create'])->name('address_types.address_type.create');
    Route::get('/{addressType}/edit',[AddressTypesController::class, 'edit'])->name('address_types.address_type.edit')->where('id', '[0-9]+');
    Route::post('/', [AddressTypesController::class, 'store'])->name('address_types.address_type.store');
    Route::put('address_type/{addressType}', [AddressTypesController::class, 'update'])->name('address_types.address_type.update')->where('id', '[0-9]+');
    Route::delete('/address_type/{addressType}',[AddressTypesController::class, 'destroy'])->name('address_types.address_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/experience_types',
], function () {
    Route::get('/', [ExperienceTypesController::class, 'index'])->name('experience_types.experience_type.index');
    Route::get('/create',[ExperienceTypesController::class, 'create'])->name('experience_types.experience_type.create');
    Route::get('/{experienceType}/edit',[ExperienceTypesController::class, 'edit'])->name('experience_types.experience_type.edit')->where('id', '[0-9]+');
    Route::post('/', [ExperienceTypesController::class, 'store'])->name('experience_types.experience_type.store');
    Route::put('experience_type/{experienceType}', [ExperienceTypesController::class, 'update'])->name('experience_types.experience_type.update')->where('id', '[0-9]+');
    Route::delete('/experience_type/{experienceType}',[ExperienceTypesController::class, 'destroy'])->name('experience_types.experience_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/license_types',
], function () {
    Route::get('/', [LicenseTypesController::class, 'index'])->name('license_types.license_type.index');
    Route::get('/create',[LicenseTypesController::class, 'create'])->name('license_types.license_type.create');
    Route::get('/{licenseType}/edit',[LicenseTypesController::class, 'edit'])->name('license_types.license_type.edit')->where('id', '[0-9]+');
    Route::post('/', [LicenseTypesController::class, 'store'])->name('license_types.license_type.store');
    Route::put('license_type/{licenseType}', [LicenseTypesController::class, 'update'])->name('license_types.license_type.update')->where('id', '[0-9]+');
    Route::delete('/license_type/{licenseType}',[LicenseTypesController::class, 'destroy'])->name('license_types.license_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/education_levels',
], function () {
    Route::get('/', [EducationLevelsController::class, 'index'])->name('education_levels.education_level.index');
    Route::get('/create',[EducationLevelsController::class, 'create'])->name('education_levels.education_level.create');
    Route::get('/{educationLevel}/edit',[EducationLevelsController::class, 'edit'])->name('education_levels.education_level.edit')->where('id', '[0-9]+');
    Route::post('/', [EducationLevelsController::class, 'store'])->name('education_levels.education_level.store');
    Route::put('education_level/{educationLevel}', [EducationLevelsController::class, 'update'])->name('education_levels.education_level.update')->where('id', '[0-9]+');
    Route::delete('/education_level/{educationLevel}',[EducationLevelsController::class, 'destroy'])->name('education_levels.education_level.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/educational_institutes',
], function () {
    Route::get('/', [EducationalInstitutesController::class, 'index'])->name('educational_institutes.educational_institute.index');
    Route::get('/create',[EducationalInstitutesController::class, 'create'])->name('educational_institutes.educational_institute.create');
    Route::get('/{educationalInstitute}/edit',[EducationalInstitutesController::class, 'edit'])->name('educational_institutes.educational_institute.edit')->where('id', '[0-9]+');
    Route::post('/', [EducationalInstitutesController::class, 'store'])->name('educational_institutes.educational_institute.store');
    Route::put('educational_institute/{educationalInstitute}', [EducationalInstitutesController::class, 'update'])->name('educational_institutes.educational_institute.update')->where('id', '[0-9]+');
    Route::delete('/educational_institute/{educationalInstitute}',[EducationalInstitutesController::class, 'destroy'])->name('educational_institutes.educational_institute.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/educational_fields',
], function () {
    Route::get('/', [EducationalFieldsController::class, 'index'])->name('educational_fields.educational_field.index');
    Route::get('/create',[EducationalFieldsController::class, 'create'])->name('educational_fields.educational_field.create');
    Route::get('/{educationalField}/edit',[EducationalFieldsController::class, 'edit'])->name('educational_fields.educational_field.edit')->where('id', '[0-9]+');
    Route::post('/', [EducationalFieldsController::class, 'store'])->name('educational_fields.educational_field.store');
    Route::put('educational_field/{educationalField}', [EducationalFieldsController::class, 'update'])->name('educational_fields.educational_field.update')->where('id', '[0-9]+');
    Route::delete('/educational_field/{educationalField}',[EducationalFieldsController::class, 'destroy'])->name('educational_fields.educational_field.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/disaster_causes',
], function () {
    Route::get('/', [DisasterCausesController::class, 'index'])->name('disaster_causes.disaster_cause.index');
    Route::get('/create',[DisasterCausesController::class, 'create'])->name('disaster_causes.disaster_cause.create');
    Route::get('/{disasterCause}/edit',[DisasterCausesController::class, 'edit'])->name('disaster_causes.disaster_cause.edit')->where('id', '[0-9]+');
    Route::post('/', [DisasterCausesController::class, 'store'])->name('disaster_causes.disaster_cause.store');
    Route::put('disaster_cause/{disasterCause}', [DisasterCausesController::class, 'update'])->name('disaster_causes.disaster_cause.update')->where('id', '[0-9]+');
    Route::delete('/disaster_cause/{disasterCause}',[DisasterCausesController::class, 'destroy'])->name('disaster_causes.disaster_cause.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'settings/sexes',
 ], function () {
     Route::get('/', [SexesController::class, 'index'])->name('sexes.sex.index');
     Route::get('/create',[SexesController::class, 'create'])->name('sexes.sex.create');
     Route::get('/{sex}/edit',[SexesController::class, 'edit'])->name('sexes.sex.edit')->where('id', '[0-9]+');
     Route::post('/', [SexesController::class, 'store'])->name('sexes.sex.store');
     Route::put('sex/{sex}', [SexesController::class, 'update'])->name('sexes.sex.update')->where('id', '[0-9]+');
     Route::delete('/sex/{sex}',[SexesController::class, 'destroy'])->name('sexes.sex.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/template_types',
 ], function () {
     Route::get('/', [TemplateTypesController::class, 'index'])->name('template_types.template_type.index');
     Route::get('/create',[TemplateTypesController::class, 'create'])->name('template_types.template_type.create');
     Route::get('/{templateType}/edit',[TemplateTypesController::class, 'edit'])->name('template_types.template_type.edit')->where('id', '[0-9]+');
     Route::post('/', [TemplateTypesController::class, 'store'])->name('template_types.template_type.store');
     Route::put('template_type/{templateType}', [TemplateTypesController::class, 'update'])->name('template_types.template_type.update')->where('id', '[0-9]+');
     Route::delete('/template_type/{templateType}',[TemplateTypesController::class, 'destroy'])->name('template_types.template_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/templates',
 ], function () {
     Route::get('/', [TemplatesController::class, 'index'])->name('templates.template.index');
     Route::get('/create',[TemplatesController::class, 'create'])->name('templates.template.create');
     Route::get('/show/{template}',[TemplatesController::class, 'show'])->name('templates.template.show')->where('id', '[0-9]+');
     Route::get('/{template}/edit',[TemplatesController::class, 'edit'])->name('templates.template.edit')->where('id', '[0-9]+');
     Route::post('/', [TemplatesController::class, 'store'])->name('templates.template.store');
     Route::put('template/{template}', [TemplatesController::class, 'update'])->name('templates.template.update')->where('id', '[0-9]+');
     Route::delete('/template/{template}',[TemplatesController::class, 'destroy'])->name('templates.template.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/titles',
 ], function () {
     Route::get('/', [TitlesController::class, 'index'])->name('titles.title.index');
     Route::get('/create',[TitlesController::class, 'create'])->name('titles.title.create');
     Route::get('/{title}/edit',[TitlesController::class, 'edit'])->name('titles.title.edit')->where('id', '[0-9]+');
     Route::post('/', [TitlesController::class, 'store'])->name('titles.title.store');
     Route::put('title/{title}', [TitlesController::class, 'update'])->name('titles.title.update')->where('id', '[0-9]+');
     Route::delete('/title/{title}',[TitlesController::class, 'destroy'])->name('titles.title.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/banks',
 ], function () {
     Route::get('/', [BanksController::class, 'index'])->name('banks.bank.index');
     Route::get('/create',[BanksController::class, 'create'])->name('banks.bank.create');
     Route::get('/{bank}/edit',[BanksController::class, 'edit'])->name('banks.bank.edit')->where('id', '[0-9]+');
     Route::post('/', [BanksController::class, 'store'])->name('banks.bank.store');
     Route::put('bank/{bank}', [BanksController::class, 'update'])->name('banks.bank.update')->where('id', '[0-9]+');
     Route::delete('/bank/{bank}',[BanksController::class, 'destroy'])->name('banks.bank.destroy')->where('id', '[0-9]+');
 }); 


Route::group([
     'prefix' => 'settings/bank_account_types',
 ], function () {
     Route::get('/', [BankAccountTypesController::class, 'index'])->name('bank_account_types.bank_account_type.index');
     Route::get('/create',[BankAccountTypesController::class, 'create'])->name('bank_account_types.bank_account_type.create');
     Route::get('/{bankAccountType}/edit',[BankAccountTypesController::class, 'edit'])->name('bank_account_types.bank_account_type.edit')->where('id', '[0-9]+');
     Route::post('/', [BankAccountTypesController::class, 'store'])->name('bank_account_types.bank_account_type.store');
     Route::put('bank_account_type/{bankAccountType}', [BankAccountTypesController::class, 'update'])->name('bank_account_types.bank_account_type.update')->where('id', '[0-9]+');
     Route::delete('/bank_account_type/{bankAccountType}',[BankAccountTypesController::class, 'destroy'])->name('bank_account_types.bank_account_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/disability_types',
 ], function () {
     Route::get('/', [DisabilityTypesController::class, 'index'])->name('disability_types.disability_type.index');
     Route::get('/create',[DisabilityTypesController::class, 'create'])->name('disability_types.disability_type.create');
     Route::get('/{disabilityType}/edit',[DisabilityTypesController::class, 'edit'])->name('disability_types.disability_type.edit')->where('id', '[0-9]+');
     Route::post('/', [DisabilityTypesController::class, 'store'])->name('disability_types.disability_type.store');
     Route::put('disability_type/{disabilityType}', [DisabilityTypesController::class, 'update'])->name('disability_types.disability_type.update')->where('id', '[0-9]+');
     Route::delete('/disability_type/{disabilityType}',[DisabilityTypesController::class, 'destroy'])->name('disability_types.disability_type.destroy')->where('id', '[0-9]+');
 });

Route::group([
     'prefix' => 'settings/gpa_scales',
 ], function () {
     Route::get('/', [GPAScalesController::class, 'index'])->name('gpa_scales.gpa_scale.index');
     Route::get('/create',[GPAScalesController::class, 'create'])->name('gpa_scales.gpa_scale.create');
     Route::get('/{gPAScale}/edit',[GPAScalesController::class, 'edit'])->name('gpa_scales.gpa_scale.edit')->where('id', '[0-9]+');
     Route::post('/', [GPAScalesController::class, 'store'])->name('gpa_scales.gpa_scale.store');
     Route::put('gpa_scale/{gPAScale}', [GPAScalesController::class, 'update'])->name('gpa_scales.gpa_scale.update')->where('id', '[0-9]+');
     Route::delete('/gpa_scale/{gPAScale}',[GPAScalesController::class, 'destroy'])->name('gpa_scales.gpa_scale.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/award_types',
 ], function () {
     Route::get('/', [AwardTypesController::class, 'index'])->name('award_types.award_type.index');
     Route::get('/create',[AwardTypesController::class, 'create'])->name('award_types.award_type.create');
     Route::get('/{awardType}/edit',[AwardTypesController::class, 'edit'])->name('award_types.award_type.edit')->where('id', '[0-9]+');
     Route::post('/', [AwardTypesController::class, 'store'])->name('award_types.award_type.store');
     Route::put('award_type/{awardType}', [AwardTypesController::class, 'update'])->name('award_types.award_type.update')->where('id', '[0-9]+');
     Route::delete('/award_type/{awardType}',[AwardTypesController::class, 'destroy'])->name('award_types.award_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/commitment_fors',
 ], function () {
     Route::get('/', [CommitmentForsController::class, 'index'])->name('commitment_fors.commitment_for.index');
     Route::get('/create',[CommitmentForsController::class, 'create'])->name('commitment_fors.commitment_for.create');
     Route::get('/{commitmentFor}/edit',[CommitmentForsController::class, 'edit'])->name('commitment_fors.commitment_for.edit')->where('id', '[0-9]+');
     Route::post('/', [CommitmentForsController::class, 'store'])->name('commitment_fors.commitment_for.store');
     Route::put('commitment_for/{commitmentFor}', [CommitmentForsController::class, 'update'])->name('commitment_fors.commitment_for.update')->where('id', '[0-9]+');
     Route::delete('/commitment_for/{commitmentFor}',[CommitmentForsController::class, 'destroy'])->name('commitment_fors.commitment_for.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/left_reasons',
 ], function () {
     Route::get('/', [LeftReasonsController::class, 'index'])->name('left_reasons.left_reason.index');
     Route::get('/create',[LeftReasonsController::class, 'create'])->name('left_reasons.left_reason.create');
     Route::get('/{leftReason}/edit',[LeftReasonsController::class, 'edit'])->name('left_reasons.left_reason.edit')->where('id', '[0-9]+');
     Route::post('/', [LeftReasonsController::class, 'store'])->name('left_reasons.left_reason.store');
     Route::put('left_reason/{leftReason}', [LeftReasonsController::class, 'update'])->name('left_reasons.left_reason.update')->where('id', '[0-9]+');
     Route::delete('/left_reason/{leftReason}',[LeftReasonsController::class, 'destroy'])->name('left_reasons.left_reason.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/disaster_severities',
 ], function () {
     Route::get('/', [DisasterSeveritiesController::class, 'index'])->name('disaster_severities.disaster_severity.index');
     Route::get('/create',[DisasterSeveritiesController::class, 'create'])->name('disaster_severities.disaster_severity.create');
     Route::get('/{disasterSeverity}/edit',[DisasterSeveritiesController::class, 'edit'])->name('disaster_severities.disaster_severity.edit')->where('id', '[0-9]+');
     Route::post('/', [DisasterSeveritiesController::class, 'store'])->name('disaster_severities.disaster_severity.store');
     Route::put('disaster_severity/{disasterSeverity}', [DisasterSeveritiesController::class, 'update'])->name('disaster_severities.disaster_severity.update')->where('id', '[0-9]+');
     Route::delete('/disaster_severity/{disasterSeverity}',[DisasterSeveritiesController::class, 'destroy'])->name('disaster_severities.disaster_severity.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/certification_vendors',
 ], function () {
     Route::get('/', [CertificationVendorsController::class, 'index'])->name('certification_vendors.certification_vendor.index');
     Route::get('/create',[CertificationVendorsController::class, 'create'])->name('certification_vendors.certification_vendor.create');
     Route::get('/{certificationVendor}/edit',[CertificationVendorsController::class, 'edit'])->name('certification_vendors.certification_vendor.edit')->where('id', '[0-9]+');
     Route::post('/', [CertificationVendorsController::class, 'store'])->name('certification_vendors.certification_vendor.store');
     Route::put('certification_vendor/{certificationVendor}', [CertificationVendorsController::class, 'update'])->name('certification_vendors.certification_vendor.update')->where('id', '[0-9]+');
     Route::delete('/certification_vendor/{certificationVendor}',[CertificationVendorsController::class, 'destroy'])->name('certification_vendors.certification_vendor.destroy')->where('id', '[0-9]+');
 });
 
Route::group([
    'prefix' => 'organization_units',
], function () {
    Route::get('/', [OrganizationUnitsController::class, 'index'])->name('organization_units.organization_unit.index');
    Route::get('/create',[OrganizationUnitsController::class, 'create'])->name('organization_units.organization_unit.create');
    Route::get('/show/{organizationUnit}',[OrganizationUnitsController::class, 'show'])->name('organization_units.organization_unit.show')->where('id', '[0-9]+');
    Route::get('/{organizationUnit}/edit',[OrganizationUnitsController::class, 'edit'])->name('organization_units.organization_unit.edit')->where('id', '[0-9]+');
    Route::post('/', [OrganizationUnitsController::class, 'store'])->name('organization_units.organization_unit.store');
    Route::post('/filter', [OrganizationUnitsController::class, 'filter'])->name('organization_units.organization_unit.filter');
    Route::put('organization_unit/{organizationUnit}', [OrganizationUnitsController::class, 'update'])->name('organization_units.organization_unit.update')->where('id', '[0-9]+');
    Route::delete('/organization_unit/{organizationUnit}',[OrganizationUnitsController::class, 'destroy'])->name('organization_units.organization_unit.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'help',
], function () {
    Route::get('/', [HelpsController::class, 'index'])->name('helps.help.index');
    Route::get('/create',[HelpsController::class, 'create'])->name('helps.help.create');
    Route::get('/show/{help}',[HelpsController::class, 'show'])->name('helps.help.show')->where('id', '[0-9]+');
    Route::get('/{help}/edit',[HelpsController::class, 'edit'])->name('helps.help.edit')->where('id', '[0-9]+');
    Route::post('/', [HelpsController::class, 'store'])->name('helps.help.store');
    Route::post('/filter', [HelpsController::class, 'filter'])->name('helps.help.filter');
    Route::put('help/{help}', [HelpsController::class, 'update'])->name('helps.help.update')->where('id', '[0-9]+');
    Route::delete('/help/{help}',[HelpsController::class, 'destroy'])->name('helps.help.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salary_scales',
], function () {
    Route::get('/', [SalaryScalesController::class, 'index'])->name('salary_scales.salary_scale.index');
    Route::get('/create',[SalaryScalesController::class, 'create'])->name('salary_scales.salary_scale.create');
    Route::get('/show/{salaryScale}',[SalaryScalesController::class, 'show'])->name('salary_scales.salary_scale.show')->where('id', '[0-9]+');
    Route::get('/{salaryScale}/edit',[SalaryScalesController::class, 'edit'])->name('salary_scales.salary_scale.edit')->where('id', '[0-9]+');
    Route::post('/', [SalaryScalesController::class, 'store'])->name('salary_scales.salary_scale.store');
    Route::put('salary_scale/{salaryScale}', [SalaryScalesController::class, 'update'])->name('salary_scales.salary_scale.update')->where('id', '[0-9]+');
    Route::delete('/salary_scale/{salaryScale}',[SalaryScalesController::class, 'destroy'])->name('salary_scales.salary_scale.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salary_steps',
], function () {
    Route::get('/', [SalaryStepsController::class, 'index'])->name('salary_steps.salary_step.index');
    Route::get('/create',[SalaryStepsController::class, 'create'])->name('salary_steps.salary_step.create');
    Route::get('/show/{salaryStep}',[SalaryStepsController::class, 'show'])->name('salary_steps.salary_step.show')->where('id', '[0-9]+');
    Route::get('/{salaryStep}/edit',[SalaryStepsController::class, 'edit'])->name('salary_steps.salary_step.edit')->where('id', '[0-9]+');
    Route::post('/', [SalaryStepsController::class, 'store'])->name('salary_steps.salary_step.store');
    Route::put('salary_step/{salaryStep}', [SalaryStepsController::class, 'update'])->name('salary_steps.salary_step.update')->where('id', '[0-9]+');
    Route::delete('/salary_step/{salaryStep}',[SalaryStepsController::class, 'destroy'])->name('salary_steps.salary_step.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salary_heights',
], function () {
    Route::get('/', [SalaryHeightsController::class, 'index'])->name('salary_heights.salary_height.index');
    Route::get('/create',[SalaryHeightsController::class, 'create'])->name('salary_heights.salary_height.create');
    Route::get('/show/{salaryHeight}',[SalaryHeightsController::class, 'show'])->name('salary_heights.salary_height.show')->where('id', '[0-9]+');
    Route::get('/{salaryHeight}/edit',[SalaryHeightsController::class, 'edit'])->name('salary_heights.salary_height.edit')->where('id', '[0-9]+');
    Route::post('/', [SalaryHeightsController::class, 'store'])->name('salary_heights.salary_height.store');
    Route::put('salary_height/{salaryHeight}', [SalaryHeightsController::class, 'update'])->name('salary_heights.salary_height.update')->where('id', '[0-9]+');
    Route::delete('/salary_height/{salaryHeight}',[SalaryHeightsController::class, 'destroy'])->name('salary_heights.salary_height.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salaries',
], function () {
    Route::get('/', [SalariesController::class, 'index'])->name('salaries.salary.index');
    Route::get('/create',[SalariesController::class, 'create'])->name('salaries.salary.create');
    Route::get('/show/{salary}',[SalariesController::class, 'show'])->name('salaries.salary.show')->where('id', '[0-9]+');
    Route::get('/{salary}/edit',[SalariesController::class, 'edit'])->name('salaries.salary.edit')->where('id', '[0-9]+');
    Route::post('/', [SalariesController::class, 'store'])->name('salaries.salary.store');
    Route::put('salary/{salary}', [SalariesController::class, 'update'])->name('salaries.salary.update')->where('id', '[0-9]+');
    Route::delete('/salary/{salary}',[SalariesController::class, 'destroy'])->name('salaries.salary.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'job_positions',
], function () {
    Route::get('/', [JobPositionsController::class, 'index'])->name('job_positions.job_position.index');
    Route::get('/benefits',[JobPositionsController::class, 'benefits'])->name('job_positions.job_position.benefits');
    Route::get('/create',[JobPositionsController::class, 'create'])->name('job_positions.job_position.create');
    Route::get('/show/{jobPosition}',[JobPositionsController::class, 'show'])->name('job_positions.job_position.show')->where('id', '[0-9]+');
    Route::get('/{jobPosition}/edit',[JobPositionsController::class, 'edit'])->name('job_positions.job_position.edit')->where('id', '[0-9]+');
    Route::post('/', [JobPositionsController::class, 'store'])->name('job_positions.job_position.store');
    Route::put('job_position/{jobPosition}', [JobPositionsController::class, 'update'])->name('job_positions.job_position.update')->where('id', '[0-9]+');
    Route::delete('/job_position/{jobPosition}',[JobPositionsController::class, 'destroy'])->name('job_positions.job_position.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employees',
], function () {
    Route::get('/', [EmployeesController::class, 'index'])->name('employees.employee.index');
    Route::get('/filter',[EmployeesController::class, 'filter'])->name('employees.employee.filter');
    Route::get('/{employee}/success',[EmployeesController::class, 'success'])->name('employees.employee.success');
    Route::get('/create',[EmployeesController::class, 'create'])->name('employees.employee.create');
    Route::get('/show/{employee}',[EmployeesController::class, 'show'])->name('employees.employee.show')->where('id', '[0-9]+');
    Route::get('/{employee}/edit',[EmployeesController::class, 'edit'])->name('employees.employee.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeesController::class, 'store'])->name('employees.employee.store');
    Route::put('employee/{employee}', [EmployeesController::class, 'update'])->name('employees.employee.update')->where('id', '[0-9]+');
    Route::delete('/employee/{employee}',[EmployeesController::class, 'destroy'])->name('employees.employee.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_addresses',
], function () {
    Route::get('/', [EmployeeAddressesController::class, 'index'])->name('employee_addresses.employee_address.index');
    Route::get('/create',[EmployeeAddressesController::class, 'create'])->name('employee_addresses.employee_address.create');
    Route::get('/approve/{employeeAddress}',[EmployeeAddressesController::class, 'approve'])->name('employee_addresses.employee_address.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeAddress}',[EmployeeAddressesController::class, 'reject'])->name('employee_addresses.employee_address.reject')->where('id', '[0-9]+');
    Route::get('/{employeeAddress}/edit',[EmployeeAddressesController::class, 'edit'])->name('employee_addresses.employee_address.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeAddressesController::class, 'store'])->name('employee_addresses.employee_address.store');
    Route::put('employee_address/{employeeAddress}', [EmployeeAddressesController::class, 'update'])->name('employee_addresses.employee_address.update')->where('id', '[0-9]+');
    Route::delete('/employee_address/{employeeAddress}',[EmployeeAddressesController::class, 'destroy'])->name('employee_addresses.employee_address.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_bank_accounts',
], function () {
    Route::get('/', [EmployeeBankAccountsController::class, 'index'])->name('employee_bank_accounts.employee_bank_account.index');
    Route::get('/create',[EmployeeBankAccountsController::class, 'create'])->name('employee_bank_accounts.employee_bank_account.create');
    Route::get('/approve/{employeeBankAccount}',[EmployeeBankAccountsController::class, 'approve'])->name('employee_bank_accounts.employee_bank_account.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeBankAccount}',[EmployeeBankAccountsController::class, 'reject'])->name('employee_bank_accounts.employee_bank_account.reject')->where('id', '[0-9]+');
    Route::get('/{employeeBankAccount}/edit',[EmployeeBankAccountsController::class, 'edit'])->name('employee_bank_accounts.employee_bank_account.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeBankAccountsController::class, 'store'])->name('employee_bank_accounts.employee_bank_account.store');
    Route::put('employee_bank_account/{employeeBankAccount}', [EmployeeBankAccountsController::class, 'update'])->name('employee_bank_accounts.employee_bank_account.update')->where('id', '[0-9]+');
    Route::delete('/employee_bank_account/{employeeBankAccount}',[EmployeeBankAccountsController::class, 'destroy'])->name('employee_bank_accounts.employee_bank_account.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_disabilities',
], function () {
    Route::get('/', [EmployeeDisabilitiesController::class, 'index'])->name('employee_disabilities.employee_disability.index');
    Route::get('/create',[EmployeeDisabilitiesController::class, 'create'])->name('employee_disabilities.employee_disability.create');
    Route::get('/approve/{employeeDisability}',[EmployeeDisabilitiesController::class, 'approve'])->name('employee_disabilities.employee_disability.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeDisability}',[EmployeeDisabilitiesController::class, 'reject'])->name('employee_disabilities.employee_disability.reject')->where('id', '[0-9]+');
    Route::get('/{employeeDisability}/edit',[EmployeeDisabilitiesController::class, 'edit'])->name('employee_disabilities.employee_disability.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeDisabilitiesController::class, 'store'])->name('employee_disabilities.employee_disability.store');
    Route::put('employee_disability/{employeeDisability}', [EmployeeDisabilitiesController::class, 'update'])->name('employee_disabilities.employee_disability.update')->where('id', '[0-9]+');
    Route::delete('/employee_disability/{employeeDisability}',[EmployeeDisabilitiesController::class, 'destroy'])->name('employee_disabilities.employee_disability.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_educations',
], function () {
    Route::get('/', [EmployeeEducationsController::class, 'index'])->name('employee_educations.employee_education.index');
    Route::get('/create',[EmployeeEducationsController::class, 'create'])->name('employee_educations.employee_education.create');
    Route::get('/approve/{employeeEducation}',[EmployeeEducationsController::class, 'approve'])->name('employee_educations.employee_education.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeEducation}',[EmployeeEducationsController::class, 'reject'])->name('employee_educations.employee_education.reject')->where('id', '[0-9]+');
    Route::get('/{employeeEducation}/edit',[EmployeeEducationsController::class, 'edit'])->name('employee_educations.employee_education.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeEducationsController::class, 'store'])->name('employee_educations.employee_education.store');
    Route::put('employee_education/{employeeEducation}', [EmployeeEducationsController::class, 'update'])->name('employee_educations.employee_education.update')->where('id', '[0-9]+');
    Route::delete('/employee_education/{employeeEducation}',[EmployeeEducationsController::class, 'destroy'])->name('employee_educations.employee_education.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_emergencies',
], function () {
    Route::get('/', [EmployeeEmergenciesController::class, 'index'])->name('employee_emergencies.employee_emergency.index');
    Route::get('/create',[EmployeeEmergenciesController::class, 'create'])->name('employee_emergencies.employee_emergency.create');
    Route::get('/approve/{employeeEmergency}',[EmployeeEmergenciesController::class, 'approve'])->name('employee_emergencies.employee_emergency.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeEmergency}',[EmployeeEmergenciesController::class, 'reject'])->name('employee_emergencies.employee_emergency.reject')->where('id', '[0-9]+');
    Route::get('/{employeeEmergency}/edit',[EmployeeEmergenciesController::class, 'edit'])->name('employee_emergencies.employee_emergency.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeEmergenciesController::class, 'store'])->name('employee_emergencies.employee_emergency.store');
    Route::put('employee_emergency/{employeeEmergency}', [EmployeeEmergenciesController::class, 'update'])->name('employee_emergencies.employee_emergency.update')->where('id', '[0-9]+');
    Route::delete('/employee_emergency/{employeeEmergency}',[EmployeeEmergenciesController::class, 'destroy'])->name('employee_emergencies.employee_emergency.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_families',
], function () {
    Route::get('/', [EmployeeFamiliesController::class, 'index'])->name('employee_families.employee_family.index');
    Route::get('/create',[EmployeeFamiliesController::class, 'create'])->name('employee_families.employee_family.create');
    Route::get('/approve/{employeeFamily}',[EmployeeFamiliesController::class, 'approve'])->name('employee_families.employee_family.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeFamily}',[EmployeeFamiliesController::class, 'reject'])->name('employee_families.employee_family.reject')->where('id', '[0-9]+');
    Route::get('/{employeeFamily}/edit',[EmployeeFamiliesController::class, 'edit'])->name('employee_families.employee_family.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeFamiliesController::class, 'store'])->name('employee_families.employee_family.store');
    Route::put('employee_family/{employeeFamily}', [EmployeeFamiliesController::class, 'update'])->name('employee_families.employee_family.update')->where('id', '[0-9]+');
    Route::delete('/employee_family/{employeeFamily}',[EmployeeFamiliesController::class, 'destroy'])->name('employee_families.employee_family.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_languages',
], function () {
    Route::get('/', [EmployeeLanguagesController::class, 'index'])->name('employee_languages.employee_language.index');
    Route::get('/create',[EmployeeLanguagesController::class, 'create'])->name('employee_languages.employee_language.create');
    Route::get('/show/{employeeLanguage}',[EmployeeLanguagesController::class, 'show'])->name('employee_languages.employee_language.show')->where('id', '[0-9]+');
    Route::get('/{employeeLanguage}/edit',[EmployeeLanguagesController::class, 'edit'])->name('employee_languages.employee_language.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeLanguagesController::class, 'store'])->name('employee_languages.employee_language.store');
    Route::put('employee_language/{employeeLanguage}', [EmployeeLanguagesController::class, 'update'])->name('employee_languages.employee_language.update')->where('id', '[0-9]+');
    Route::delete('/employee_language/{employeeLanguage}',[EmployeeLanguagesController::class, 'destroy'])->name('employee_languages.employee_language.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_licenses',
], function () {
    Route::get('/', [EmployeeLicensesController::class, 'index'])->name('employee_licenses.employee_license.index');
    Route::get('/create',[EmployeeLicensesController::class, 'create'])->name('employee_licenses.employee_license.create');
    Route::get('/approve/{employeeLicense}',[EmployeeLicensesController::class, 'approve'])->name('employee_licenses.employee_license.approve')->where('id', '[0-9]+');
    Route::post('/reject/{employeeLicense}',[EmployeeLicensesController::class, 'reject'])->name('employee_licenses.employee_license.reject')->where('id', '[0-9]+');
    Route::get('/{employeeLicense}/edit',[EmployeeLicensesController::class, 'edit'])->name('employee_licenses.employee_license.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeLicensesController::class, 'store'])->name('employee_licenses.employee_license.store');
    Route::put('employee_license/{employeeLicense}', [EmployeeLicensesController::class, 'update'])->name('employee_licenses.employee_license.update')->where('id', '[0-9]+');
    Route::delete('/employee_license/{employeeLicense}',[EmployeeLicensesController::class, 'destroy'])->name('employee_licenses.employee_license.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_experiences',
], function () {
    Route::get('/', [EmployeeExperiencesController::class, 'index'])->name('employee_experiences.employee_experience.index');
    Route::get('/create',[EmployeeExperiencesController::class, 'create'])->name('employee_experiences.employee_experience.create');
    Route::get('/show/{employeeExperience}',[EmployeeExperiencesController::class, 'show'])->name('employee_experiences.employee_experience.show')->where('id', '[0-9]+');
    Route::get('/{employeeExperience}/edit',[EmployeeExperiencesController::class, 'edit'])->name('employee_experiences.employee_experience.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeExperiencesController::class, 'store'])->name('employee_experiences.employee_experience.store');
    Route::put('employee_experience/{employeeExperience}', [EmployeeExperiencesController::class, 'update'])->name('employee_experiences.employee_experience.update')->where('id', '[0-9]+');
    Route::delete('/employee_experience/{employeeExperience}',[EmployeeExperiencesController::class, 'destroy'])->name('employee_experiences.employee_experience.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_disasters',
], function () {
    Route::get('/', [EmployeeDisastersController::class, 'index'])->name('employee_disasters.employee_disaster.index');
    Route::get('/create',[EmployeeDisastersController::class, 'create'])->name('employee_disasters.employee_disaster.create');
    Route::get('/show/{employeeDisaster}',[EmployeeDisastersController::class, 'show'])->name('employee_disasters.employee_disaster.show')->where('id', '[0-9]+');
    Route::get('/{employeeDisaster}/edit',[EmployeeDisastersController::class, 'edit'])->name('employee_disasters.employee_disaster.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeDisastersController::class, 'store'])->name('employee_disasters.employee_disaster.store');
    Route::put('employee_disaster/{employeeDisaster}', [EmployeeDisastersController::class, 'update'])->name('employee_disasters.employee_disaster.update')->where('id', '[0-9]+');
    Route::delete('/employee_disaster/{employeeDisaster}',[EmployeeDisastersController::class, 'destroy'])->name('employee_disasters.employee_disaster.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_disaster_indeminities',
], function () {
    Route::get('/', [EmployeeDisasterIndeminitiesController::class, 'index'])->name('employee_disaster_indeminities.employee_disaster_indeminity.index');
    Route::get('/create',[EmployeeDisasterIndeminitiesController::class, 'create'])->name('employee_disaster_indeminities.employee_disaster_indeminity.create');
    Route::get('/show/{employeeDisasterIndeminity}',[EmployeeDisasterIndeminitiesController::class, 'show'])->name('employee_disaster_indeminities.employee_disaster_indeminity.show')->where('id', '[0-9]+');
    Route::get('/{employeeDisasterIndeminity}/edit',[EmployeeDisasterIndeminitiesController::class, 'edit'])->name('employee_disaster_indeminities.employee_disaster_indeminity.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeDisasterIndeminitiesController::class, 'store'])->name('employee_disaster_indeminities.employee_disaster_indeminity.store');
    Route::put('employee_disaster_indeminity/{employeeDisasterIndeminity}', [EmployeeDisasterIndeminitiesController::class, 'update'])->name('employee_disaster_indeminities.employee_disaster_indeminity.update')->where('id', '[0-9]+');
    Route::delete('/employee_disaster_indeminity/{employeeDisasterIndeminity}',[EmployeeDisasterIndeminitiesController::class, 'destroy'])->name('employee_disaster_indeminities.employee_disaster_indeminity.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_disaster_witnesses',
], function () {
    Route::get('/', [EmployeeDisasterWitnessesController::class, 'index'])->name('employee_disaster_witnesses.employee_disaster_witness.index');
    Route::get('/create',[EmployeeDisasterWitnessesController::class, 'create'])->name('employee_disaster_witnesses.employee_disaster_witness.create');
    Route::get('/show/{employeeDisasterWitness}',[EmployeeDisasterWitnessesController::class, 'show'])->name('employee_disaster_witnesses.employee_disaster_witness.show')->where('id', '[0-9]+');
    Route::get('/{employeeDisasterWitness}/edit',[EmployeeDisasterWitnessesController::class, 'edit'])->name('employee_disaster_witnesses.employee_disaster_witness.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeDisasterWitnessesController::class, 'store'])->name('employee_disaster_witnesses.employee_disaster_witness.store');
    Route::put('employee_disaster_witness/{employeeDisasterWitness}', [EmployeeDisasterWitnessesController::class, 'update'])->name('employee_disaster_witnesses.employee_disaster_witness.update')->where('id', '[0-9]+');
    Route::delete('/employee_disaster_witness/{employeeDisasterWitness}',[EmployeeDisasterWitnessesController::class, 'destroy'])->name('employee_disaster_witnesses.employee_disaster_witness.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_certifications',
], function () {
    Route::get('/', [EmployeeCertificationsController::class, 'index'])->name('employee_certifications.employee_certification.index');
    Route::get('/create',[EmployeeCertificationsController::class, 'create'])->name('employee_certifications.employee_certification.create');
    Route::get('/show/{employeeCertification}',[EmployeeCertificationsController::class, 'show'])->name('employee_certifications.employee_certification.show')->where('id', '[0-9]+');
    Route::get('/{employeeCertification}/edit',[EmployeeCertificationsController::class, 'edit'])->name('employee_certifications.employee_certification.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeCertificationsController::class, 'store'])->name('employee_certifications.employee_certification.store');
    Route::put('employee_certification/{employeeCertification}', [EmployeeCertificationsController::class, 'update'])->name('employee_certifications.employee_certification.update')->where('id', '[0-9]+');
    Route::delete('/employee_certification/{employeeCertification}',[EmployeeCertificationsController::class, 'destroy'])->name('employee_certifications.employee_certification.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_awards',
], function () {
    Route::get('/', [EmployeeAwardsController::class, 'index'])->name('employee_awards.employee_award.index');
    Route::get('/create',[EmployeeAwardsController::class, 'create'])->name('employee_awards.employee_award.create');
    Route::get('/show/{employeeAward}',[EmployeeAwardsController::class, 'show'])->name('employee_awards.employee_award.show')->where('id', '[0-9]+');
    Route::get('/{employeeAward}/edit',[EmployeeAwardsController::class, 'edit'])->name('employee_awards.employee_award.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeAwardsController::class, 'store'])->name('employee_awards.employee_award.store');
    Route::put('employee_award/{employeeAward}', [EmployeeAwardsController::class, 'update'])->name('employee_awards.employee_award.update')->where('id', '[0-9]+');
    Route::delete('/employee_award/{employeeAward}',[EmployeeAwardsController::class, 'destroy'])->name('employee_awards.employee_award.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_study_trainings',
], function () {
    Route::get('/', [EmployeeStudyTrainingsController::class, 'index'])->name('employee_study_trainings.employee_study_training.index');
    Route::get('/create',[EmployeeStudyTrainingsController::class, 'create'])->name('employee_study_trainings.employee_study_training.create');
    Route::get('/show/{employeeStudyTraining}',[EmployeeStudyTrainingsController::class, 'show'])->name('employee_study_trainings.employee_study_training.show')->where('id', '[0-9]+');
    Route::get('/{employeeStudyTraining}/edit',[EmployeeStudyTrainingsController::class, 'edit'])->name('employee_study_trainings.employee_study_training.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeStudyTrainingsController::class, 'store'])->name('employee_study_trainings.employee_study_training.store');
    Route::put('employee_study_training/{employeeStudyTraining}', [EmployeeStudyTrainingsController::class, 'update'])->name('employee_study_trainings.employee_study_training.update')->where('id', '[0-9]+');
    Route::delete('/employee_study_training/{employeeStudyTraining}',[EmployeeStudyTrainingsController::class, 'destroy'])->name('employee_study_trainings.employee_study_training.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_files',
], function () {
    Route::get('/', [EmployeeFilesController::class, 'index'])->name('employee_files.employee_file.index');
    Route::get('/create',[EmployeeFilesController::class, 'create'])->name('employee_files.employee_file.create');
    Route::get('/show/{employeeFile}',[EmployeeFilesController::class, 'show'])->name('employee_files.employee_file.show')->where('id', '[0-9]+');
    Route::get('/{employeeFile}/edit',[EmployeeFilesController::class, 'edit'])->name('employee_files.employee_file.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeeFilesController::class, 'store'])->name('employee_files.employee_file.store');
    Route::put('employee_file/{employeeFile}', [EmployeeFilesController::class, 'update'])->name('employee_files.employee_file.update')->where('id', '[0-9]+');
    Route::delete('/employee_file/{employeeFile}',[EmployeeFilesController::class, 'destroy'])->name('employee_files.employee_file.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'reports',
], function () {
    Route::get('/', [ReportsController::class, 'index'])->name('reports.report.index');
    Route::get('/create',[ReportsController::class, 'create'])->name('reports.report.create');
    Route::get('/show/{report}',[ReportsController::class, 'show'])->name('reports.report.show')->where('id', '[0-9]+');
    Route::get('/{report}/edit',[ReportsController::class, 'edit'])->name('reports.report.edit')->where('id', '[0-9]+');
    Route::post('/', [ReportsController::class, 'store'])->name('reports.report.store');
    Route::put('report/{report}', [ReportsController::class, 'update'])->name('reports.report.update')->where('id', '[0-9]+');
    Route::delete('/report/{report}',[ReportsController::class, 'destroy'])->name('reports.report.destroy')->where('id', '[0-9]+');
});
