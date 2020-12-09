<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $organizations = DB::table('organizations')->get();

        $search = $request->input('search');
        if($search) {
            $organizations = DB::table('organizations as o')
                        ->select([
                            'o.id',
                            'o.organization_name',
                            'o.email',
                            'o.phone',
                            'o.website',
                            'o.logo',
                        ])
                        ->leftJoin('organization_has_pic as pic','o.id','=','pic.organization_id')
                        ->where('o.organization_name','like', '%'.$search.'%')
                        ->orWhere('pic.pic_name','like','%'.$search.'%')
                        ->get();
        }


        return view('home',compact("organizations"));
    }
}
