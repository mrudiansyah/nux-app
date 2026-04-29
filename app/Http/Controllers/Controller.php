<?php

namespace App\Http\Controllers;

use App\Models\PageControl;

abstract class Controller
{
    public static function menu($id, $menu_active)
    {
        $data['menu_level_1'] = PageControl::menu_level_1($id, $menu_active);
        $data['menu_level_2'] = PageControl::menu_level_2($id, $menu_active);
        $data['menu_level_3'] = PageControl::menu_level_3($id, $menu_active);
        $data['menu_level_4'] = PageControl::menu_level_4($id, $menu_active);
        $data['head_title'] = PageControl::getHeadTitle($menu_active);
        return $data;
    }

    public static function get_captcha()
    {
        return view('auth.captcha');
    }

    public static function get_host_api()
    {
        return 'https://192.168.1.251:8000/EPIAPI/';
    }
}
