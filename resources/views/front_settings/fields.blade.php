<div class="row">
    <div class="form-group col-md-3 col-sm-12">
        <label>{{ __('messages.front_settings.featured_jobs_enable') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="featured_jobs_enable" class="custom-switch-input"
                    {{ ($frontSettings['featured_jobs_enable'] == 1) ? 'checked' : '' }} >
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_jobs_price', __('messages.front_settings.featured_jobs_price').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_jobs_price', $frontSettings['featured_jobs_price'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_jobs_days', __('messages.front_settings.featured_jobs_due_days').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_jobs_days', $frontSettings['featured_jobs_days'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_jobs_quota', __('messages.front_settings.featured_jobs_quota').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_jobs_quota', $frontSettings['featured_jobs_quota'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>

    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.front_settings.featured_companies_enable') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="featured_companies_enable" class="custom-switch-input"
                    {{ ($frontSettings['featured_companies_enable'] == 1) ? 'checked' : '' }}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_companies_price', __('messages.front_settings.featured_companies_price').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_companies_price', $frontSettings['featured_companies_price'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_companies_days', __('messages.front_settings.featured_companies_due_days').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_companies_days', $frontSettings['featured_companies_days'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        {{ Form::label('featured_companies_quota', __('messages.front_settings.featured_companies_quota').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('featured_companies_quota', $frontSettings['featured_companies_quota'], ['class' => 'form-control salary', 'required','min' => 0]) }}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','name' => 'save', 'id' => 'saveJob']) }}
        <a href="{{ route('front.settings.index') }}" class="btn btn-secondary">{{__('messages.common.cancel')}}</a>
    </div>

</div>
