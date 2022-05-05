<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //return view('blog.home');
    }

    public function setting(Request $request): string
    {
        $res = $request->validate([
            'value'     => 'required',
        ]);

        $res['local']  = $request['local'];

        $setting = Setting::query()
            ->updateOrCreate(
                ['key'    => $request['key'], 'local'  => $request['local']],
                ['value'  => $request['value']]
            );

        //$request->session()->flash('success',__('config.changes_saved'));

        return redirect('/admin');
    }

}
