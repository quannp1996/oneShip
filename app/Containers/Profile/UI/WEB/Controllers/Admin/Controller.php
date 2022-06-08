<?php 
namespace App\Containers\Profile\UI\WEB\Controllers\Admin;

use App\Containers\Profile\UI\WEB\Requests\UpdateProfileRequest;
use App\Ship\Parents\Controllers\AdminController;
use Apiato\Core\Foundation\Facades\ImageURL;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;
use Exception;
use Illuminate\Support\Facades\Auth;

class Controller extends AdminController{

    public function __construct()
    {
        $this->title = 'Cập nhật thông tin';
        parent::__construct();    
    }
     /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $avatar = ImageURL::getImageUrl($user->avatar, 'avatar', 'small');
        return view('profile::admin.edit', [
            'data' => $user,
            'avatar' => $avatar
        ]);
    }

    public function update(UpdateProfileRequest $request){
        try{
            $tranporter = new DataTransporter($request);
            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'avatar', 'avatar']);
                if (!$image['error']) {
                    $tranporter->avatar = $image['fileName'];
                }
            }
            $profile = Apiato::call('Profile@UpdateProfileAction', [$tranporter]);
            if($profile){
              return redirect()->back()->with('status', 'Cập nhật thông tin thành công');;
            }
        }catch(Exception $e){
            $this->throwExceptionViaMess($e);
        }
    }
}
?>