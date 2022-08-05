<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\StaticPage\Actions\Admin\FindStaticPageByIDAction;
use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\FrontEnd\UI\WEB\Requests\StaticPage\DetailStaticPageRequest;

class StaticPage extends NeedAuthController
{

    public function detail(DetailStaticPageRequest $request, FindStaticPageByIDAction $findStaticPageByIDAction)
    {
        $staticPage = $findStaticPageByIDAction->run($request->id, ['with_relationship' => ['desc']]);
        return view('frontend::staticpage.detail', [
            'staticPage' => $staticPage
        ]);
    }

}
?>