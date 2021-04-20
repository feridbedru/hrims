@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewTitle'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">{{(__('setting.Setting'))}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('titles.title.index') }}">{{(__('setting.Titles'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewTitle'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('titles.title.store') }}" accept-charset="UTF-8" id="create_title_form"
                name="create_title_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.titles.form', [
                'title' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('titles.title.index') }}" class="btn btn-warning mr-5" title="Show All Title">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(function () {
      $('#create_title_form').validate({
        rules: {
          en_title: {
            required: true,
            minlength: 2,
          },
          am_title: {
            required: true,
            minlength: 2
          },
        },
        messages: {
          en_title: {
            required: "Please enter a valid english title",
            minlength: "Your title must be at least 2 characters long"
          },
          am_title: {
            required: "Please enter a valid amharic title",
            minlength: "Your title must be at least 2 characters long"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>  
@endsection