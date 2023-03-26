<?php


if (!function_exists('set_active')) {
    function set_active($url, $output = 'active')
    {
        if (is_array($url)) {
            foreach ($url as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($url)) {
                return $output;
            }
        }
    }
}

if (!function_exists('set_active_sub')) {
    function set_active_sub($url, $output = 'active-sub')
    {
        if (is_array($url)) {
            foreach ($url as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($url)) {
                return $output;
            }
        }
    }
}

if (!function_exists('set_menu_open')) {
    function set_menu_open($url, $output = 'menu-open')
    {
        if (is_array($url)) {
            foreach ($url as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($url)) {
                return $output;
            }
        }
    }
}

if(!function_exists('upload_file')){
    function upload_file($file, $path, $name, $width = null, $height = null){
        $file = $file;
        $filename = str_replace(' ', '', $name) . time(). rand(1,9999) .'.' . $file->getClientOriginalExtension();
        $destinationPath = 'uploads/file/' . $path;
        $file->move($destinationPath, $filename);
        return $destinationPath . '/' . $filename;
    }
}


if(!function_exists('nameRole')){
    function nameRole($role){
        switch($role) {
            case 1 :
                $role = 'Admin';
                break;
            case 2 :
                $role = 'Dosen';
                break;
            case 3 :
                $role = 'Mahasiswa';
                break;
        }
        return $role;
    }
}

if(!function_exists('iconFile')){
    function iconFile($file){
        switch($file) {
            case 'docx' :
                $file = 'Admin';
                break;
            case 'pdf' :
                $file = 'Dosen';
                break;
            case 'xls' :
                $file = 'Mahasiswa';
                break;
        }
        return $file;
    }
}


