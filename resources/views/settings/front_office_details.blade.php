@extends('settings.index')
@section('title')
    {{ __('messages.setting.front_settings') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update']) }}
    <div class="row mt-3">
        <div class="form-group col-sm-12 my-0">
            {{ Form::label('address', __('messages.setting.address').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('address', $setting['address'], ['class' => 'form-control h-75', 'required']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('phone', __('messages.setting.phone').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('phone', $setting['phone'], ['class' => 'form-control','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")' ,'required','minlength=10','maxlength=10']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('email', __('messages.setting.email').':') }}<span
                    class="text-danger">*</span>
            {{ Form::email('email', $setting['email'], ['class' => 'form-control', 'required']) }}
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
