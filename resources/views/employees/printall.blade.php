@extends('layouts.printer')
@section('pagetitle')
    {{ __('emplyee.Employee All Information') }}
@endsection
@section('content')
@permission('employee_printall')
    @if (count($employeeAdditionalInfos) == 0)
        <h4 class="text-center">{{ __('employee.No Additional Infos Available') }}.</h4>
    @else
        <h3>{{ __('employee.Basic Information') }}</h3>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('employee.Number') }}</th>
                    <th>{{ __('employee.Place Of Birth') }}</th>
                    <th>{{ __('employee.Other Phone Number') }}</th>
                    <th>{{ __('employee.Nationality') }}</th>
                    <th>{{ __('employee.Religions') }}</th>
                    <th>{{ __('employee.Blood Group') }}</th>
                    <th>{{ __('employee.Tin Number') }}</th>
                    <th>{{ __('employee.Pension') }}</th>
                    <th>{{ __('employee.MaritalStatus') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAdditionalInfos as $employeeAdditionalInfo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAdditionalInfo->place_of_birth }}</td>
                        <td>{{ $employeeAdditionalInfo->other_phone_number }}</td>
                        <td>{{ optional($employeeAdditionalInfo->nationality)->name }}</td>
                        <td>{{ optional($employeeAdditionalInfo->religion)->name }}</td>
                        <td>{{ $employeeAdditionalInfo->blood_group }}</td>
                        <td>{{ $employeeAdditionalInfo->tin_number }}</td>
                        <td>{{ $employeeAdditionalInfo->pension }}</td>
                        <td>{{ optional($employeeAdditionalInfo->maritalStatus)->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeAddresses) == 0)
        <h4 class="text-center">{{ __('employee.No Address Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.AddressType') }}</th>
                    <th>{{ __('setting.Address') }}</th>
                    <th>{{ __('employee.House Number') }}</th>
                    <th>{{ __('employee.Heirarchichal Address') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAddresses as $employeeAddress)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAddress->types->name }}</td>
                        <td>{{ $employeeAddress->address }}</td>
                        <td>{{ $employeeAddress->house_number }}</td>
                        <td> {{ optional($employeeAddress->woredas)->name }},
                            @foreach ($zones as $zone)
                                @if (optional($employeeAddress->woredas)->zone == $zone->id)
                                    {{ $zone->name }},
                                    @foreach ($regions as $region)
                                        @if ($zone->id == $region->id)
                                            {{ $region->name }}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if ($employeeAddress->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeAddress->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeAdministrativePunishments) == 0)
    <h4 class="text-center">{{(_('employee.No Administrative Punishments Available'))}}.</h4>
