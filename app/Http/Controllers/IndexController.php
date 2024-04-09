<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class IndexController extends Controller
{
    public function index() {
        try {
            $scenarios = DB::table('scenarios')->get();
            return view("index",
            [
                'scenarios' => $scenarios,
                'search_by' => "",
                'order_by' => ""
            ]
            );
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
    }

    public function sort_by() {
        try {
            $order_by = trim(request()->get('jarjestys'));
            $search_by = trim(request()->get('search'));
            if ($search_by != '') {
                $scenarios = DB::table('scenarios')->where('name',$search_by)->get();
            } else {
                switch ($order_by) {
                    case "az":
                        $scenarios = DB::table('scenarios')->orderBy('name')->get();
                        break;
                    case "lvl":
                        $scenarios = DB::table('scenarios')->orderBy('lvl_highest', 'asc')->orderBy('lvl_lowest', 'asc')->get();
                        break;
                    case "plrcount":
                        $scenarios = DB::table('scenarios')->orderBy('plr_most', 'asc')->orderBy('plr_least', 'asc')->get();
                        break;
                    default:
                    $scenarios = DB::table('scenarios')->get();
                };
            };
            return view("index",
            [
                'order_by' => $order_by,
                'search_by' => $search_by,
                'scenarios' => $scenarios
            ]
            );
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
    }
}
