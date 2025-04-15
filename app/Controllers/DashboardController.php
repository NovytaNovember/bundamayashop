<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
{
    $data = [
        'judul' => 'Dashboard Admin',
    ];

    return view('admin/dashboard', $data);
}

}