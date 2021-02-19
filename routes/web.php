<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
     'prefix' => 'organizations',
 ], function () {
     Route::get('/', 'App\Http\Controllers\OrganizationsController@index')
          ->name('organizations.organization.index');
     Route::get('/create','App\Http\Controllers\OrganizationsController@create')
          ->name('organizations.organization.create');
     Route::get('/show/{organization}','App\Http\Controllers\OrganizationsController@show')
          ->name('organizations.organization.show')->where('id', '[0-9]+');
     Route::get('/{organization}/edit','App\Http\Controllers\OrganizationsController@edit')
          ->name('organizations.organization.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\OrganizationsController@store')
          ->name('organizations.organization.store');
     Route::put('organization/{organization}', 'App\Http\Controllers\OrganizationsController@update')
          ->name('organizations.organization.update')->where('id', '[0-9]+');
     Route::delete('/organization/{organization}','App\Http\Controllers\OrganizationsController@destroy')
          ->name('organizations.organization.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
      'prefix' => 'settings',
  ], function () {
      Route::get('/', 'App\Http\Controllers\SettingsController@index')
           ->name('settings.setting.index');
  });

 Route::group([
     'prefix' => 'settings/organization_locations',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\OrganizationLocationsController@index')
          ->name('organization_locations.organization_location.index');
     Route::get('/create','App\Http\Controllers\Setting\OrganizationLocationsController@create')
          ->name('organization_locations.organization_location.create');
     Route::get('/{organizationLocation}/edit','App\Http\Controllers\Setting\OrganizationLocationsController@edit')
          ->name('organization_locations.organization_location.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\OrganizationLocationsController@store')
          ->name('organization_locations.organization_location.store');
     Route::put('organization_location/{organizationLocation}', 'App\Http\Controllers\Setting\OrganizationLocationsController@update')
          ->name('organization_locations.organization_location.update')->where('id', '[0-9]+');
     Route::delete('/organization_location/{organizationLocation}','App\Http\Controllers\Setting\OrganizationLocationsController@destroy')
          ->name('organization_locations.organization_location.destroy')->where('id', '[0-9]+');
 });

