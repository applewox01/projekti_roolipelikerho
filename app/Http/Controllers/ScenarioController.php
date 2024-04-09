<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use App;

class ScenarioController extends Controller
{
    public function index($id) {
        try {
            //load basic scenario info, monsters and characters related, rooms, npcs, and events
            if (DB::table('scenarios')->where("id",$id)->doesntExist()) {
                throw new Exception("Skenaarion tietoja ei löydetty (ID: $id)");
            } else {
                $scenario_info = DB::table('scenarios')->where("id",$id)
                    ->select('name','admin_desc','background_info')
                    ->first();
                $characters = DB::table('scenario_characters')->where("scenario_id", $id)
                    ->join('characters', 'scenario_characters.id', '=', 'characters.id')
                    ->get();
                $rooms = DB::table('rooms')->where("scenario_id",$id)->first();
                $monsters = DB::table('monster')->where("scenario_id",$id)->first();
                $npcs = DB::table('npc')->where("scenario_id",$id)->first();
                $events = DB::table('events')->where("scenario_id",$id)->first();

                $attachments = DB::table('attachments')->where("scenario_id",$id)->first();
                $attachments_urls = array();
                if ($attachments) {
                    $json_data = json_decode($attachments->data);
                    foreach ($json_data as $attachment) {
                        array_push($attachments_urls, Storage::url($attachment));
                    }
                }
            }
            return view('scenarios.scenario',
            [
                'name' => $scenario_info->name,
                'admin_desc' => $scenario_info->admin_desc,
                'background_info' => $scenario_info->background_info,
                'characters' => $characters,
                'npcs' => $npcs,
                'rooms' => $rooms,
                'monsters' => $monsters,
                'events' => $events,
                'attachments_urls' => $attachments_urls
            ]);
        }
        catch(Exception $e) {
            $errorMessage = "";
            if (App::environment('local')) {
                $errorMessage = "ScenarioController.php: '".$e->getMessage()."' (".$e->getLine().")";
            } else {
                $errorMessage = $e->getMessage();
            }
            return view('scenarios.scenario',['id' => $id])->withErrors(["load_scenario"=> $errorMessage]);
        }   
    }

    /*public function add_character($character_id, $scenario_id) {
        try {
            DB::insert('insert into scenario_characters (character_id, scenario_id) values (?, ?)', 
            [$character_id, $scenario_id]); 
        } catch(Exception $e) {
            return view('scenarios.scenario',['id' => $scenario_id])->withErrors(["add_character"=> "Ongelma pelaajan lisäämisessä: ".$e->getMessage()]);
        }
    }*/

}
