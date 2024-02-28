<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Auth;
use Exception;

class IndexController extends Controller
{
    public function index() {
        try {
            if (Auth::check()) {
            $scenarios = DB::table('scenarios')->get();
            } else {
                $scenarios = collect();
            }
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
        return view("index",
        [
            'scenarios' => $scenarios,
            'search_by' => "",
            'order_by' => ""
        ]
    );
    }

    public function sort_by() {
        try {
        if (Auth::check()) {
            $order_by = trim(request()->get('jarjestys'));
            $search_by = trim(request()->get('search'));
            if ($search_by != '') {
                $scenarios = DB::table('scenarios')->where('name',$search_by)->get();
            } else if ($order_by != '') {
                $scenarios = DB::table('scenarios')->orderBy($order_by)->get();
            } else {
                $scenarios = DB::table('scenarios')->get();
            };
        } else {
            throw new Exception("Istunto päättynyt");
        }
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
        return view("index",
        [
            'order_by' => $order_by,
            'search_by' => $search_by,
            'scenarios' => $scenarios
        ]
    );
    }
}
