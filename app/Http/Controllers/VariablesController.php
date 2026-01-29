<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VariablesController extends Controller
{
    public function create()
    {
        $variables = Variable::pluck('value', 'key');
        return view('pages.admin-side.variables.createorupdate', compact('variables'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:20',
            'gst_rate' => 'required|numeric|min:0|max:100',

            'fax'             => 'nullable|string|max:40',
            'working_hours'   => 'nullable|string|max:30',
            'linkedin'        => 'nullable|url|max:255',
            'facebook'        => 'nullable|url|max:255',
            'instagram'       => 'nullable|url|max:255',
            'youtube'         => 'nullable|url|max:255',
            'twitter'         => 'nullable|url|max:255',
            'map'             => 'nullable|string',
            'slogan'          => 'nullable|string|max:30',
            'reg'             => 'nullable|string|max:100',
            'about_us'        => 'nullable|string|max:1000',
            'company_mission' => 'nullable|string|max:1000',
            'company_vision'  => 'nullable|string|max:1000',
            'address'         => 'nullable|string|max:500',
        ]);

        $map = [
            'name' => 'company_name',
            'email' => 'company_email',
            'phone' => 'company_phone',
            'gst_rate' => 'gst_rate',
            'fax' => 'company_fax',
            'working_hours' => 'working_hours',
            'linkedin' => 'linkedin',
            'facebook' => 'facebook',
            'instagram' => 'instagram',
            'youtube' => 'youtube',
            'twitter' => 'twitter',
            'map' => 'company_map',
            'slogan' => 'company_slogan',
            'reg' => 'registration_number',
            'about_us' => 'about_us',
            'company_mission' => 'company_mission',
            'company_vision' => 'company_vision',
            'address' => 'company_address',
        ];

        foreach ($map as $input => $key) {
            Variable::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($input)]
            );
        }

        Cache::forget('company_variables');
        Cache::forget('homepage_data');

        return back()->with('success', 'Variables saved successfully');
    }


    public static function getAllVariables()
    {
        return Cache::remember('company_variables', 3600, function () {
            $variables = Variable::pluck('value', 'key')->toArray();

            return array_merge([
                'company_name' => '',
                'company_email' => '',
                'company_phone' => '',
                'company_address' => '',
                'company_fax' => '',
                'working_hours' => '',
                'company_slogan' => '',
                'gst_rate' => '0',
                'registration_number' => '',
                'about_us' => '',
                'company_mission' => '',
                'company_vision' => '',
                'facebook' => '',
                'linkedin' => '',
                'instagram' => '',
                'youtube' => '',
                'twitter' => '',
                'company_map' => '',
            ], $variables);
        });
    }

    public static function getVariable($key, $default = '')
    {
        $variables = self::getAllVariables();
        return $variables[$key] ?? $default;
    }


    public static function getGstRate()
    {
        return floatval(self::getVariable('gst_rate', 0));
    }

    public static function calculateGst($amount)
    {
        $gstRate = self::getGstRate();
        return round($amount * ($gstRate / 100), 2);
    }

    public static function calculateTotalWithGst($amount)
    {
        $gstAmount = self::calculateGst($amount);
        return round($amount + $gstAmount, 2);
    }
}
