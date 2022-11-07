@extends('layouts.app')
@section('title')
    {{ __('messages.jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.jobs') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="row justify-content-end">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                        <div class="card-header-action ">
                            {{  Form::select('is_featured', $featured, null, ['id' => 'filter_featured', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Featured Job']) }}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 mt-3 mt-md-0">
                        <div class="card-header-action w-100">
                            {{  Form::select('is_suspended', $suspended, null, ['id' => 'filter_suspended', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Suspended Job']) }}
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 ml-4 mt-md-1 pr-0 jobAddBtn">
                        <a href="{{ route('admin.job.create') }}"
                           class="btn btn-primary form-btn">{{ __('messages.common.add') }}
                            <i class="fas fa-plus"></i></a>
                    </div>
                </div>


            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('jobs.table')
                </div>
            </div>
        </div>
        @include('jobs.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let jobsUrl = "{{ route('admin.jobs.index') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/jobs/job_datatable_admin.js')}}"></script>
@endpush

