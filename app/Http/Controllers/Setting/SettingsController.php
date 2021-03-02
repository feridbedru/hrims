<?php

namespace App\Http\Controllers\Setting;

use App\Models\AddressType;
use App\Models\AwardType;
use App\Models\Bank;
use App\Models\BankAccountType;
use App\Models\CertificationVendor;
use App\Models\CommitmentFor;
use App\Models\DisabilityType;
use App\Models\DisasterCause;
use App\Models\DisasterSeverity;
use App\Models\EducationalField;
use App\Models\EducationalInstitute;
use App\Models\EducationLevel;
use App\Models\EmployeeStatus;
use App\Models\ExperienceType;
use App\Models\GPAScale;
use App\Models\JobCategory;
use App\Models\JobTitleCategory;
use App\Models\JobType;
use App\Models\Language;
use App\Models\LanguageLevel;
use App\Models\LeftReason;
use App\Models\LicenseType;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\OrganizationLocation;
use App\Models\Region;
use App\Models\Relationship;
use App\Models\Religion;
use App\Models\Sex;
use App\Models\SkillCategory;
use App\Models\TemplateType;
use App\Models\Template;
use App\Models\Title;
use App\Models\Woreda;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $addressTypes = AddressType::count();
        $awardType = AwardType::count();
        $bank = Bank::count();
        $bankAccountType = BankAccountType::count();
        $certificationVendor = CertificationVendor::count();
        $commitmentFor = CommitmentFor::count();
        $disabilityType = DisabilityType::count();
        $disasterCause = DisasterCause::count();
        $disasterSeverity = DisasterSeverity::count();
        $educationalField = EducationalField::count();
        $educationalInstitute = EducationalInstitute::count();
        $educationLevel = EducationLevel::count();
        $title = Title::count();
        $employeeStatus = EmployeeStatus::count();
        $experienceType = ExperienceType::count();
        $gPAScale = GPAScale::count();
        $jobCategories = JobCategory::count();
        $jobTitleCategories = JobTitleCategory::count();
        $jobTypes = JobType::count();
        $languages = Language::count();
        $languageLevels = LanguageLevel::count();
        $leftReason = LeftReason::count();
        $licenseType = LicenseType::count();
        $maritalStatus = MaritalStatus::count();
        $nationality = Nationality::count();
        $organizationLocation = OrganizationLocation::count();
        $region = Region::count();
        $religion = Religion::count();
        $relationship = Relationship::count();
        $sex = Sex::count();
        $skillcategory = SkillCategory::count();
        $templateType = TemplateType::count();
        $template = Template::count();
        $woreda = Woreda::count();
        $zone = Zone::count();
        return view('settings.index',compact('addressTypes','awardType','bank','bankAccountType','certificationVendor','commitmentFor','disabilityType','disasterCause','disasterSeverity','educationalField','educationalInstitute','educationLevel','employeeStatus','experienceType','gPAScale','jobCategories','jobTitleCategories','jobTypes','languages','languageLevels','leftReason','licenseType','maritalStatus','nationality','organizationLocation','relationship','region','religion','sex','skillcategory','templateType','template','title','woreda','zone'));
    }
}
