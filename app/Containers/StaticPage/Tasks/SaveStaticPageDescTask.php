<?php

namespace App\Containers\StaticPage\Tasks;

use Apiato\Core\Foundation\Apiato;
use Apiato\Core\Foundation\ImageURL;
use Apiato\Core\Foundation\StringLib;
use App\Containers\StaticPage\Data\Repositories\StaticPageDescRepository;
use App\Containers\StaticPage\Models\StaticPage;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Parents\Requests\Request;

/**
 * Class SaveStaticPageDescTask.
 */
class SaveStaticPageDescTask extends Task
{

    protected $repository;

    public function __construct(StaticPageDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  bool
     */
    public function run($data, $original_desc, $parent_id,Request $request)
    {

        try{
            $description = isset($data['staticpage_description']) ? (array)$data['staticpage_description'] : null;

            if (!empty($description) && is_array($description)) {
                $inserts = [];
                foreach ($description as $k => $v) {
                    $tmp = $v;
                    $attrItem = [];
                    if(!empty($v['item'])) {
                        $count = count($v['item']['item_title']);
                        for ($i = 0; $i < $count; $i++) {
                            if (!empty($tmp['item']['item_icon'][$i])) {
                                $request->request->add(['fileIcon' => $v['item']['item_icon'][$i]]);
                                $upload_icon = $this->imageFile($request, 'fileIcon', $v['item']['item_icon'][$i], 'staticpage');
                            } else {
                                $upload_icon['fileName'] = !empty($v['item']['check_item_icon'][$i]) ? $v['item']['check_item_icon'][$i] : null;
                            }
                            if (!empty($tmp['item']['item_image'][$i])) {
                                $request->request->add(['fileImage' => $v['item']['item_image'][$i]]);
                                $upload_image = $this->imageFile($request, 'fileImage', $v['item']['item_image'][$i], 'staticpage');
                            } else {
                                $upload_image['fileName'] = !empty($v['item']['check_item_image'][$i]) ? $v['item']['check_item_image'][$i] : null;
                            }
                            
                            $attrItem[] = [
                                'time' => @$v['item']['time'][$i],
                                'company_name' => @$v['item']['company_name'][$i],
                                'address' => @$v['item']['address'][$i],
                                'item_image' => $upload_image['fileName'],
                                'item_title' => $v['item']['item_title'][$i],
                                'item_description' => $v['item']['item_description'][$i],
                            ];
                        }
                    }
                    $tmp['item'] = json_encode($attrItem);
                    $inserts[] = array_merge($tmp,[
                        'static_page_id' => $parent_id,
                        'language_id' => $k
                    ]);
                }

                if (!empty($inserts)) {
                    $this->repository->where('static_page_id', $parent_id)->delete();
                    $this->repository->insert($inserts);
                }
                return true;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
        return false;
    }

    public function imageFile(Request $request, string $fileField = 'file', string $prefix = '', $folder_upload = 'pagefile')
    {
        $errorMsg = null;
        $fname = null;
        $file = $request->$fileField;
        $allowedFileExtension = ['jpeg','jpg','png','gif'];
        $extension = $file->getClientOriginalExtension();
        if (in_array($extension, $allowedFileExtension) && $file->isValid()) {
            $fname = ImageURL::makeFileName(!empty($prefix) ? $prefix : $file->getClientOriginalName(), $extension);

            $storeResult = $file->storeAs($folder_upload, $fname, 'upload');

            if (!$storeResult) {
                $errorMsg = 'Upload file lên server thất bại!';
            }
        } else {
            $errorMsg = 'Upload file lên server sai định dạng!';
        }
        return ['error' => !empty($errorMsg), 'msg' => @$errorMsg ?: 'Success', 'fileName' => $fname];
    }

}
