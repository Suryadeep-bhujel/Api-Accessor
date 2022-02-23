<?php

namespace Bhujel\SecretHeader\Http\Controllers;

use App\Http\Controllers\Controller;
use Bhujel\SecretHeader\Models\AccessKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccesskeyController extends Controller
{
    public function __construct()
    {
        $this->middleware(config('access_config.middleware'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $keys = AccessKey::get();
        $data = [
            "keys" => $keys,
        ];

        return view("accessor::list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            "title" => "Add New Access Key",
            "route" => route('access_keys.store'),
        ];
        return view("accessor::create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => "required|string|max:191",
            "type" => "required|boolean",
            "status" => "required|boolean",
        ]);

        try {

            $data = $request->except('_token');
            $data['addedBy'] = @auth()->user()->id;
            if($request->type == 'live'){
                $key =  "live_public_key_".Str::random(50);
            }else if ($request->type == 'test'){
                $key =  "test_public_key_".Str::random(50);

            }
            $data['key'] = $key;
            $data['status'] = $request->status == 1 ? true :false; 
            AccessKey::create($data);
            $request->session()->flash("New Access key successfully added. ");
            return redirect()->route("access_keys.index");
        } catch (\Throwable$th) {
            report($th);
            throw $th;

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $key_info = AccessKey::findOrFail($id);

        $data = [
            'title' => "Edit API Access Key",
            "keyInfo" => $key_info,
            "route" => route("access_keys.update", $id),
        ];
        return view("accessor::create", $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $key_info = AccessKey::findOrFail($id);

        try {
            $data = $request->except('_token');
            $data['addedBy'] = @auth()->user()->id;
            $data['status'] = $request->status == 1 ? true :false; 

            $key_info->update($data);
            $request->session()->flash("Access key successfully updated. ");
            return redirect()->route("access_keys.index");
        } catch (\Throwable$th) {
            report($th);
            throw $th;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $key_info = AccessKey::findOrFail($id);
        try {
            $key_info->delete();
            request()->session()->flash("Access key has been deleted. ");
            return redirect()->route("access_keys.index");
        } catch (\Throwable$th) {
            throw $th;
        }

    }
}
