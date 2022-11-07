@extends('layouts.app')
@section('title')
    {{ __('messages.company.reported_companies') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.reported_employers') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('employer.companies.reported_companies_table')
                </div>
            </div>
        </div>
        @include('employer.companies.templates.templates')
        @include('employer.companies.show_reported_company_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let reportedCompaniesUrl = "{{ route('reported.companies') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/companies/front/reported_companies.js')}}"></script>
@endpush

