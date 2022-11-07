@extends('settings.index')
@section('title')
    {{ __('messages.setting.social_settings') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update']) }}
    <div class="row mt-3">
        <div class="form-group col-sm-6">
            {{ Form::label('facebook_url', __('messages.setting.facebook_url').':') }}<span
                    class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-facebook-f facebook-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('facebook_url', $setting['facebook_url'], ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('twitter_url', __('messages.setting.twitter_url').':') }}<span
                    class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-twitter twitter-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('twitter_url', $setting['twitter_url'], ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('google_plus_url', __('messages.setting.google_plus_url').':') }}<span
                    class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-google-plus-g google-plus-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('google_plus_url', $setting['google_plus_url'], ['class' => 'form-control', 'required']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('linkedIn_url', __('messages.setting.linkedIn_url').':') }}<span
                    class="text-danger">*</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('linkedIn_url', $setting['linkedIn_url'], ['class' => 'form-control', 'required']) }}
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
            {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary text-dark']) }}
        </div>
    </div>
    {{ Form::close() }}
@endsection
