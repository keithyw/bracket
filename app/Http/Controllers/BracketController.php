<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 2:01 PM
 */

namespace App\Http\Controllers;

use App\Models\RawMessage;
use App\Models\ProcessedMessage;
use App\Models\User;
use App\Jobs\ParseMessage;
use Illuminate\Http\Request as MyRequest;

class BracketController extends Controller {

    public function index(){
        return view('bracket/index');
        //return view($this->getIndexView(), ['items' => $items]);
    }

    public function messages(){
        $messages = ProcessedMessage::all();
        foreach ($messages as &$m){
            $data = json_decode($m->raw_results, 1);
            foreach ($data as $id => &$arr){
                $arr['results'] = json_decode($arr['results'], 1);
            }
            $m->raw_results = $data;
        }
        return response()->json($messages);
    }

    public function store(MyRequest $request)
    {
        $user = User::find(1);
        $ret = $this->dispatch(new ParseMessage($user, $request->get('message')));
        return response()->json($ret);
    }
}