<?php

namespace App\Containers\Customer\UI\WEB\Controllers\Desktop;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\core\Traits\HelpersTraits\OTPTrait;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Containers\Construction\Models\Construction;
use App\Containers\Customer\UI\WEB\Requests\UpdatePasswordRequest;
use App\Containers\Customer\UI\WEB\Requests\SendOtpCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\ShowDetailCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerAvatarRequest;
use App\Containers\Customer\UI\WEB\Requests\ToggleFollowCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerFronendRequest;
use App\Containers\Contractor\UI\WEB\Requests\FrontEnd\ShowProfileOwnerRequest;
use App\Containers\Construction\UI\WEB\Requests\Desktop\SearchConstructionsRequest;
use App\Containers\Contractor\Events\Events\ToggleFollowEvent;

// use App\Containers\Contractor\Events\Events\ToggleFollowEvent as EventsToggleFollowEvent;

/**
 * Class Controller
 *
 * @package App\Containers\Contractor\UI\WEB\Controllers
 */
class CustomerProfileController extends WebController
{
    use ApiResTrait, OTPTrait;

    public function __construct()
    {
        $this->numberBuilding = 1;
        parent::__construct();
    }
   
    public function showProfile(ShowProfileOwnerRequest $request){
        $currentCustomerAuth = auth('customer')->user();
        $allCities = Apiato::call('Location@GetAllCitiesAction', [false]);
        $allDistricts = Apiato::call('Location@GetDistrictByCityAction', [@$currentCustomerAuth->mainAddress->city_id ?? 0]);
        $allWards = Apiato::call('Location@GetWardByDistrictAction', [@$currentCustomerAuth->mainAddress->district_id ?? 0]);
        $orderBy = ['created_at' => 'desc','id' => 'desc'];
        if($request->order > 0 && isset(Construction::$orderClause[(int)$request->order])){
            $orderBy = Construction::$orderClause[(int)$request->order];
        } 
        $constructionTypes = Apiato::call('ConstructionType@GetConstructionTypesAction');
        $evaluationRates = Apiato::call('EvaluationRate@GetAllEvaluationRateAction');
        $constructions = Apiato::call('Construction@ConstructionsListingAction', [
            new DataTransporter(array_merge($request->all(), [
                'owner_id' => auth('customer')->id()
            ])), 
            $orderBy, 
            1, 
            ['medias','banners','videos','contractor','district','province','constructionType','rates','rates.evaluation_rate','suppliers']
        ]);
        $peopleFollowingMe = Apiato::call('Customer@GetPeopleFollowingMeAction', [
            $request,
            $currentCustomerAuth,
            [
                'customer.contractor',
                'customer.mainAddress'
            ]
        ]);
        $followerIds = $peopleFollowingMe->pluck('follower_id')->toArray();
        $totalFollowOfThoseFollower = Apiato::call('Customer@CountFollowersByCustomerIdsAction', [$followerIds]);
        return view('customer::'. $this->screen .'.profile', [
            'user' => $currentCustomerAuth,
            'allCities' => $allCities,
            'allDistricts' => $allDistricts,
            'allWards' => $allWards,
            'peopleFollowingMe' => $peopleFollowingMe,
            'totalFollowOfThoseFollower' => $totalFollowOfThoseFollower,
            'request' => $request,
            'orderClauseText' => Construction::orderClauseText(),
            'evaluationRates' => $evaluationRates,
            'constructionTypes' => $constructionTypes,
            'constructions' => $constructions,
            'type' => $request->type,
        ]);
    }

