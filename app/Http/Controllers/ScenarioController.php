<?php

namespace App\Http\Controllers;

use App\Models\attachments;
use App\Models\characters;
use App\Models\events;
use App\Models\monster;
use App\Models\npc;
use App\Models\rooms;
use App\Models\Scenario;
use App\Models\scenario_characters;

class ScenarioController extends Controller
{
    public function index($id) {
        $scenario = Scenario::find($id);

        if(!$scenario) {
            abort(404);
        }

        $attachments = attachments::where('scenario_id', $id)->get();
        $characters = scenario_characters::where('scenario_id', $id)->get();
        $rooms = rooms::where('scenario_id', $id)->get();
        $monsters = monster::where('scenario_id', $id)->get();
        $npcs = npc::where('scenario_id', $id)->get();
        $events = events::where('scenario_id', $id)->get();

        $charactersList = [];

        foreach ($characters as $char) {
            $characterData = characters::find($char->character_id);
            $charactersList[] = $characterData;
        }

        return view('scenarios.scenario', [
            'scenario' => $scenario,
            'characters' => $charactersList,
            'npcs' => $npcs,
            'rooms' => $rooms,
            'monsters' => $monsters,
            'events' => $events,
            'attachments' => $attachments
        ]);
    }
}
