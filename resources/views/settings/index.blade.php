@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.settings') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                @include('flash::message')
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="card-body py-0">
                    @include("settings.setting_menu")
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ mix('assets/js/settings/settings.js') }}"></script>
@endpush
