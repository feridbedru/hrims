@extends('layouts.app')
@section('pagetitle')
{{__('setting.Dashboard')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('setting.Dashboard')}}</li>
@endsection
@section('content')
<h2> Welcome {{ Auth::user()->email }} </h2>
@endsection