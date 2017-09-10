<?php

namespace App\Http\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends BaseController
{
    public function index() {
        return 'posts';
    }
}
