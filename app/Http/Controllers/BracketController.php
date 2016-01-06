<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 2:01 PM
 */

namespace App\Http\Controllers;

use App\Models\RawMessage;
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
        /**
        $model = $this->repository->create($request->all());
        if (isset($model->id)){
            return redirect()->route("{$this->getBaseRoute()}.show", ['id' => $model->id]);
        }
        // lame but need to figure out how to deal with errors
        // return redirect()->route('')
        return redirect()->route("{$this->getBaseRoute()}.create");
         */
    }
}