<?php

namespace App\Ship\core\Traits\HelpersTraits;

trait RecursiveTrait
{
  public $selectTree = '';

  public function buildTree(array $elements, $parentId = 0): array
  {
    $branch = array();

    foreach ($elements as $element) {
      if ($element['pid'] == $parentId) {
        $children = $this->buildTree($elements, $element['id']);
        if ($children) {
          $element['children'] = $children;
        }
        $branch[] = $element;
      }
    }

    return $branch;
  }

  public function groupByType(array $menus = [])
  {
    $menusCollection = collect($menus);
    $menusGroups = $menusCollection->groupBy(function ($menu) {
      return $menu['type'];
    });

    return $menusGroups->toArray();
  }

  public function buildNestableTree(array $menus = [], string $keyStr = 'menu'): string
  {
    $str = "";
    foreach ($menus as $key => $menuItem) {
      $name = $menuItem['desc_lang']['name'];
      $link = @$menuItem['desc_lang']['link'];
      $menuId = $menuItem['id'];

      if (empty($menuItem['children'])) {
        $str .= view('menu::inc.recursive-list-menu', [
          'name' => $name,
          'menuId' => $menuId,
          'key' => $keyStr,
          'link' => $link
        ]);
      } else {
        $str .= view('menu::inc.recursive-parent-list-menu', [
          'name' => $name,
          'menuId' => $menuId,
          'key' => $keyStr,
          'hasChild' => 1,
          'link' => $link
        ]);
        $str .= $this->buildNestableTree($menuItem['children']);
        $str .= "</ol></li>";
      }
    }

    return $str;
  }

  public function buildNestableSidebar(array $menus = [], string $keyStr = 'menu') {
    $str = "";
    foreach ($menus as $key => $menuItem) {
      $name = @$menuItem['desc_lang']['name'];
      $link = @$menuItem['desc_lang']['link'];
      $menuId = @$menuItem['id'];

      if (empty($menuItem['children'])) {
        $str .= view('menu::inc.recursive-sidebar-menu', ['menu' => $menuItem]);
      } else {
        $str .= view('menu::inc.recursive-parent-sidebar-menu', ['menu' => $menuItem]);
        $str .= $this->buildNestableSidebar($menuItem['children']);
        $str .= "</ul></li>";
      }
    }

    return $str;
  }

  public function buildSelectTree($arr=[], $pid = 0, $tag='option', $str='', $selectedParentId=0, $selectedCurrentId=0) {
    if (!empty($arr)) {
      foreach ( $arr as $k => $v ) {
        if ( ($v['parent_id'] ?? $v['pid']) == $pid) {
            $name = $str . ( $v['desc_lang']['name'] ?? $v['title'] );

            $item = " <$tag value='{$v['id']}' ";
                // Seletced category_id, check kiểu biến
                if (is_array($selectedCurrentId)) {
                    if ( in_array($v['id'], $selectedCurrentId) ) {
                        $item .= " selected ";
                    }
                }else {
                    if ($v['id'] == $selectedCurrentId) {
                        $item .= " selected ";
                    }
                }


            $item .= ">{$name}</$tag>";

            $this->selectTree .= $item;
            unset($arr[$k]);
            $this->buildSelectTree($arr, $v['id'], $tag, sprintf('%s %s >', $str, $name), $selectedParentId, $selectedCurrentId);
        }
      }

      return trim($this->selectTree);
    }

    return "<$tag value=''>".__('menu::menu.no_data')."</$tag>";
  }
} // End class
