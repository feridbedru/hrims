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
    Route::delete('/job_category/{jobCategory}','App\Http\Controllers\Setting\JobCategoriesController@destroy')
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
    Route::delete('/job_title_category/{jobTitleCategory}','App\Http\Controllers\Setting\JobTitleCategoriesController@destroy')
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
    Route::get('/show/{region}','App\Http\Controllers\Setting\RegionsController@show')
         ->name('regions.region.show')->where('id', '[0-9]+');
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
