<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function managementFile($checker) {
        $name     = time() . '_' . $checker->getClientOriginalName();
        $checker->storeAs('back/foto-profile', $name, 'public');
        return $name;
    }
}
