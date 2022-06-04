<?php

namespace App\Containers\Menu\UI\WEB\Controllers;

use Apiato\Core\Foundation\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\StringLib;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\core\Traits\HelpersTraits\RecursiveTrait;
use App\Containers\Menu\UI\WEB\Requests\EditMenuRequest;
use App\Containers\Menu\UI\WEB\Requests\StoreMenuRequest;
use App\Containers\Menu\UI\WEB\Requests\CreateMenuRequest;
use App\Containers\Menu\UI\WEB\Requests\DeleteMenuRequest;
use App\Containers\Menu\UI\WEB\Requests\UpdateMenuRequest;
use App\Containers\Menu\UI\WEB\Requests\GetAllMenusRequest;
use App\Containers\Menu\UI\WEB\Requests\FindMenuByIdRequest;
use App\Containers\Menu\UI\WEB\Requests\UpdatePositionMenuRequest;

/**
 * Class Controller
 *
 * @package App\Containers\Menu\UI\WEB\Controllers
 */
class Controller extends AdminController
{
    use RecursiveTrait;
    use ApiResTrait;

    public function __construct()
    {
        $this->title = 'Menu';

        parent::__construct();
    }

    /**
     * Show all entities
     *
     * @param GetAllMenusRequest $request
     */
    public function index(GetAllMenusRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title, 'admin_menu_index']);

        $menus = Apiato::call('Menu@GetAllMenusAction', [ ['desc_lang']]);
        $menusData = $this->buildTree($menus);
        $menusData = $this->groupByType($menusData);
        return view('menu::index', [
            'menusData' => $menusData,
            'menusType' => config('menu-container.types.'.$this->currentLang),
            'controller' => $this,
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindMenuByIdRequest $request
     */
    public function show(FindMenuByIdRequest $request)
    {
        $menu = Apiato::call('Menu@FindMenuByIdAction', [$request]);
        return $menu;
        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateMenuRequest $request
     */
    public function create(CreateMenuRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', $this->title, 'admin_menu_index']);
        $menuSidebar = Apiato::call('Menu@GetMenusByTypeAction', [config('menu-container.type_key.sidebar_admin')]);
        $menuTree = $this->buildSelectTree($menuSidebar->toArray());
        return view('menu::create', [
            'menuTypes' => config(sprintf('menu-container.types.%s', $this->currentLang)),
            'menuTree' => $menuTree,
            'menuStatus' => config('menu-container.status'),
            'routeCollection' =>\Route::getRoutes()
        ]);
    }

    /**
     * Add a new entity
     *
     * @param StoreMenuRequest $request
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Apiato::call('Menu@CreateMenuAction', [$request]);
        return redirect()->back()->with([
            'flash_level' => 'success',
            'flash_message' => __('menu::menu.created')
        ]);
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditMenuRequest $request
     */
    public function edit(EditMenuRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title, 'admin_menu_index']);

        $menu = Apiato::call('Menu@FindMenuByIdAction', [$request, ['all_desc_lang']]);
        $menuSidebar = Apiato::call('Menu@GetMenusByTypeAction', [$menu->type]);
        $menuTree = $this->buildSelectTree($menuSidebar->toArray(), 0, 'option', '', 0, $menu->pid);
// dd(\Route::getRoutes());
        return view('menu::edit', [
            'menu' => $menu,
            'menuTypes' => config(sprintf('menu-container.types.%s', $this->currentLang)),
            'menuTree' => $menuTree,
            'menuStatus' => config('menu-container.status'),
            'routeCollection' =>\Route::getRoutes()
        ]);
    }

    /**
     * Update a given entity
     *
     * @param UpdateMenuRequest $request
     */
    public function update(UpdateMenuRequest $request)
    {
        // if (isset($request->icon)) {
        //     $icon = Apiato::call('File@UploadImageAction', [$request, 'icon', 'menu', StringLib::getClassNameFromString(Category::class)]);
        //     if (!$icon['error']) {
        //         $request->icon = $icon['fileName'];
        //     }
        // }
        $menu = Apiato::call('Menu@UpdateMenuAction', [$request]);
        return redirect()->back()->with([
            'flash_level' => 'success',
            'flash_message' => __('menu::menu.updated')
        ]);
    }

    /**
     * Delete a given entity
     *
     * @param DeleteMenuRequest $request
     */
    public function delete(DeleteMenuRequest $request)
    {
        $result = Apiato::call('Menu@DeleteMenuAction', [$request]);
        return $this->sendResponse($result, __('menu::menu.delete'));
    }

    public function updatePosition(UpdatePositionMenuRequest $request)
    {
        $result = Apiato::call('Menu@UpdatePositionAction', [$request]);
        return $this->sendResponse($result, __('menu::menu.update_position'));
    }

    public function getMenusByType(int $typeId) {
        $menus = Apiato::call('Menu@GetMenusByTypeAction', [$typeId]);
        $menuTree = $this->buildSelectTree($menus->toArray());
        return $this->sendResponse($menuTree);
    }
} // End class
