<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Repositories\Impl\NewsRepositoryImpl;
use App\Services\Impl\NewsServiceImpl;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('app.index');
    }

    public function getNewsList(NewsServiceImpl $newsService)
    {
        return $newsService->getNewsList();
    }
}
