<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class IndexController extends Controller
{
    public function index()
    {
        try {
            $scenarios = DB::table('scenarios')->orderBy('name')->get();
            $worlds = DB::table('worlds')->select('name', 'id')->get();

            return view('index', [
                'scenarios' => $scenarios,
                'search_by' => '',
                'filter_world' => '',
                'order_by' => 'az',
                'worlds' => $worlds,
            ]);
        } catch (Exception $e) {
            return view('index')->withErrors(['get_scenarios' => $e->getMessage()]);
        }
    }

    public function sort_by(Request $request)
    {
        try {
            $filter_world = $request->input('maailma', '');
            $order_by = $request->input('jarjestys', 'az');
            $search_by = trim($request->input('search', ''));

            $worlds = DB::table('worlds')->select('name', 'id')->get();

            $query = DB::table('scenarios');

            if (!empty($filter_world)) {
                $query->where('world_id', $filter_world);
            }

            if (!empty($search_by)) {
                $query->where('name', 'LIKE', '%' . $search_by . '%');
            }

            switch ($order_by) {
                case 'za':
                    $query->orderBy('name', 'desc');
                    break;
                case 'lvl':
                    $query->orderBy('lvl_highest')->orderBy('lvl_lowest');
                    break;
                case 'plrcount':
                    $query->orderBy('plr_most')->orderBy('plr_least');
                    break;
                default:
                    $query->orderBy('name');
            }

            $scenarios = $query->get();

            return view('index', [
                'order_by' => $order_by,
                'search_by' => $search_by,
                'scenarios' => $scenarios,
                'worlds' => $worlds,
                'filter_world' => $filter_world,
            ]);
        } catch (Exception $e) {
            return view('index')->withErrors(['get_scenarios' => $e->getMessage()]);
        }
    }
}
