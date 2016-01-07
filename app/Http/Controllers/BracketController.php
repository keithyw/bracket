<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 2:01 PM
 */

namespace App\Http\Controllers;

use App\Models\RawMessage;
use App\Models\User;
use App\Jobs\ParseMessage;
use Illuminate\Http\Request as MyRequest;

class BracketController extends Controller {

    public function index(){
        return view('bracket/index');
        //return view($this->getIndexView(), ['items' => $items]);
    }

    public function messages(){
        return response()->json(RawMessage::all());
    }

    public function store(MyRequest $request)
    {
        $user = User::find(1);
        $ret = $this->dispatch(new ParseMessage($user, $request->get('message')));
        return response()->json($ret);
    }
}