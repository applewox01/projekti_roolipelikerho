<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ScenarioController extends Controller
{
    public function index($id) {
        try {
            //load basic scenario info, monsters and characters related, rooms, npcs, and events
            if (DB::table('scenarios')->where("id",$id)->doesntExist()) {
                throw new Exception("Skenaarion tietoja ei löydetty! (ID: $id)");
            } else {
                $scenario_info = DB::table('scenarios')->where("id",$id)->select('name','admin_desc','background_info')->first();
                $character_relations = DB::table('scenario_characters')->where("scenario_id", $id)->get();
                $characters = array();
                foreach ($character_relations as $single_relation) {
                    array_push($characters, DB::table('characters')->where("id", $single_relation->id)->first());
                }
                $unassigned_characters = DB::table('characters')->get();
                $rooms = DB::table('rooms')->where("scenario_id",$id)->get();

            }
            /*$monsters = DB::table('monsters')->where("scenario_id",$id)->get();
            $npcs = DB::table('npcs')->where("scenario_id",$id)->get();
            $scenario_characters = DB::table('scenario_characters')->where("scenario_id",$id)->select('id')->get();
            $characters = [];
            foreach ($scenario_characters as $relation_id) {
                array_push($characters, DB::table('characters')->where("id",$relation_id)->first());
            }

            $events = DB::table('events')->where("scenario_id",$id)->get();
            //tämän vois tehdä tietyllä tavalla
            $attachments = DB::table('attachments')->where("scenario_id",$id)->select('id','name')->get();*/
            return view('scenarios.scenario',
            [
                'name' => $scenario_info->name,
                'admin_desc' => $scenario_info->admin_desc,
                'background_info' => $scenario_info->background_info,
                'characters' => $characters,
                'unassigned_characters' => $unassigned_characters,
                'rooms' => $rooms
            ]);
        }
        catch(Exception $e) {
            return view('scenarios.scenario',['id' => $id])->withErrors(["load_scenario"=> $e->getMessage()]);
        }   
    }

}
