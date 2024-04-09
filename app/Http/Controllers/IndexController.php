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
            $worlds = DB::table('worlds')->select('name','id')->get();
            return view("index",
            [
                'scenarios' => $scenarios,
                'search_by' => "",
                'filter_world' => "",
                'order_by' => "",
                'worlds' => $worlds
            ]
            );
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
    }

    public function sort_by() {
        try {
            $filter_world = request()->get('maailma');
            $order_by = request()->get('jarjestys');
            $search_by = trim(request()->get('search'));
            $worlds = DB::table('worlds')->select('name','id')->get();
            $query = DB::table('scenarios');

            if ($filter_world != '') {
                $query->where('world_id',$filter_world);
            };
            if ($search_by != '') {
                $query->where('name',$search_by)->orderBy('name');
            };
            switch ($order_by) {
                case "az":
                    $query->orderBy('name');
                    break;
                case "lvl":
                    $query->orderBy('lvl_highest', 'asc')->orderBy('lvl_lowest', 'asc');
                    break;
                case "plrcount":
                    $query->orderBy('plr_most', 'asc')->orderBy('plr_least', 'asc');
                    break;
            };
            $scenarios = $query->get();
            return view("index",
            [
                'order_by' => $order_by,
                'search_by' => $search_by,
                'scenarios' => $scenarios,
                'worlds' => $worlds,
                'filter_world' => $filter_world
            ]
            );
        }
        catch (Exception $e) {
            return view("index")->withErrors(["get_scenarios"=> $e->getMessage()]);
        }
    }
}
