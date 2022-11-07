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
            <h1>{{ __('messages.candidate.reported_candidates') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('candidate.reported_candidate.reported_candidates_table')
                </div>
            </div>
        </div>
        @include('candidate.reported_candidate.templates.templates')
        @include('candidate.reported_candidate.show_reported_candidate_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let reportedCandidatesUrl = "{{ route('reported.candidates') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/candidate/reported_candidates.js')}}"></script>
@endpush

