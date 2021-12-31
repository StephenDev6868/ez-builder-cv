<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\ResumeCV\Entities\Resumecv;
use Modules\ResumeCV\Entities\Resumecvtemplate;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
   
    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        $data_10_first = Resumecv::where('user_id', $request->user()->id);

        $data_10_first->orderBy('created_at', 'DESC');
        $data_10_first = $data_10_first->paginate(10);

        $total_resume = Resumecv::where('user_id', $user_id)->count();
        $total_views = Resumecv::where('user_id', $user_id)->sum('view_count');

        return view('dashboard::index', 
            compact('total_resume', 'total_views','data_10_first')
        );
    }

}
