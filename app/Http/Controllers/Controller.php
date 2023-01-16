<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveConfig(Request $request)
    {
        $names = $request->names;
        $values = $request->values;

        $count_names = count($names);

        for ($i = 0; $i < $count_names; $i++)
        {
            Configuration::updateOrCreate(['name' => $names[$i]], [
                'value' => $values[$i]
            ]);
        }

        return back()->with('message', 'Configurations saved!');
    }
}
