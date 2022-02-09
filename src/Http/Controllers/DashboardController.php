<?php

namespace Bhujel\SecretHeader\Http\Controllers;

use App\Http\Controllers\Controller;
use Bhujel\SecretHeader\Models\AccessKey;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct(AccessKey $accesskey)
    {
     $this->accesskey=  $accesskey;   
     $this->middleware(config('access_config.middleware'));
    }
    public function dashboard(Request $request){
       
        $data = [
            "all_access_keys" => $this->accesskey->count(),
            "active_keys" => $this->accesskey->where("status", true)->count(),
            "inactive_keys" => $this->accesskey->where('status', false)->count(),
            "test_keys" => $this->accesskey->where('type', 0)->count(),
            "live_keys" => $this->accesskey->where('type', 1)->count(),
        ] ; 
        return view("accessor::dashboard", $data);
    }
}
