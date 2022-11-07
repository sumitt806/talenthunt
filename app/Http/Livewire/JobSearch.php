<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class JobSearch extends Component
{
    use WithPagination;

    public $searchByLocation = '', $types = [], $category = '', $salaryFrom = '', $salaryTo = '', $title = '',
        $skill = '', $gender = '', $careerLevel = '', $functionalArea = '', $company = '';

    protected $listeners = ['changeFilter', 'resetFilter'];

    public function paginationView()
    {
        return 'livewire.custom-pagenation';
    }

    public function mount(Request $request)
    {
        if (! empty($request->get('categories'))) {
            $this->category = $request->get('categories');
        }
        if (! empty($request->get('company'))) {
            $this->company = $request->get('company');
        }
    }

    public function nextPage($lastPage)
    {
        if ($this->page < $lastPage) {
            $this->page = $this->page + 1;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function updatingSearchByLocation()
    {
        $this->resetPage();
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    public function resetFilter()
    {
        $this->reset();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $jobs = $this->searchJobs();

        return view('livewire.job-search', compact('jobs'));
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchJobs()
    {
        /** @var Job $query */
        $query = Job::with(['company', 'country', 'state', 'city', 'jobShift'])
            ->whereStatus(Job::STATUS_OPEN);

        $query->when(! empty($this->searchByLocation), function (Builder $q) {
            $q->where('job_title', 'like', '%'.$this->searchByLocation.'%')
                ->orWhereHas('country', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->searchByLocation.'%');
                })
                ->orWhereHas('state', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->searchByLocation.'%');
                })
                ->orWhereHas('city', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->searchByLocation.'%');
                });
        });

        $query->when(! empty($this->title), function (Builder $q) {
            $q->where('job_title', 'like', '%'.$this->title.'%');
        });

        $query->when(! empty($this->types), function (Builder $q) {
            $q->whereIn('job_type_id', $this->types);
        });

        $query->when(! empty($this->category), function (Builder $q) {
            $q->where('job_category_id', '=', $this->category);
        });

        $query->when(! empty($this->salaryFrom), function (Builder $q) {
            $q->where('salary_from', '>=', $this->salaryFrom);
        });

        $query->when(! empty($this->salaryTo), function (Builder $q) {
            $q->where('salary_to', '<=', $this->salaryTo);
        });

        $query->when(! empty($this->careerLevel), function (Builder $q) {
            $q->where('career_level_id', '=', $this->careerLevel);
        });

        $query->when(! empty($this->functionalArea), function (Builder $q) {
            $q->where('functional_area_id', '=', $this->functionalArea);
        });

        $query->when($this->gender != '', function (Builder $q) {
            $q->where('no_preference', '=', $this->gender);
        });

        $query->when(! empty($this->skill), function (Builder $q) {
            $q->whereHas('jobsSkill', function (Builder $q) {
                $q->where('skill_id', '=', $this->skill);
            });
        });
        $query->when(! empty($this->company), function (Builder $q) {
            $q->whereHas('company', function (Builder $q) {
                $q->where('company_id', '=', $this->company);
            });
        });

        return $query->paginate(10);
    }
}
