<?php

namespace App\Repositories;

use App\Mail\ContactEmail;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Inquiry;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Noticeboard;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class WebHomeRepository
 * @package App\Repositories
 * @version July 7, 2020, 5:07 am UTC
 */
class WebHomeRepository
{
    /**
     * @return mixed
     */
    public function getTestimonials()
    {
        return Testimonial::with('media')->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getDataCounts()
    {
        $data['candidates'] = Candidate::count();
        $data['jobs'] = Job::status(Job::STATUS_OPEN)->count();
        $data['resumes'] = Media::where('model_type', Candidate::class)->where('collection_name',
            Candidate::RESUME_PATH)->count();
        $data['companies'] = Company::count();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getLatestJobs()
    {
        return Job::with(['company', 'jobCategory', 'activeFeatured'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->append('full_location');
    }

    /**
     * @return JobCategory[]|Builder[]|Collection
     */
    public function getCategories()
    {
        $categories = JobCategory::whereIsFeatured(1)
            ->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->toBase()
            ->take(8)
            ->get();

        return $categories;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllJobCategories()
    {
        return JobCategory::pluck('name', 'id');
    }

    /**
     * @return Company[]|Builder[]|Collection
     */
    public function getFeaturedCompanies()
    {
        return Company::has('activeFeatured')
            ->with(['jobs', 'activeFeatured'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return Job[]|Builder[]|Collection
     */
    public function getFeaturedJobs()
    {
        return Job::has('activeFeatured')
            ->with(['company', 'jobCategory'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return Noticeboard[]|Builder[]|Collection
     */
    public function getNotices()
    {
        return Noticeboard::whereIsActive(true)->get();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function storeInquires($input)
    {
        /** @var Inquiry $inquiry */
        $inquiry = Inquiry::create($input);
        Mail::to($input['email'])->send(new ContactEmail($inquiry));

        return true;
    }
}
