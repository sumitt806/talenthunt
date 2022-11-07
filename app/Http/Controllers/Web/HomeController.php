<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ContactFormRequest;
use App\Repositories\WebHomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class HomeController extends AppBaseController
{
    /** @var  WebHomeRepository */
    private $webHomeRepository;

    public function __construct(WebHomeRepository $webHomeRepository)
    {
        $this->webHomeRepository = $webHomeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $data['testimonials'] = $this->webHomeRepository->getTestimonials();
        $data['dataCounts'] = $this->webHomeRepository->getDataCounts();
        $data['latestJobs'] = $this->webHomeRepository->getLatestJobs();
        $data['categories'] = $this->webHomeRepository->getCategories();
        $data['jobCategories'] = $this->webHomeRepository->getAllJobCategories();
        $data['featuredCompanies'] = $this->webHomeRepository->getFeaturedCompanies();
        $data['featuredJobs'] = $this->webHomeRepository->getFeaturedJobs();
        $data['notices'] = $this->webHomeRepository->getNotices();

        return view('web.home.home')->with($data);
    }

    /**
     * @param  ContactFormRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function sendContactEmail(ContactFormRequest $request)
    {
        $inquiry = $this->webHomeRepository->storeInquires($request->all());
        Flash::success('Thank you for contacting us.');

        return redirect(route('front.contact'));
    }
}