Route::group([
    'prefix' => 'settings/job_category',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\JobCategoriesController@index')
         ->name('job_categories.job_category.index');
    Route::get('/create','App\Http\Controllers\Setting\JobCategoriesController@create')
         ->name('job_categories.job_category.create');
    Route::get('/{jobCategory}/edit','App\Http\Controllers\Setting\JobCategoriesController@edit')
         ->name('job_categories.job_category.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\JobCategoriesController@store')
         ->name('job_categories.job_category.store');
    Route::put('job_category/{jobCategory}', 'App\Http\Controllers\Setting\JobCategoriesController@update')
         ->name('job_categories.job_category.update')->where('id', '[0-9]+');
    Route::post('/delete/{jobCategory}','App\Http\Controllers\Setting\JobCategoriesController@destroy')
         ->name('job_categories.job_category.destroy')->where('id', '[0-9]+');
});
Route::group([
    'prefix' => 'settings/job_title_categories',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\JobTitleCategoriesController@index')
         ->name('job_title_categories.job_title_category.index');
    Route::get('/create','App\Http\Controllers\Setting\JobTitleCategoriesController@create')
         ->name('job_title_categories.job_title_category.create');
    Route::get('/{jobTitleCategory}/edit','App\Http\Controllers\Setting\JobTitleCategoriesController@edit')
         ->name('job_title_categories.job_title_category.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\JobTitleCategoriesController@store')
         ->name('job_title_categories.job_title_category.store');
    Route::put('job_title_category/{jobTitleCategory}', 'App\Http\Controllers\Setting\JobTitleCategoriesController@update')
         ->name('job_title_categories.job_title_category.update')->where('id', '[0-9]+');
    Route::post('/delete/{jobTitleCategory}','App\Http\Controllers\Setting\JobTitleCategoriesController@destroy')
         ->name('job_title_categories.job_title_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/job_types',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\JobTypesController@index')
         ->name('job_types.job_type.index');
    Route::get('/create','App\Http\Controllers\Setting\JobTypesController@create')
         ->name('job_types.job_type.create');
    Route::get('/{jobType}/edit','App\Http\Controllers\Setting\JobTypesController@edit')
         ->name('job_types.job_type.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\JobTypesController@store')
         ->name('job_types.job_type.store');
    Route::put('job_type/{jobType}', 'App\Http\Controllers\Setting\JobTypesController@update')
         ->name('job_types.job_type.update')->where('id', '[0-9]+');
    Route::delete('/job_type/{jobType}','App\Http\Controllers\Setting\JobTypesController@destroy')
         ->name('job_types.job_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/languages',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\LanguagesController@index')
         ->name('languages.language.index');
    Route::get('/create','App\Http\Controllers\Setting\LanguagesController@create')
         ->name('languages.language.create');
    Route::get('/{language}/edit','App\Http\Controllers\Setting\LanguagesController@edit')
         ->name('languages.language.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\LanguagesController@store')
         ->name('languages.language.store');
    Route::put('language/{language}', 'App\Http\Controllers\Setting\LanguagesController@update')
         ->name('languages.language.update')->where('id', '[0-9]+');
    Route::delete('/language/{language}','App\Http\Controllers\Setting\LanguagesController@destroy')
         ->name('languages.language.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/language_levels',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\LanguageLevelsController@index')
         ->name('language_levels.language_level.index');
    Route::get('/create','App\Http\Controllers\Setting\LanguageLevelsController@create')
         ->name('language_levels.language_level.create');
    Route::get('/{languageLevel}/edit','App\Http\Controllers\Setting\LanguageLevelsController@edit')
         ->name('language_levels.language_level.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\LanguageLevelsController@store')
         ->name('language_levels.language_level.store');
    Route::put('language_level/{languageLevel}', 'App\Http\Controllers\Setting\LanguageLevelsController@update')
         ->name('language_levels.language_level.update')->where('id', '[0-9]+');
    Route::delete('/language_level/{languageLevel}','App\Http\Controllers\Setting\LanguageLevelsController@destroy')
         ->name('language_levels.language_level.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/marital_statuses',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\MaritalStatusesController@index')
         ->name('marital_statuses.marital_status.index');
    Route::get('/create','App\Http\Controllers\Setting\MaritalStatusesController@create')
         ->name('marital_statuses.marital_status.create');
    Route::get('/{maritalStatus}/edit','App\Http\Controllers\Setting\MaritalStatusesController@edit')
         ->name('marital_statuses.marital_status.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\MaritalStatusesController@store')
         ->name('marital_statuses.marital_status.store');
    Route::put('marital_status/{maritalStatus}', 'App\Http\Controllers\Setting\MaritalStatusesController@update')
         ->name('marital_statuses.marital_status.update')->where('id', '[0-9]+');
    Route::delete('/marital_status/{maritalStatus}','App\Http\Controllers\Setting\MaritalStatusesController@destroy')
         ->name('marital_statuses.marital_status.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/nationalities',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\NationalitiesController@index')
         ->name('nationalities.nationality.index');
    Route::get('/create','App\Http\Controllers\Setting\NationalitiesController@create')
         ->name('nationalities.nationality.create');
    Route::get('/{nationality}/edit','App\Http\Controllers\Setting\NationalitiesController@edit')
         ->name('nationalities.nationality.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\NationalitiesController@store')
         ->name('nationalities.nationality.store');
    Route::put('nationality/{nationality}', 'App\Http\Controllers\Setting\NationalitiesController@update')
         ->name('nationalities.nationality.update')->where('id', '[0-9]+');
    Route::delete('/nationality/{nationality}','App\Http\Controllers\Setting\NationalitiesController@destroy')
         ->name('nationalities.nationality.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/religions',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\ReligionsController@index')
         ->name('religions.religion.index');
    Route::get('/create','App\Http\Controllers\Setting\ReligionsController@create')
         ->name('religions.religion.create');
    Route::get('/{religion}/edit','App\Http\Controllers\Setting\ReligionsController@edit')
         ->name('religions.religion.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\ReligionsController@store')
         ->name('religions.religion.store');
    Route::put('religion/{religion}', 'App\Http\Controllers\Setting\ReligionsController@update')
         ->name('religions.religion.update')->where('id', '[0-9]+');
    Route::delete('/religion/{religion}','App\Http\Controllers\Setting\ReligionsController@destroy')
         ->name('religions.religion.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/regions',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\RegionsController@index')
         ->name('regions.region.index');
    Route::get('/create','App\Http\Controllers\Setting\RegionsController@create')
         ->name('regions.region.create');
    Route::get('/{region}/edit','App\Http\Controllers\Setting\RegionsController@edit')
         ->name('regions.region.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\RegionsController@store')
         ->name('regions.region.store');
    Route::put('region/{region}', 'App\Http\Controllers\Setting\RegionsController@update')
         ->name('regions.region.update')->where('id', '[0-9]+');
    Route::delete('/region/{region}','App\Http\Controllers\Setting\RegionsController@destroy')
         ->name('regions.region.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'settings/zones',
 ], function () {
     Route::get('/{region}', 'App\Http\Controllers\Setting\ZonesController@index')
          ->name('zones.zone.index');
     Route::get('/create','App\Http\Controllers\Setting\ZonesController@create')
          ->name('zones.zone.create');
     Route::get('/show/{zone}','App\Http\Controllers\Setting\ZonesController@show')
          ->name('zones.zone.show')->where('id', '[0-9]+');
     Route::get('/{zone}/edit','App\Http\Controllers\Setting\ZonesController@edit')
          ->name('zones.zone.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\ZonesController@store')
          ->name('zones.zone.store');
     Route::put('zone/{zone}', 'App\Http\Controllers\Setting\ZonesController@update')
          ->name('zones.zone.update')->where('id', '[0-9]+');
     Route::delete('/zone/{zone}','App\Http\Controllers\Setting\ZonesController@destroy')
          ->name('zones.zone.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/woredas',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\WoredasController@index')
          ->name('woredas.woreda.index');
     Route::get('/create','App\Http\Controllers\Setting\WoredasController@create')
          ->name('woredas.woreda.create');
     Route::get('/show/{woreda}','App\Http\Controllers\Setting\WoredasController@show')
          ->name('woredas.woreda.show')->where('id', '[0-9]+');
     Route::get('/{woreda}/edit','App\Http\Controllers\Setting\WoredasController@edit')
          ->name('woredas.woreda.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\WoredasController@store')
          ->name('woredas.woreda.store');
     Route::put('woreda/{woreda}', 'App\Http\Controllers\Setting\WoredasController@update')
          ->name('woredas.woreda.update')->where('id', '[0-9]+');
     Route::delete('/woreda/{woreda}','App\Http\Controllers\Setting\WoredasController@destroy')
          ->name('woredas.woreda.destroy')->where('id', '[0-9]+');
 });

Route::group([
    'prefix' => 'settings/skill_categories',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\SkillCategoriesController@index')
         ->name('skill_categories.skill_category.index');
    Route::get('/create','App\Http\Controllers\Setting\SkillCategoriesController@create')
         ->name('skill_categories.skill_category.create');
    Route::get('/{skillCategory}/edit','App\Http\Controllers\Setting\SkillCategoriesController@edit')
         ->name('skill_categories.skill_category.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\SkillCategoriesController@store')
         ->name('skill_categories.skill_category.store');
    Route::put('skill_category/{skillCategory}', 'App\Http\Controllers\Setting\SkillCategoriesController@update')
         ->name('skill_categories.skill_category.update')->where('id', '[0-9]+');
    Route::delete('/skill_category/{skillCategory}','App\Http\Controllers\Setting\SkillCategoriesController@destroy')
         ->name('skill_categories.skill_category.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/relationships',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\RelationshipsController@index')
         ->name('relationships.relationship.index');
    Route::get('/create','App\Http\Controllers\Setting\RelationshipsController@create')
         ->name('relationships.relationship.create');
    Route::get('/{relationship}/edit','App\Http\Controllers\Setting\RelationshipsController@edit')
         ->name('relationships.relationship.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\RelationshipsController@store')
         ->name('relationships.relationship.store');
    Route::put('relationship/{relationship}', 'App\Http\Controllers\Setting\RelationshipsController@update')
         ->name('relationships.relationship.update')->where('id', '[0-9]+');
    Route::delete('/relationship/{relationship}','App\Http\Controllers\Setting\RelationshipsController@destroy')
         ->name('relationships.relationship.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/employee_statuses',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\EmployeeStatusesController@index')
         ->name('employee_statuses.employee_status.index');
    Route::get('/create','App\Http\Controllers\Setting\EmployeeStatusesController@create')
         ->name('employee_statuses.employee_status.create');
    Route::get('/{employeeStatus}/edit','App\Http\Controllers\Setting\EmployeeStatusesController@edit')
         ->name('employee_statuses.employee_status.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\EmployeeStatusesController@store')
         ->name('employee_statuses.employee_status.store');
    Route::put('employee_status/{employeeStatus}', 'App\Http\Controllers\Setting\EmployeeStatusesController@update')
         ->name('employee_statuses.employee_status.update')->where('id', '[0-9]+');
    Route::delete('/employee_status/{employeeStatus}','App\Http\Controllers\Setting\EmployeeStatusesController@destroy')
         ->name('employee_statuses.employee_status.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/address_types',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\AddressTypesController@index')
         ->name('address_types.address_type.index');
    Route::get('/create','App\Http\Controllers\Setting\AddressTypesController@create')
         ->name('address_types.address_type.create');
    Route::get('/{addressType}/edit','App\Http\Controllers\Setting\AddressTypesController@edit')
         ->name('address_types.address_type.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\AddressTypesController@store')
         ->name('address_types.address_type.store');
    Route::put('address_type/{addressType}', 'App\Http\Controllers\Setting\AddressTypesController@update')
         ->name('address_types.address_type.update')->where('id', '[0-9]+');
    Route::delete('/address_type/{addressType}','App\Http\Controllers\Setting\AddressTypesController@destroy')
         ->name('address_types.address_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/experience_types',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\ExperienceTypesController@index')
         ->name('experience_types.experience_type.index');
    Route::get('/create','App\Http\Controllers\Setting\ExperienceTypesController@create')
         ->name('experience_types.experience_type.create');
    Route::get('/{experienceType}/edit','App\Http\Controllers\Setting\ExperienceTypesController@edit')
         ->name('experience_types.experience_type.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\ExperienceTypesController@store')
         ->name('experience_types.experience_type.store');
    Route::put('experience_type/{experienceType}', 'App\Http\Controllers\Setting\ExperienceTypesController@update')
         ->name('experience_types.experience_type.update')->where('id', '[0-9]+');
    Route::delete('/experience_type/{experienceType}','App\Http\Controllers\Setting\ExperienceTypesController@destroy')
         ->name('experience_types.experience_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/license_types',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\LicenseTypesController@index')
         ->name('license_types.license_type.index');
    Route::get('/create','App\Http\Controllers\Setting\LicenseTypesController@create')
         ->name('license_types.license_type.create');
    Route::get('/{licenseType}/edit','App\Http\Controllers\Setting\LicenseTypesController@edit')
         ->name('license_types.license_type.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\LicenseTypesController@store')
         ->name('license_types.license_type.store');
    Route::put('license_type/{licenseType}', 'App\Http\Controllers\Setting\LicenseTypesController@update')
         ->name('license_types.license_type.update')->where('id', '[0-9]+');
    Route::delete('/license_type/{licenseType}','App\Http\Controllers\Setting\LicenseTypesController@destroy')
         ->name('license_types.license_type.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/education_levels',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\EducationLevelsController@index')
         ->name('education_levels.education_level.index');
    Route::get('/create','App\Http\Controllers\Setting\EducationLevelsController@create')
         ->name('education_levels.education_level.create');
    Route::get('/{educationLevel}/edit','App\Http\Controllers\Setting\EducationLevelsController@edit')
         ->name('education_levels.education_level.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\EducationLevelsController@store')
         ->name('education_levels.education_level.store');
    Route::put('education_level/{educationLevel}', 'App\Http\Controllers\Setting\EducationLevelsController@update')
         ->name('education_levels.education_level.update')->where('id', '[0-9]+');
    Route::delete('/education_level/{educationLevel}','App\Http\Controllers\Setting\EducationLevelsController@destroy')
         ->name('education_levels.education_level.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/educational_institutes',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\EducationalInstitutesController@index')
         ->name('educational_institutes.educational_institute.index');
    Route::get('/create','App\Http\Controllers\Setting\EducationalInstitutesController@create')
         ->name('educational_institutes.educational_institute.create');
    Route::get('/{educationalInstitute}/edit','App\Http\Controllers\Setting\EducationalInstitutesController@edit')
         ->name('educational_institutes.educational_institute.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\EducationalInstitutesController@store')
         ->name('educational_institutes.educational_institute.store');
    Route::put('educational_institute/{educationalInstitute}', 'App\Http\Controllers\Setting\EducationalInstitutesController@update')
         ->name('educational_institutes.educational_institute.update')->where('id', '[0-9]+');
    Route::delete('/educational_institute/{educationalInstitute}','App\Http\Controllers\Setting\EducationalInstitutesController@destroy')
         ->name('educational_institutes.educational_institute.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/educational_fields',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\EducationalFieldsController@index')
         ->name('educational_fields.educational_field.index');
    Route::get('/create','App\Http\Controllers\Setting\EducationalFieldsController@create')
         ->name('educational_fields.educational_field.create');
    Route::get('/{educationalField}/edit','App\Http\Controllers\Setting\EducationalFieldsController@edit')
         ->name('educational_fields.educational_field.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\EducationalFieldsController@store')
         ->name('educational_fields.educational_field.store');
    Route::put('educational_field/{educationalField}', 'App\Http\Controllers\Setting\EducationalFieldsController@update')
         ->name('educational_fields.educational_field.update')->where('id', '[0-9]+');
    Route::delete('/educational_field/{educationalField}','App\Http\Controllers\Setting\EducationalFieldsController@destroy')
         ->name('educational_fields.educational_field.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'settings/disaster_causes',
], function () {
    Route::get('/', 'App\Http\Controllers\Setting\DisasterCausesController@index')
         ->name('disaster_causes.disaster_cause.index');
    Route::get('/create','App\Http\Controllers\Setting\DisasterCausesController@create')
         ->name('disaster_causes.disaster_cause.create');
    Route::get('/{disasterCause}/edit','App\Http\Controllers\Setting\DisasterCausesController@edit')
         ->name('disaster_causes.disaster_cause.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\Setting\DisasterCausesController@store')
         ->name('disaster_causes.disaster_cause.store');
    Route::put('disaster_cause/{disasterCause}', 'App\Http\Controllers\Setting\DisasterCausesController@update')
         ->name('disaster_causes.disaster_cause.update')->where('id', '[0-9]+');
    Route::delete('/disaster_cause/{disasterCause}','App\Http\Controllers\Setting\DisasterCausesController@destroy')
         ->name('disaster_causes.disaster_cause.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'settings/sexes',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\SexesController@index')
          ->name('sexes.sex.index');
     Route::get('/create','App\Http\Controllers\Setting\SexesController@create')
          ->name('sexes.sex.create');
     Route::get('/{sex}/edit','App\Http\Controllers\Setting\SexesController@edit')
          ->name('sexes.sex.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\SexesController@store')
          ->name('sexes.sex.store');
     Route::put('sex/{sex}', 'App\Http\Controllers\Setting\SexesController@update')
          ->name('sexes.sex.update')->where('id', '[0-9]+');
     Route::delete('/sex/{sex}','App\Http\Controllers\Setting\SexesController@destroy')
          ->name('sexes.sex.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/template_types',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\TemplateTypesController@index')
          ->name('template_types.template_type.index');
     Route::get('/create','App\Http\Controllers\Setting\TemplateTypesController@create')
          ->name('template_types.template_type.create');
     Route::get('/{templateType}/edit','App\Http\Controllers\Setting\TemplateTypesController@edit')
          ->name('template_types.template_type.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\TemplateTypesController@store')
          ->name('template_types.template_type.store');
     Route::put('template_type/{templateType}', 'App\Http\Controllers\Setting\TemplateTypesController@update')
          ->name('template_types.template_type.update')->where('id', '[0-9]+');
     Route::delete('/template_type/{templateType}','App\Http\Controllers\Setting\TemplateTypesController@destroy')
          ->name('template_types.template_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/templates',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\TemplatesController@index')
          ->name('templates.template.index');
     Route::get('/create','App\Http\Controllers\Setting\TemplatesController@create')
          ->name('templates.template.create');
     Route::get('/show/{template}','App\Http\Controllers\Setting\TemplatesController@show')
          ->name('templates.template.show')->where('id', '[0-9]+');
     Route::get('/{template}/edit','App\Http\Controllers\Setting\TemplatesController@edit')
          ->name('templates.template.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\TemplatesController@store')
          ->name('templates.template.store');
     Route::put('template/{template}', 'App\Http\Controllers\Setting\TemplatesController@update')
          ->name('templates.template.update')->where('id', '[0-9]+');
     Route::delete('/template/{template}','App\Http\Controllers\Setting\TemplatesController@destroy')
          ->name('templates.template.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/titles',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\TitlesController@index')
          ->name('titles.title.index');
     Route::get('/create','App\Http\Controllers\Setting\TitlesController@create')
          ->name('titles.title.create');
     Route::get('/{title}/edit','App\Http\Controllers\Setting\TitlesController@edit')
          ->name('titles.title.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\TitlesController@store')
          ->name('titles.title.store');
     Route::put('title/{title}', 'App\Http\Controllers\Setting\TitlesController@update')
          ->name('titles.title.update')->where('id', '[0-9]+');
     Route::delete('/title/{title}','App\Http\Controllers\Setting\TitlesController@destroy')
          ->name('titles.title.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/banks',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\BanksController@index')
          ->name('banks.bank.index');
     Route::get('/create','App\Http\Controllers\Setting\BanksController@create')
          ->name('banks.bank.create');
     Route::get('/{bank}/edit','App\Http\Controllers\Setting\BanksController@edit')
          ->name('banks.bank.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\BanksController@store')
          ->name('banks.bank.store');
     Route::put('bank/{bank}', 'App\Http\Controllers\Setting\BanksController@update')
          ->name('banks.bank.update')->where('id', '[0-9]+');
     Route::delete('/bank/{bank}','App\Http\Controllers\Setting\BanksController@destroy')
          ->name('banks.bank.destroy')->where('id', '[0-9]+');
 }); 


Route::group([
     'prefix' => 'settings/bank_account_types',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\BankAccountTypesController@index')
          ->name('bank_account_types.bank_account_type.index');
     Route::get('/create','App\Http\Controllers\Setting\BankAccountTypesController@create')
          ->name('bank_account_types.bank_account_type.create');
     Route::get('/{bankAccountType}/edit','App\Http\Controllers\Setting\BankAccountTypesController@edit')
          ->name('bank_account_types.bank_account_type.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\BankAccountTypesController@store')
          ->name('bank_account_types.bank_account_type.store');
     Route::put('bank_account_type/{bankAccountType}', 'App\Http\Controllers\Setting\BankAccountTypesController@update')
          ->name('bank_account_types.bank_account_type.update')->where('id', '[0-9]+');
     Route::delete('/bank_account_type/{bankAccountType}','App\Http\Controllers\Setting\BankAccountTypesController@destroy')
          ->name('bank_account_types.bank_account_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/disability_types',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\DisabilityTypesController@index')
          ->name('disability_types.disability_type.index');
     Route::get('/create','App\Http\Controllers\Setting\DisabilityTypesController@create')
          ->name('disability_types.disability_type.create');
     Route::get('/{disabilityType}/edit','App\Http\Controllers\Setting\DisabilityTypesController@edit')
          ->name('disability_types.disability_type.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\DisabilityTypesController@store')
          ->name('disability_types.disability_type.store');
     Route::put('disability_type/{disabilityType}', 'App\Http\Controllers\Setting\DisabilityTypesController@update')
          ->name('disability_types.disability_type.update')->where('id', '[0-9]+');
     Route::delete('/disability_type/{disabilityType}','App\Http\Controllers\Setting\DisabilityTypesController@destroy')
          ->name('disability_types.disability_type.destroy')->where('id', '[0-9]+');
 });


Route::group([
     'prefix' => 'settings/gpa_scales',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\GPAScalesController@index')
          ->name('gpa_scales.gpa_scale.index');
     Route::get('/create','App\Http\Controllers\Setting\GPAScalesController@create')
          ->name('gpa_scales.gpa_scale.create');
     Route::get('/{gPAScale}/edit','App\Http\Controllers\Setting\GPAScalesController@edit')
          ->name('gpa_scales.gpa_scale.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\GPAScalesController@store')
          ->name('gpa_scales.gpa_scale.store');
     Route::put('gpa_scale/{gPAScale}', 'App\Http\Controllers\Setting\GPAScalesController@update')
          ->name('gpa_scales.gpa_scale.update')->where('id', '[0-9]+');
     Route::delete('/gpa_scale/{gPAScale}','App\Http\Controllers\Setting\GPAScalesController@destroy')
          ->name('gpa_scales.gpa_scale.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/award_types',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\AwardTypesController@index')
          ->name('award_types.award_type.index');
     Route::get('/create','App\Http\Controllers\Setting\AwardTypesController@create')
          ->name('award_types.award_type.create');
     Route::get('/{awardType}/edit','App\Http\Controllers\Setting\AwardTypesController@edit')
          ->name('award_types.award_type.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\AwardTypesController@store')
          ->name('award_types.award_type.store');
     Route::put('award_type/{awardType}', 'App\Http\Controllers\Setting\AwardTypesController@update')
          ->name('award_types.award_type.update')->where('id', '[0-9]+');
     Route::delete('/award_type/{awardType}','App\Http\Controllers\Setting\AwardTypesController@destroy')
          ->name('award_types.award_type.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/commitment_fors',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\CommitmentForsController@index')
          ->name('commitment_fors.commitment_for.index');
     Route::get('/create','App\Http\Controllers\Setting\CommitmentForsController@create')
          ->name('commitment_fors.commitment_for.create');
     Route::get('/{commitmentFor}/edit','App\Http\Controllers\Setting\CommitmentForsController@edit')
          ->name('commitment_fors.commitment_for.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\CommitmentForsController@store')
          ->name('commitment_fors.commitment_for.store');
     Route::put('commitment_for/{commitmentFor}', 'App\Http\Controllers\Setting\CommitmentForsController@update')
          ->name('commitment_fors.commitment_for.update')->where('id', '[0-9]+');
     Route::delete('/commitment_for/{commitmentFor}','App\Http\Controllers\Setting\CommitmentForsController@destroy')
          ->name('commitment_fors.commitment_for.destroy')->where('id', '[0-9]+');
 });

 Route::group([
     'prefix' => 'settings/left_reasons',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\LeftReasonsController@index')
          ->name('left_reasons.left_reason.index');
     Route::get('/create','App\Http\Controllers\Setting\LeftReasonsController@create')
          ->name('left_reasons.left_reason.create');
     Route::get('/{leftReason}/edit','App\Http\Controllers\Setting\LeftReasonsController@edit')
          ->name('left_reasons.left_reason.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\LeftReasonsController@store')
          ->name('left_reasons.left_reason.store');
     Route::put('left_reason/{leftReason}', 'App\Http\Controllers\Setting\LeftReasonsController@update')
          ->name('left_reasons.left_reason.update')->where('id', '[0-9]+');
     Route::delete('/left_reason/{leftReason}','App\Http\Controllers\Setting\LeftReasonsController@destroy')
          ->name('left_reasons.left_reason.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/disaster_severities',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\DisasterSeveritiesController@index')
          ->name('disaster_severities.disaster_severity.index');
     Route::get('/create','App\Http\Controllers\Setting\DisasterSeveritiesController@create')
          ->name('disaster_severities.disaster_severity.create');
     Route::get('/{disasterSeverity}/edit','App\Http\Controllers\Setting\DisasterSeveritiesController@edit')
          ->name('disaster_severities.disaster_severity.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\DisasterSeveritiesController@store')
          ->name('disaster_severities.disaster_severity.store');
     Route::put('disaster_severity/{disasterSeverity}', 'App\Http\Controllers\Setting\DisasterSeveritiesController@update')
          ->name('disaster_severities.disaster_severity.update')->where('id', '[0-9]+');
     Route::delete('/disaster_severity/{disasterSeverity}','App\Http\Controllers\Setting\DisasterSeveritiesController@destroy')
          ->name('disaster_severities.disaster_severity.destroy')->where('id', '[0-9]+');
 });
 
 Route::group([
     'prefix' => 'settings/certification_vendors',
 ], function () {
     Route::get('/', 'App\Http\Controllers\Setting\CertificationVendorsController@index')
          ->name('certification_vendors.certification_vendor.index');
     Route::get('/create','App\Http\Controllers\Setting\CertificationVendorsController@create')
          ->name('certification_vendors.certification_vendor.create');
     Route::get('/{certificationVendor}/edit','App\Http\Controllers\Setting\CertificationVendorsController@edit')
          ->name('certification_vendors.certification_vendor.edit')->where('id', '[0-9]+');
     Route::post('/', 'App\Http\Controllers\Setting\CertificationVendorsController@store')
          ->name('certification_vendors.certification_vendor.store');
     Route::put('certification_vendor/{certificationVendor}', 'App\Http\Controllers\Setting\CertificationVendorsController@update')
          ->name('certification_vendors.certification_vendor.update')->where('id', '[0-9]+');
     Route::delete('/certification_vendor/{certificationVendor}','App\Http\Controllers\Setting\CertificationVendorsController@destroy')
          ->name('certification_vendors.certification_vendor.destroy')->where('id', '[0-9]+');
 });
 
Route::group([
    'prefix' => 'organization_units',
], function () {
    Route::get('/', 'App\Http\Controllers\OrganizationUnitsController@index')
         ->name('organization_units.organization_unit.index');
    Route::get('/create','App\Http\Controllers\OrganizationUnitsController@create')
         ->name('organization_units.organization_unit.create');
    Route::get('/show/{organizationUnit}','App\Http\Controllers\OrganizationUnitsController@show')
         ->name('organization_units.organization_unit.show')->where('id', '[0-9]+');
    Route::get('/{organizationUnit}/edit','App\Http\Controllers\OrganizationUnitsController@edit')
         ->name('organization_units.organization_unit.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\OrganizationUnitsController@store')
         ->name('organization_units.organization_unit.store');
    Route::post('/filter', 'App\Http\Controllers\OrganizationUnitsController@filter')
          ->name('organization_units.organization_unit.filter');
    Route::put('organization_unit/{organizationUnit}', 'App\Http\Controllers\OrganizationUnitsController@update')
         ->name('organization_units.organization_unit.update')->where('id', '[0-9]+');
    Route::delete('/organization_unit/{organizationUnit}','App\Http\Controllers\OrganizationUnitsController@destroy')
         ->name('organization_units.organization_unit.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'help',
], function () {
    Route::get('/', 'App\Http\Controllers\HelpsController@index')
         ->name('helps.help.index');
    Route::get('/create','App\Http\Controllers\HelpsController@create')
         ->name('helps.help.create');
    Route::get('/show/{help}','App\Http\Controllers\HelpsController@show')
         ->name('helps.help.show')->where('id', '[0-9]+');
    Route::get('/{help}/edit','App\Http\Controllers\HelpsController@edit')
         ->name('helps.help.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\HelpsController@store')
         ->name('helps.help.store');
    Route::post('/filter', 'App\Http\Controllers\HelpsController@filter')
         ->name('helps.help.filter');
    Route::put('help/{help}', 'App\Http\Controllers\HelpsController@update')
         ->name('helps.help.update')->where('id', '[0-9]+');
    Route::delete('/help/{help}','App\Http\Controllers\HelpsController@destroy')
         ->name('helps.help.destroy')->where('id', '[0-9]+');
});


Route::group([
    'prefix' => 'salary_scales',
], function () {
    Route::get('/', 'App\Http\Controllers\SalaryScalesController@index')
         ->name('salary_scales.salary_scale.index');
    Route::get('/create','App\Http\Controllers\SalaryScalesController@create')
         ->name('salary_scales.salary_scale.create');
    Route::get('/show/{salaryScale}','App\Http\Controllers\SalaryScalesController@show')
         ->name('salary_scales.salary_scale.show')->where('id', '[0-9]+');
    Route::get('/{salaryScale}/edit','App\Http\Controllers\SalaryScalesController@edit')
         ->name('salary_scales.salary_scale.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\SalaryScalesController@store')
         ->name('salary_scales.salary_scale.store');
    Route::put('salary_scale/{salaryScale}', 'App\Http\Controllers\SalaryScalesController@update')
         ->name('salary_scales.salary_scale.update')->where('id', '[0-9]+');
    Route::delete('/salary_scale/{salaryScale}','App\Http\Controllers\SalaryScalesController@destroy')
         ->name('salary_scales.salary_scale.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salary_steps',
], function () {
    Route::get('/', 'App\Http\Controllers\SalaryStepsController@index')
         ->name('salary_steps.salary_step.index');
    Route::get('/create','App\Http\Controllers\SalaryStepsController@create')
         ->name('salary_steps.salary_step.create');
    Route::get('/show/{salaryStep}','App\Http\Controllers\SalaryStepsController@show')
         ->name('salary_steps.salary_step.show')->where('id', '[0-9]+');
    Route::get('/{salaryStep}/edit','App\Http\Controllers\SalaryStepsController@edit')
         ->name('salary_steps.salary_step.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\SalaryStepsController@store')
         ->name('salary_steps.salary_step.store');
    Route::put('salary_step/{salaryStep}', 'App\Http\Controllers\SalaryStepsController@update')
         ->name('salary_steps.salary_step.update')->where('id', '[0-9]+');
    Route::delete('/salary_step/{salaryStep}','App\Http\Controllers\SalaryStepsController@destroy')
         ->name('salary_steps.salary_step.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'salary_heights',
], function () {
    Route::get('/', 'App\Http\Controllers\SalaryHeightsController@index')
         ->name('salary_heights.salary_height.index');
    Route::get('/create','App\Http\Controllers\SalaryHeightsController@create')
         ->name('salary_heights.salary_height.create');
    Route::get('/show/{salaryHeight}','App\Http\Controllers\SalaryHeightsController@show')
         ->name('salary_heights.salary_height.show')->where('id', '[0-9]+');
    Route::get('/{salaryHeight}/edit','App\Http\Controllers\SalaryHeightsController@edit')
         ->name('salary_heights.salary_height.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\SalaryHeightsController@store')
         ->name('salary_heights.salary_height.store');
    Route::put('salary_height/{salaryHeight}', 'App\Http\Controllers\SalaryHeightsController@update')
         ->name('salary_heights.salary_height.update')->where('id', '[0-9]+');
    Route::delete('/salary_height/{salaryHeight}','App\Http\Controllers\SalaryHeightsController@destroy')
         ->name('salary_heights.salary_height.destroy')->where('id', '[0-9]+');
});


Route::group([
    'prefix' => 'salaries',
], function () {
    Route::get('/', 'App\Http\Controllers\SalariesController@index')
         ->name('salaries.salary.index');
    Route::get('/create','App\Http\Controllers\SalariesController@create')
         ->name('salaries.salary.create');
    Route::get('/show/{salary}','App\Http\Controllers\SalariesController@show')
         ->name('salaries.salary.show')->where('id', '[0-9]+');
    Route::get('/{salary}/edit','App\Http\Controllers\SalariesController@edit')
         ->name('salaries.salary.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\SalariesController@store')
         ->name('salaries.salary.store');
    Route::put('salary/{salary}', 'App\Http\Controllers\SalariesController@update')
         ->name('salaries.salary.update')->where('id', '[0-9]+');
    Route::delete('/salary/{salary}','App\Http\Controllers\SalariesController@destroy')
         ->name('salaries.salary.destroy')->where('id', '[0-9]+');
});


Route::group([
    'prefix' => 'job_positions',
], function () {
    Route::get('/', 'App\Http\Controllers\JobPositionsController@index')
         ->name('job_positions.job_position.index');
    Route::get('/benefits','App\Http\Controllers\JobPositionsController@benefits')
         ->name('job_positions.job_position.benefits');
         Route::get('/create','App\Http\Controllers\JobPositionsController@create')
              ->name('job_positions.job_position.create');
    Route::get('/show/{jobPosition}','App\Http\Controllers\JobPositionsController@show')
         ->name('job_positions.job_position.show')->where('id', '[0-9]+');
    Route::get('/{jobPosition}/edit','App\Http\Controllers\JobPositionsController@edit')
         ->name('job_positions.job_position.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\JobPositionsController@store')
         ->name('job_positions.job_position.store');
    Route::put('job_position/{jobPosition}', 'App\Http\Controllers\JobPositionsController@update')
         ->name('job_positions.job_position.update')->where('id', '[0-9]+');
    Route::delete('/job_position/{jobPosition}','App\Http\Controllers\JobPositionsController@destroy')
         ->name('job_positions.job_position.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employees',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeesController@index')
         ->name('employees.employee.index');
    Route::get('/filter','App\Http\Controllers\EmployeesController@filter')
          ->name('employees.employee.filter');
    Route::get('/{employee}/success','App\Http\Controllers\EmployeesController@success')
               ->name('employees.employee.success');
    Route::get('/create','App\Http\Controllers\EmployeesController@create')
         ->name('employees.employee.create');
    Route::get('/show/{employee}','App\Http\Controllers\EmployeesController@show')
         ->name('employees.employee.show')->where('id', '[0-9]+');
    Route::get('/{employee}/edit','App\Http\Controllers\EmployeesController@edit')
         ->name('employees.employee.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeesController@store')
         ->name('employees.employee.store');
    Route::put('employee/{employee}', 'App\Http\Controllers\EmployeesController@update')
         ->name('employees.employee.update')->where('id', '[0-9]+');
    Route::delete('/employee/{employee}','App\Http\Controllers\EmployeesController@destroy')
         ->name('employees.employee.destroy')->where('id', '[0-9]+');
});


Route::group([
    'prefix' => 'employee_addresses',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeAddressesController@index')
         ->name('employee_addresses.employee_address.index');
    Route::get('/create','App\Http\Controllers\EmployeeAddressesController@create')
         ->name('employee_addresses.employee_address.create');
     Route::get('/approve/{employeeAddress}','App\Http\Controllers\EmployeeAddressesController@approve')
          ->name('employee_addresses.employee_address.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeAddress}','App\Http\Controllers\EmployeeAddressesController@reject')
          ->name('employee_addresses.employee_address.reject')->where('id', '[0-9]+');
    Route::get('/{employeeAddress}/edit','App\Http\Controllers\EmployeeAddressesController@edit')
         ->name('employee_addresses.employee_address.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeAddressesController@store')
         ->name('employee_addresses.employee_address.store');
    Route::put('employee_address/{employeeAddress}', 'App\Http\Controllers\EmployeeAddressesController@update')
         ->name('employee_addresses.employee_address.update')->where('id', '[0-9]+');
    Route::delete('/employee_address/{employeeAddress}','App\Http\Controllers\EmployeeAddressesController@destroy')
         ->name('employee_addresses.employee_address.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_bank_accounts',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeBankAccountsController@index')
         ->name('employee_bank_accounts.employee_bank_account.index');
    Route::get('/create','App\Http\Controllers\EmployeeBankAccountsController@create')
         ->name('employee_bank_accounts.employee_bank_account.create');
    Route::get('/approve/{employeeBankAccount}','App\Http\Controllers\EmployeeBankAccountsController@approve')
         ->name('employee_bank_accounts.employee_bank_account.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeBankAccount}','App\Http\Controllers\EmployeeBankAccountsController@reject')
          ->name('employee_bank_accounts.employee_bank_account.reject')->where('id', '[0-9]+');
    Route::get('/{employeeBankAccount}/edit','App\Http\Controllers\EmployeeBankAccountsController@edit')
         ->name('employee_bank_accounts.employee_bank_account.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeBankAccountsController@store')
         ->name('employee_bank_accounts.employee_bank_account.store');
    Route::put('employee_bank_account/{employeeBankAccount}', 'App\Http\Controllers\EmployeeBankAccountsController@update')
         ->name('employee_bank_accounts.employee_bank_account.update')->where('id', '[0-9]+');
    Route::delete('/employee_bank_account/{employeeBankAccount}','App\Http\Controllers\EmployeeBankAccountsController@destroy')
         ->name('employee_bank_accounts.employee_bank_account.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_disabilities',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeDisabilitiesController@index')
         ->name('employee_disabilities.employee_disability.index');
    Route::get('/create','App\Http\Controllers\EmployeeDisabilitiesController@create')
         ->name('employee_disabilities.employee_disability.create');
    Route::get('/approve/{employeeDisability}','App\Http\Controllers\EmployeeDisabilitiesController@approve')
         ->name('employee_disabilities.employee_disability.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeDisability}','App\Http\Controllers\EmployeeDisabilitiesController@reject')
          ->name('employee_disabilities.employee_disability.reject')->where('id', '[0-9]+');
    Route::get('/{employeeDisability}/edit','App\Http\Controllers\EmployeeDisabilitiesController@edit')
         ->name('employee_disabilities.employee_disability.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeDisabilitiesController@store')
         ->name('employee_disabilities.employee_disability.store');
    Route::put('employee_disability/{employeeDisability}', 'App\Http\Controllers\EmployeeDisabilitiesController@update')
         ->name('employee_disabilities.employee_disability.update')->where('id', '[0-9]+');
    Route::delete('/employee_disability/{employeeDisability}','App\Http\Controllers\EmployeeDisabilitiesController@destroy')
         ->name('employee_disabilities.employee_disability.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_educations',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeEducationsController@index')
         ->name('employee_educations.employee_education.index');
    Route::get('/create','App\Http\Controllers\EmployeeEducationsController@create')
         ->name('employee_educations.employee_education.create');
    Route::get('/approve/{employeeEducation}','App\Http\Controllers\EmployeeEducationsController@approve')
     ->name('employee_educations.employee_education.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeEducation}','App\Http\Controllers\EmployeeEducationsController@reject')
              ->name('employee_educations.employee_education.reject')->where('id', '[0-9]+');
    Route::get('/{employeeEducation}/edit','App\Http\Controllers\EmployeeEducationsController@edit')
         ->name('employee_educations.employee_education.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeEducationsController@store')
         ->name('employee_educations.employee_education.store');
    Route::put('employee_education/{employeeEducation}', 'App\Http\Controllers\EmployeeEducationsController@update')
         ->name('employee_educations.employee_education.update')->where('id', '[0-9]+');
    Route::delete('/employee_education/{employeeEducation}','App\Http\Controllers\EmployeeEducationsController@destroy')
         ->name('employee_educations.employee_education.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_emergencies',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeEmergenciesController@index')
         ->name('employee_emergencies.employee_emergency.index');
    Route::get('/create','App\Http\Controllers\EmployeeEmergenciesController@create')
         ->name('employee_emergencies.employee_emergency.create');
    Route::get('/approve/{employeeEmergency}','App\Http\Controllers\EmployeeEmergenciesController@approve')
         ->name('employee_emergencies.employee_emergency.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeEmergency}','App\Http\Controllers\EmployeeEmergenciesController@reject')
          ->name('employee_emergencies.employee_emergency.reject')->where('id', '[0-9]+');
    Route::get('/{employeeEmergency}/edit','App\Http\Controllers\EmployeeEmergenciesController@edit')
         ->name('employee_emergencies.employee_emergency.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeEmergenciesController@store')
         ->name('employee_emergencies.employee_emergency.store');
    Route::put('employee_emergency/{employeeEmergency}', 'App\Http\Controllers\EmployeeEmergenciesController@update')
         ->name('employee_emergencies.employee_emergency.update')->where('id', '[0-9]+');
    Route::delete('/employee_emergency/{employeeEmergency}','App\Http\Controllers\EmployeeEmergenciesController@destroy')
         ->name('employee_emergencies.employee_emergency.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_families',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeFamiliesController@index')
         ->name('employee_families.employee_family.index');
    Route::get('/create','App\Http\Controllers\EmployeeFamiliesController@create')
         ->name('employee_families.employee_family.create');
    Route::get('/approve/{employeeFamily}','App\Http\Controllers\EmployeeFamiliesController@approve')
         ->name('employee_families.employee_family.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeFamily}','App\Http\Controllers\EmployeeFamiliesController@reject')
          ->name('employee_families.employee_family.reject')->where('id', '[0-9]+');
    Route::get('/{employeeFamily}/edit','App\Http\Controllers\EmployeeFamiliesController@edit')
         ->name('employee_families.employee_family.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeFamiliesController@store')
         ->name('employee_families.employee_family.store');
    Route::put('employee_family/{employeeFamily}', 'App\Http\Controllers\EmployeeFamiliesController@update')
         ->name('employee_families.employee_family.update')->where('id', '[0-9]+');
    Route::delete('/employee_family/{employeeFamily}','App\Http\Controllers\EmployeeFamiliesController@destroy')
         ->name('employee_families.employee_family.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_languages',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeLanguagesController@index')
         ->name('employee_languages.employee_language.index');
    Route::get('/create','App\Http\Controllers\EmployeeLanguagesController@create')
         ->name('employee_languages.employee_language.create');
    Route::get('/show/{employeeLanguage}','App\Http\Controllers\EmployeeLanguagesController@show')
         ->name('employee_languages.employee_language.show')->where('id', '[0-9]+');
    Route::get('/{employeeLanguage}/edit','App\Http\Controllers\EmployeeLanguagesController@edit')
         ->name('employee_languages.employee_language.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeLanguagesController@store')
         ->name('employee_languages.employee_language.store');
    Route::put('employee_language/{employeeLanguage}', 'App\Http\Controllers\EmployeeLanguagesController@update')
         ->name('employee_languages.employee_language.update')->where('id', '[0-9]+');
    Route::delete('/employee_language/{employeeLanguage}','App\Http\Controllers\EmployeeLanguagesController@destroy')
         ->name('employee_languages.employee_language.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employee_licenses',
], function () {
    Route::get('/', 'App\Http\Controllers\EmployeeLicensesController@index')
         ->name('employee_licenses.employee_license.index');
    Route::get('/create','App\Http\Controllers\EmployeeLicensesController@create')
         ->name('employee_licenses.employee_license.create');
    Route::get('/approve/{employeeLicense}','App\Http\Controllers\EmployeeLicensesController@approve')
         ->name('employee_licenses.employee_license.approve')->where('id', '[0-9]+');
     Route::post('/reject/{employeeLicense}','App\Http\Controllers\EmployeeLicensesController@reject')
          ->name('employee_licenses.employee_license.reject')->where('id', '[0-9]+');
    Route::get('/{employeeLicense}/edit','App\Http\Controllers\EmployeeLicensesController@edit')
         ->name('employee_licenses.employee_license.edit')->where('id', '[0-9]+');
    Route::post('/', 'App\Http\Controllers\EmployeeLicensesController@store')
         ->name('employee_licenses.employee_license.store');
    Route::put('employee_license/{employeeLicense}', 'App\Http\Controllers\EmployeeLicensesController@update')
         ->name('employee_licenses.employee_license.update')->where('id', '[0-9]+');
    Route::delete('/employee_license/{employeeLicense}','App\Http\Controllers\EmployeeLicensesController@destroy')
         ->name('employee_licenses.employee_license.destroy')->where('id', '[0-9]+');
});

