<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/26
 * Time: 下午6:08
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * 递归查询子分类
     * @param int $parent_id 父类ID
     * @return array
     */
    public function getAllMenu($parent_id = 0) {
        $menus = $this->where('parent_id' , $parent_id)->orderBy('order' ,'asc')->get();
        $all_menus = array();
        if (!empty($menus)) {
            foreach ($menus as $key => $menu) {
                $all_menus[$menu->id] = $menu;
                //查询子菜单
                $menu_child = $this->getAllMenu($menu->id);
                if (!empty($menu_child)) {
                    //子菜单不为空放在 child 数组中
                    $all_menus[$menu->id]->child = $menu_child;
                }
            }
        }
        return $all_menus;
    }
}