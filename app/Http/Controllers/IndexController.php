<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        $scenarios = DB::table('scenarios')->get();
        return view("index",
        [
            'scenarios' => $scenarios,
            'search_by' => "",
            'order_by' => ""
        ]
    );
    }

    public function sort_by() {
        $order_by = request()->get('jarjestys');
        $search_by = request()->get('search');
        if (trim($search_by) != '') {
            $scenarios = DB::table('scenarios')->where('name',$search_by)->get();
        } else if ($order_by != '') {
            $scenarios = DB::table('scenarios')->orderBy($order_by)->get();
        } else {
            $scenarios = DB::table('scenarios')->get();
        };
        return view("index",
        [
            'order_by' => trim($order_by),
            'search_by' => trim($search_by),
            'scenarios' => $scenarios
        ]
    );
    }
}
