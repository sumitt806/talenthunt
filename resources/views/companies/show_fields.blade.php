<div class="row details-page">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.company.employer_name').':') }}
        <p>{{ $company->user->first_name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('email', __('messages.company.email').':') }}
        <p>{{ $company->user->email }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('phone', __('messages.user.phone').':') }}
        <p>{{ !empty($company->user->phone) ? $company->user->phone:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('ceo', __('messages.company.employer_ceo').':') }}
        <p>{{ $company->ceo }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('industry_id', __('messages.company.industry').':') }}
        <p>{{ $company->industry->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('ownership_type_id', __('messages.company.ownership_type').':') }}
        <p>{{ $company->ownerShipType->name }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('company_size_id', __('messages.company.company_size').':') }}
            <p>{{ $company->companySize->size }}</p>
        </div>
        <div class="form-group col-xl-12 col-md-12 col-sm-12">
            {{ Form::label('details', __('messages.company.employer_details').':') }}
            <p class="m-0">{!!   isset($company->details) ? nl2br($company->details) : __('messages.common.n/a') !!}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('established_in', __('messages.company.established_in').':') }}
            <p>{{ $company->established_in }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('location', __('messages.company.location').':') }}
            <p>{{ $company->location }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('country', __('messages.company.country').':') }}
            <p>{{ !empty($company->user->country_id) ?$company->user->country_name:__('messages.common.n/a') }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('state', __('messages.company.state').':') }}
            <p>{{ !empty($company->user->state_id) ?$company->user->state_name:__('messages.common.n/a') }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('city', __('messages.company.city').':') }}
            <p>{{ !empty($company->user->city_id) ? $company->user->city_name:__('messages.common.n/a') }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('no_of_offices', __('messages.company.no_of_offices').':') }}
            <p>{{ $company->no_of_offices!=null ?$company->no_of_offices:__('messages.common.n/a') }}</p>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('fax', __('messages.company.fax').':') }}
            <p>{{ $company->fax!=null ?$company->fax:__('messages.common.n/a') }}</p>
        </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('website', __('messages.company.website').':') }}
        <p>{{ $company->website }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('is_active', __('messages.common.status').':') }}
        <p>{{ $company->user->is_active == 1 ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('is_featured', __('messages.company.is_featured').':') }}
        <p>{{ ($company->activeFeatured)  ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('facebook_url', __('messages.company.facebook_url').':') }}
        <p>{{ $company->user->facebook_url!=null?$company->user->facebook_url:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('twitter_url', __('messages.company.twitter_url').':') }}
        <p>{{ $company->user->twitter_url!=null ?$company->user->twitter_url:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('linkedin_url', __('messages.company.linkedin_url').':') }}
        <p>{{ $company->user->linkedin_url!=null ?$company->user->linkedin_url:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('google_plus_url', __('messages.company.google_plus_url').':') }}
        <p>{{ $company->user->google_plus_url!=null ?$company->user->google_plus_url:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('pinterest_url', __('messages.company.pinterest_url').':') }}
        <p>{{ $company->user->pinterest_url!=null ? $company->user->pinterest_url:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.common.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($company->created_at)) }}">{{ $company->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.common.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($company->updated_at)) }}">{{ $company->updated_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-sm-12 col-md-12 col-xl-6">
        {{ Form::label('company_logo', __('messages.company.company_logo').':') }}
        <img id='logoPreview' class="thumbnail-preview w-25"
             src="{{ (!empty($company->user->media[0])) ? $company->user->media[0]->getFullUrl() : asset('assets/img/infyom-logo.png') }}">
    </div>
</div>
