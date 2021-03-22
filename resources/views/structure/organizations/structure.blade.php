@extends('layouts.app')
@section('pagetitle')
    Structure
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('organizations') }}">Organization</a></li>
    <li class="breadcrumb-item active">Structure</li>
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/orgChart/orgChart.css') }}">
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">Organization Structure</h4>
        </div>
        <div class="card-body">
            <ol class="organizational-chart">
                @foreach ($roots as $root)
                    <li>
                        <div>
                            {{ $root->en_name }}
                        </div>
                        <ol id="second">
                            @foreach ($seconds as $second)
                                @if ($second->parent == $root->id)
                                    <li>
                                        <div>
                                            {{ $second->en_name }}
                                        </div>
                                        <ol id="third">
                                            @foreach ($units as $unit)
                                                @if ($unit->parent == $second->id)
                                                    <li>
                                                        <div>
                                                            {{ $unit->en_name }}
                                                        </div>
                                                    </li>
                                                    <ol id="fourth">
                                                        @foreach ($teams as $team)
                                                            @if ($team->reports_to == $unit->id)
                                                                <li>
                                                                    <div>
                                                                        {{ $team->en_name }}
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
