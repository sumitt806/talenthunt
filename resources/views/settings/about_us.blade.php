@extends('settings.index')
@section('title')
    {{ __('messages.setting.about_us') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update']) }}
    <div class="row mt-3">
        <div class="form-group col-sm-12 my-0">
            {{ Form::label('about_us', __('messages.about_us').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('about_us', $setting['about_us'], ['class' => 'form-control h-75', 'required']) }}
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
            {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary text-dark']) }}
        </div>
    </div>
    {{ Form::close() }}
@endsection
