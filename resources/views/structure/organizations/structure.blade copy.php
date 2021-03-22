@extends('layouts.app')
@section('pagetitle')
    Structure
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('organizations') }}">Organization</a></li>
    <li class="breadcrumb-item active">Structure</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">Organization Structure</h4>
        </div>
        <div class="card-body">
            @foreach ($roots as $root)
                <b>{{ $root->en_name }}</b><br>
                @foreach ($seconds as $second)
                    @if ($second->parent == $root->id)
                        &emsp; <b>{{ $second->en_name }}</b><br>
                        @foreach ($units as $unit)
                            @if ($unit->parent == $second->id)
                            &emsp; &emsp; <b> {{ $unit->en_name }} </b> <br>
                            @foreach ($teams as $team)
                                @if($team->reports_to == $unit->id)
                                &emsp; &emsp; &emsp; &emsp; <b>  {{ $team->en_name }} </b><br>
                                @endif
                            @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>
    </div> 
@endsection
