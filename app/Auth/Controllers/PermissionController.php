<?php

namespace App\Auth\Controllers;

use ApiAuth;
use App\Auth\Transformers\PermissionTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $userId;

    public function __construct()
    {
        $this->userId = ApiAuth::getCurrentId();
    }

    public function getPermissions()
    {
        $data = ApiAuth::permissions($this->userId);

        return response()->json($data);
    }

    public function getRoles()
    {
        $data = ApiAuth::roles($this->userId);

        return response()->json($data);
    }
}