@else
    <table class="table table-striped ">
        <thead>
            <tr>
                <th>{{(__('setting.Number'))}}</th>
                <th>{{(__('employee.Organization Name'))}}</th>
                <th>{{(__('employee.Reason'))}}</th>
                <th>{{(__('employee.Decision'))}}</th>
                <th>{{(__('employee.Start Date'))}}/th>
                <th>{{(__('employee.End Date'))}}</th>
                <th>{{(__('employee.File'))}}</th>
                <th>{{(__('employee.Status'))}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employeeAdministrativePunishments as $employeeAdministrativePunishment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employeeAdministrativePunishment->organization_name }}</td>
                    <td>{{ $employeeAdministrativePunishment->reason }}</td>
                    <td>{{ $employeeAdministrativePunishment->decision }}</td>
                    <td>{{ $employeeAdministrativePunishment->start_date }}</td>
                    <td>{{ $employeeAdministrativePunishment->end_date }}</td>
                    <td>
                        @if ($employeeAdministrativePunishment->status == 1)
                        {{(__('employee.Active'))}}
                        @else
                        {{(__('employee.Closed'))}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<hr>
@if (count($employeeAwards) == 0)
        <h4 class="text-center">{{(__('employee.No Awards Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{__('setting.Organization')}}</th>
                    <th>{{__('setting.AwardType')}}</th>
                    <th>{{(__('employee.Awarded On'))}}</th>
                    <th>{{(__('employee.Description'))}}</th>
                    <th>{{(__('employee.Status'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAwards as $employeeAward)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAward->organization }}</td>
                        <td>{{ $employeeAward->types->name }}</td>
                        <td>{{ $employeeAward->awarded_on }}</td>
                        <td>{{ $employeeAward->description }}</td>
                        <td>
                            @if ($employeeAward->status == 1)
                            {{(__('employee.Pending'))}}
                            @elseif($employeeAward->status == 2)
                            {{(__('employee.Rejected'))}}
                            @else
                            {{(__('employee.Approved'))}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeBankAccounts) == 0)
        <h4 class="text-center">{{(__('employee.No Bank Accounts Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Banks') }}</th>
                    <th>{{ __('setting.BankAccountType') }}</th>
                    <th>{{ __('employee.Account Number') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeBankAccounts as $employeeBankAccount)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeBankAccount->banks->name }}</td>
                        <td>{{ $employeeBankAccount->types->name }}</td>
                        <td>{{ $employeeBankAccount->account_number }}</td>
                        <td>
                            @if ($employeeBankAccount->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeBankAccount->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeCertifications) == 0)
        <h4 class="text-center">{{ __('setting.No Certifications Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('employee.Issued On') }}</th>
                    <th>{{ __('employee.Skill Category') }}</th>
                    <th>{{ __('setting.CertificationVendors') }}</th>
                    <th>{{ __('employee.Link') }}</th>
                    <th>{{ __('employee.Expires On') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeCertifications as $employeeCertification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeCertification->name }}</td>
                        <td>{{ $employeeCertification->issued_on }}</td>
                        <td>{{ $employeeCertification->categories->name }}</td>
                        <td>{{ optional($employeeCertification->vendors)->name }}</td>
                        <td>{{ $employeeCertification->verification_link }}</td>
                        <td>{{ $employeeCertification->expires_on }}</td>
                        <td>
                            @if ($employeeCertification->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeCertification->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeDisabilities) == 0)
        <h4 class="text-center">{{(__('employee.No Disabilities Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Type') }}</th>
                    <th>{{ __('setting.Description') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeDisabilities as $employeeDisability)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeDisability->types->name }}</td>
                        <td>{{ $employeeDisability->description }}</td>
                        <td>
                            @if ($employeeDisability->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeDisability->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeDisasters) == 0)
        <h4 class="text-center">{{(__('employee.No Disaster Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Occured On'))}}</th>
                    <th>{{(__('employee.Disaster Cause'))}}</th>
                    <th>{{(__('employee.Disaster Severity'))}}</th>
                    <th>{{(__('setting.Description'))}}</th>
                    <th>{{(__('employee.Status'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeDisasters as $employeeDisaster)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeDisaster->occured_on }}</td>
                        <td>{{ $employeeDisaster->causes->name }}</td>
                        <td>{{ $employeeDisaster->severities->name }}</td>
                        <td>{{ $employeeDisaster->description }}</td>
                        <td>{{ $employeeDisaster->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeEducations) == 0)
        <h4 class="text-center">{{(__('employee.No Educations Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Level') }}</th>
                    <th>{{ __('employee.Institute') }}</th>
                    <th>{{ __('employee.Field') }}</th>
                    <th>{{ __('employee.GPA') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeEducations as $employeeEducation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeEducation->levels->name }}</td>
                        <td>{{ $employeeEducation->institutes->name }}</td>
                        <td>{{ $employeeEducation->fields->name }}</td>
                        <td>{{ $employeeEducation->gpa }} / {{ optional($employeeEducation->gpaScales)->name }}
                        </td>
                        <td>{{ $employeeEducation->start_date }}</td>
                        <td>{{ $employeeEducation->end_date }}</td>
                        <td>
                            @if ($employeeEducation->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeEducation->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeEmergencies) == 0)
        <h4 class="text-center">{{ __('employee.No Emergencies Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('setting.PhoneNumber') }}</th>
                    <th>{{ __('setting.Relationship') }}</th>
                    <th>{{ __('setting.Address') }}</th>
                    <th>{{ __('employee.House Number') }}</th>
                    <th>{{ __('employee.Other Phone') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeEmergencies as $employeeEmergency)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeEmergency->name }}</td>
                        <td>{{ $employeeEmergency->phone_number }}</td>
                        <td>{{ $employeeEmergency->relationships->name }}</td>
                        <td>{{ $employeeEmergency->address }}</td>
                        <td>{{ $employeeEmergency->house_number }}</td>
                        <td>{{ $employeeEmergency->other_phone }}</td>
                        <td>
                            @if ($employeeEmergency->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeEmergency->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeExperiences) == 0)
        <h4 class="text-center">{{(__('employee.No Experiences Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('employee.Type') }}</th>
                    <th>{{ __('employee.Organization Name') }}</th>
                    <th>{{ __('employee.Job Position') }}</th>
                    <th>{{ __('employee.Level') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Salary') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeExperiences as $employeeExperience)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeExperience->types->name }}</td>
                        <td>{{ $employeeExperience->organization_name }}</td>
                        <td>{{ $employeeExperience->job_position }}</td>
                        <td>{{ $employeeExperience->level }}</td>
                        <td>{{ $employeeExperience->start_date }}</td>
                        <td>{{ $employeeExperience->end_date }}</td>
                        <td>{{ $employeeExperience->salary }}</td>
                        <td>
                            @if ($employeeExperience->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeExperience->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeFamilies) == 0)
        <h4 class="text-center">{{ __('employee.No Families Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('employee.Sex') }}</th>
                    <th>{{ __('setting.Relationships') }}</th>
                    <th>{{ __('employee.Date Of Birth') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeFamilies as $employeeFamily)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeFamily->name }}</td>
                        <td>{{ $employeeFamily->sexes->name }}</td>
                        <td>{{ $employeeFamily->relationships->name }}</td>
                        <td>{{ $employeeFamily->date_of_birth }}</td>
                        <td>
                            @if ($employeeFamily->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeFamily->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeFiles) == 0)
        <h4 class="text-center">{{(__('employee.No Files Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Title'))}}</th>
                    <th>{{(__('setting.Description'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeFiles as $employeeFile)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeFile->title }}</td>
                        <td>{{ $employeeFile->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeJudiciaryPunishments) == 0)
        <h4 class="text-center">{{ __('employee.No Judiciary Punishments Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('employee.Court Name') }}</th>
                    <th>{{ __('employee.Reason') }}</th>
                    <th>{{ __('employee.Punishment Type') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeJudiciaryPunishments as $employeeJudiciaryPunishment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeJudiciaryPunishment->court_name }}</td>
                        <td>{{ $employeeJudiciaryPunishment->reason }}</td>
                        <td>{{ $employeeJudiciaryPunishment->punishment_type }}</td>
                        <td>{{ $employeeJudiciaryPunishment->start_date }}</td>
                        <td>{{ $employeeJudiciaryPunishment->end_date }}</td>
                        <td>
                            @if ($employeeJudiciaryPunishment->status == 1)
                                {{ __('setting.Active') }}
                            @else
                                {{ __('setting.Closed') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @if (count($employeeLanguages) == 0)
        <h4 class="text-center">{{(__('employee.No Languages Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Languages'))}}</th>
                    <th>{{(__('employee.Reading'))}}</th>
                    <th>{{(__('employee.Writing'))}}</th>
                    <th>{{(__('employee.Listening'))}}</th>
                    <th>{{(__('employee.Speaking'))}}</th>
                    <th>{{(__('employee.Is Prefered'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeLanguages as $employeeLanguage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeLanguage->languages->name }}</td>
                        <td>{{ $employeeLanguage->readings->name }}</td>
                        <td>{{ $employeeLanguage->writings->name }}</td>
                        <td>{{ $employeeLanguage->listenings->name }}</td>
                        <td>{{ $employeeLanguage->speakings->name }}</td>
                        <td>{{ $employeeLanguage->is_prefered ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeLicenses) == 0)
        <h4 class="text-center">{{ __('employee.No Licenses Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Title') }}</th>
                    <th>{{ __('employee.License Type') }}</th>
                    <th>{{ __('employee.Issuing Organization') }}</th>
                    <th>{{ __('employee.Issuing Expiry Date') }}</th>
                    <th>{{ __('employee.Issuing Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeLicenses as $employeeLicense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeLicense->title }}</td>
                        <td>{{ $employeeLicense->types->name }}</td>
                        <td>{{ $employeeLicense->issuing_organization }}</td>
                        <td>{{ $employeeLicense->expiry_date }}</td>
                        <td>
                            @if ($employeeLicense->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeLicense->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if (count($employeeStudyTrainings) == 0)
        <h4 class="text-center">{{(__('employee.No Study Trainings Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('setting.Type'))}}</th>
                    <th>{{(__('employee.Institution'))}}</th>
                    <th>{{(__('setting.Level'))}}</th>
                    <th>{{(__('employee.Field'))}}</th>
                    <th>{{(__('employee.Has Commitment'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeStudyTrainings as $employeeStudyTraining)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeStudyTraining->types->name }}</td>
                        <td>{{ $employeeStudyTraining->institutions->name }}</td>
                        <td>{{ $employeeStudyTraining->levels->name }}</td>
                        <td>{{ $employeeStudyTraining->fields->name }}</td>
                        <td>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}
                            @if ($employeeStudyTraining->has_commitment == 1)
                                @if (isset($employeeStudyTraining->amount))
                                {{(__('employee.Br'))}}. {{ $employeeStudyTraining->amount }}
                                @endif
                                @if (isset($employeeStudyTraining->total_commitment))
                                    {{ $employeeStudyTraining->total_commitment }} {{(__('employee.Months'))}}
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
