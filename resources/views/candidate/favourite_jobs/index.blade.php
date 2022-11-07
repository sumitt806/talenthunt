@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.favourite_jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.favourite_jobs') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('candidate.favourite_jobs.table')
                </div>
            </div>
        </div>
        @include('candidate.favourite_jobs.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let favouriteJobsUrl = "{{ route('favourite.jobs') }}";
        let jobDetailsUrl = "{{ route('front.job.details') }}";
        let statusArray = JSON.parse('@json($statusArray)');
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/candidate/favourite_jobs.js')}}"></script>
@endpush
