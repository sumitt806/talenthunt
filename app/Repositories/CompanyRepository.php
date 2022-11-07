<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\CompanySize;
use App\Models\FavouriteCompany;
use App\Models\Industry;
use App\Models\Job;
use App\Models\OwnerShipType;
use App\Models\ReportedToCompany;
use App\Models\User;
use Arr;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

/**
 * Class CompanyRepository
 * @package App\Repositories
 * @version June 22, 2020, 12:34 pm UTC
 */
class CompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ceo',
        'established_in',
        'website',
        'is_active',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Company::class;
    }

    /**
     * @return mixed
     */
    public function prepareData()
    {
        $countries = new Countries();
        $data['industries'] = Industry::pluck('name', 'id');
        $data['ownerShipTypes'] = OwnerShipType::pluck('name', 'id');
        $data['companySize'] = CompanySize::pluck('size', 'id');
        $data['countries'] = getCountries();

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            $input['unique_id'] = getUniqueCompanyId();
            $company = $this->create(Arr::only($input, (new Company())->getFillable()));

            // Create User
            $input['password'] = Hash::make($input['password']);
            $input['first_name'] = $input['name'];
            $input['owner_id'] = $company->id;
            $input['owner_type'] = Company::class;
            $input['is_verified'] = isset($input['is_verified']) ? 1 : 0;
            $userInput = Arr::only($input,
                [
                    'first_name', 'email', 'phone', 'password', 'owner_id', 'owner_type', 'country_id', 'state_id',
                    'city_id', 'is_active', 'dob', 'gender',
                    'facebook_url', 'twitter_url', 'linkedin_url', 'google_plus_url', 'pinterest_url', 'is_verified',
                ]);

            /** @var User $user */
            $user = User::create($userInput);
            $companyRole = Role::whereName('Employer')->first();
            $user->assignRole($companyRole);
            $company->update(['user_id' => $user->id]);

            if ((isset($input['image']))) {
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            /** @var SubscriptionRepository $subscriptionRepo */
            $subscriptionRepo = app(SubscriptionRepository::class);
            $subscriptionRepo->createStripeCustomer($user);

            if ($user->is_verified) {
                $user->update(['email_verified_at' => Carbon::now()]);
            } else {
                $user->sendEmailVerificationNotification();
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  Company  $company
     *
     * @throws Throwable
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($input, $company)
    {
        try {
            DB::beginTransaction();


            $company->update($input);


            $input['first_name'] = $input['name'];
            $userInput = Arr::only($input,
                [
                    'first_name', 'email', 'phone', 'password', 'country_id', 'state_id', 'city_id', 'is_active',
                    'facebook_url', 'twitter_url', 'linkedin_url', 'google_plus_url', 'pinterest_url',
                ]);
            /** @var User $user */
            $user = $company->user;
            $user->update($userInput);

            if ((isset($input['image']))) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function isCompanyAddedToFavourite($companyId)
    {
        return FavouriteCompany::where('user_id', Auth::id())
            ->where('company_id', $companyId)
            ->exists();
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function isReportedToCompany($companyId)
    {
        return ReportedToCompany::where('user_id', Auth::id())
            ->where('company_id', $companyId)
            ->exists();
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function getCompanyDetail($companyId)
    {
        $data['companyDetail'] = Company::with('user')->findOrFail($companyId);
        $data['jobDetails'] = Job::with('jobShift', 'company', 'jobCategory')->where('company_id', $companyId)->get();
        $data['isCompanyAddedToFavourite'] = $this->isCompanyAddedToFavourite($companyId);
        $data['isReportedToCompany'] = $this->isReportedToCompany($companyId);

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function storeFavouriteJobs($input)
    {
        $favouriteJob = FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->exists();
        if (! $favouriteJob) {
            FavouriteCompany::create([
                'user_id'    => $input['userId'],
                'company_id' => $input['companyId'],
            ]);

            return true;
        }

        FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->delete();

        return false;
    }

    /**
     * @param  array  $input
     *
     *
     * @return bool
     */
    public function storeReportToCompany($input)
    {
        $jobReportedAsAbuse = ReportedToCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->exists();

        if (! $jobReportedAsAbuse) {
            ReportedToCompany::create([
                'user_id'    => $input['userId'],
                'company_id' => $input['companyId'],
                'note'       => $input['note'],
            ]);

            return true;
        }

        FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->delete();

        return true;
    }
}
