@extends('layouts.app')
@section('title')
    {{ __('messages.salary_currencies') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.salary_currencies') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addSalaryCurrencyModal">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('salary_currencies.table')
                </div>
            </div>
        </div>
        @include('salary_currencies.templates.templates')
        @include('salary_currencies.add_modal')
        @include('salary_currencies.edit_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let salaryCurrencyUrl = "{{ route('salaryCurrency.index') }}/";
        let salaryCurrencySaveUrl = "{{ route('salaryCurrency.store') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/salary_currencies/salary_currencies.js')}}"></script>
@endpush
