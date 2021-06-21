@extends('layouts.app')
@section('pagetitle')
{{__('setting.Dashboard')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('setting.Home')}}</li>
@endsection
@section('content')
{{ Auth::user()->email }}
@endsection