    public function updateProfile(UpdateCustomerFronendRequest $request){
        
        Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
            'id' => auth('customer')->id(),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_book' => $request->address_book
        ])]);
        if($request->ajax()){
            return $this->sendResponse([
                'success' => true
            ], 'Cập nhật thông tin thành công');
        }
        return redirect()->to(route('get_owner_profile_page'));
    }

    public function showDetailCustomer(string $slug, int $id, ShowDetailCustomerRequest $request){
        $customer = Apiato::call('Customer@FindCustomerByIdAction', [$id, ['mainAddress'], ['followMe', 'buildings']]);
        $partnerHasCooperated = Apiato::call('Customer@GetPartnersAction', [$id, ['name', 'id']]);
        $orderBy = ['created_at' => 'desc','id' => 'desc'];
        if($request->order > 0 && isset(Construction::$orderClause[(int)$request->order])){
            $orderBy = Construction::$orderClause[(int)$request->order];
        } 
        $constructionTypes = Apiato::call('ConstructionType@GetConstructionTypesAction');
        $evaluationRates = Apiato::call('EvaluationRate@GetAllEvaluationRateAction');
        $constructions = Apiato::call('Construction@ConstructionsListingAction', [
            $request, 
            $orderBy, 
            $this->numberBuilding, 
            ['medias','banners','videos','contractor','district','province','constructionType','rates','rates.evaluation_rate','suppliers']
        ]);

        return view("customer::{$this->screen}.detail", [
            'customer' => $customer,
            'request' => $request,
            'orderClauseText' => Construction::orderClauseText(),
            'evaluationRates' => $evaluationRates,
            'constructionTypes' => $constructionTypes,
            'constructions' => $constructions,
            'type' => $request->type,
            'partnerHasCooperated' => $partnerHasCooperated
        ]);
    }

    public function updateAvatar(UpdateCustomerAvatarRequest $request){
        $dataTransporter = new DataTransporter([
            'id' => auth('customer')->id()
        ]);
        $this->uploadImage($dataTransporter, $request, 'avatar', 'avatar_'.auth('customer')->id(), 'customer');
        Apiato::call('Customer@UpdateCustomerAction', [$dataTransporter]);
        return $this->sendResponse([
            'success' => true
        ], 'Cập nhật ảnh đại diện thành công');
    }

    public function changePassword(UpdatePasswordRequest $request){
        $currentCustomer = auth('customer')->user();
        if(Hash::check($request->password, $currentCustomer->password)){
            DB::beginTransaction();
            try{
                Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
                    'id' => auth('customer')->id(),
                    'password' => $request->password2
                ])]);
                DB::commit();
                return $this->sendResponse([
                    'success' => false
                ], 'Thay đổi mật khẩu thành công');
            }catch(\Exception $e){
                DB::rollBack();
                return $this->sendResponse([
                    'success' => false
                ], 'Thay đổi mật khẩu không thành công', 422);
            }
        }
        return $this->sendResponse([
            'success' => false
        ], 'Thay đổi mật khẩu không thành công', 422);
    }

    public function sendOtpCode(SendOtpCustomerRequest $request){

        $user = auth('customer')->user();
        $code = Str::random(config('authentication-container.otp.length'));
        $response = $this->sendOtp($user->otp_method, $code, $user->otp_method == 'email' ? $user->email : $user->phone);
        if($response){
            Apiato::call('Authentication@GenerateOTPCodeAction', [
                new DataTransporter([
                    'user_id' => auth('customer')->id(),
                    'otp_code' => $code
                ])
            ]);
            if($request->sendAgain){
                return $this->sendResponse([
                    'success' => true
                ], 'Mã OTP đã được gửi lại', 200);
            }
            return $this->sendResponse([
                'success' => true
            ], 'Nhập mã xác minh đã được chúng tôi gửi đến số ***123 để xác nhận yêu cầu thay đổi phương thức nhận mã xác minh', 200);
        }
        return $this->sendResponse([
            'success' => false
        ], 'Không thành công', 422);
    }

    public function checkCode(SendOtpCustomerRequest $request){

        $responseCheckCode = $this->checkOtpCode(request('otp_code', ''), auth('customer')->id());
        if($responseCheckCode){
            return $this->sendResponse([
                    'success' => true
            ], 'Mã OTP hợp lệ', 200);
        }
        return $this->sendResponse([
            'success' => false
        ], 'Mã OTP không đúng hoặc hết hạn', 200);
    }

    public function setOtpMethod(SendOtpCustomerRequest $request){

        $responseCheckCode = $this->checkOtpCode(request('otp_code', ''), auth('customer')->id());
        if($responseCheckCode){
            return $this->sendResponse([
                    'success' => true
            ], 'Mã OTP hợp lệ', 200);
        }
        return $this->sendResponse([
            'success' => true
        ], 'Mã OTP không đúng hoặc hết hạn', 200);
    }

    public function setupMethod(SendOtpCustomerRequest $request){
        DB::beginTransaction();
        try{
            Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
                'id' => auth('customer')->id(),
                'otp_method' => $request->otp_method
            ])]);
            DB::commit();
            return $this->sendResponse([
                'success' => true
            ], 'Thay đổi phương thức nhận mã xác mình thành công', 200);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->sendResponse([
                'success' => true
            ], 'Mã OTP hợp lệ', 200);
        }
    }

    public function ajaxOwnerList(SearchConstructionsRequest $request) {
        
        $orderBy = ['created_at' => 'desc','id' => 'desc'];
        if($request->order > 0 && isset(Construction::$orderClause[(int)$request->order])){
            $orderBy = Construction::$orderClause[(int)$request->order];
        }
        $constructions = Apiato::call('Construction@ConstructionsListingAction', [
            new DataTransporter([
                'owner_id' => auth('customer')->id()
            ]), 
            $orderBy, 
            $this->numberBuilding ,
            ['medias','banners','videos','contractor','district','province','constructionType','rates','rates.evaluation_rate','suppliers']
        ]);

        $evaluationRates = Apiato::call('EvaluationRate@GetAllEvaluationRateAction');
        $data = '';
        if ($constructions->isNotEmpty()) {
            foreach ($constructions as $construction) {
                $data .= view('construction::Desktop.components.owner_item', ['construction' => $construction,'evaluationRates'=>$evaluationRates]);
            }
        }
        return $this->sendResponse($data);
    }

    public function toggleFollow(ToggleFollowCustomerRequest $request){

        if($request->customerId == auth('customer')->id()){
            return $this->sendResponse([
                'success' => false,
            ],'Bạn không thể theo dõi chính mình' , 422);
        }

        $followedCustomer = Apiato::call('Customer@FindCustomerByIdAction', [
            $request->customerId
        ]);
        $request->request->add([
            'follower_id' => auth('customer')->id(),
            'customer_id' => $request->customerId,
        ]);
        $totalFollowValue = Apiato::call('Customer@ToggleFollowContractorAction', [
            $request,
        ]);
        /**
         * Push Notification
         */
        event(new ToggleFollowEvent($followedCustomer, $totalFollowValue));
        return $this->sendResponse($totalFollowValue, 'Thành công', 200);
    }
} 
// End class
