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
            'name'  => 'required|string|max:20',
            'email' => 'required|email|max:40',
            'phone' => 'required|string|max:20',
            'gst_rate' => 'required|numeric|min:0|max:100',

            'fax'             => 'nullable|string|max:40',
            'working_hours'   => 'nullable|string|max:40',
            'linkedin'        => 'nullable|string|max:100',
            'facebook'        => 'nullable|string|max:100',
            'instagram'       => 'nullable|string|max:100',
            'youtube'         => 'nullable|string|max:100',
            'twitter'         => 'nullable|string|max:100',
            'map'             => 'nullable|string|max:255',
            'slogan'          => 'nullable|string|max:40',
            'reg'             => 'nullable|string|max:50',
            'about_us'        => 'nullable|string|max:500',
            'company_mission' => 'nullable|string|max:500',
            'company_vision'  => 'nullable|string|max:500',
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

        // Clear cache
        Cache::forget('company_variables');

        return back()->with('success', 'Variables saved successfully');
    }

    /**
     * Get all variables as key-value array
     */
    public static function getAllVariables()
    {
        return Cache::remember('company_variables', 3600, function () {
            return Variable::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get GST rate
     */
    public static function getGstRate()
    {
        $variables = self::getAllVariables();
        return floatval($variables['gst_rate'] ?? 0);
    }

    /**
     * Calculate GST amount
     */
    public static function calculateGst($amount)
    {
        $gstRate = self::getGstRate();
        return round($amount * ($gstRate / 100), 2);
    }

    /**
     * Calculate total with GST
     */
    public static function calculateTotalWithGst($amount)
    {
        $gstAmount = self::calculateGst($amount);
        return round($amount + $gstAmount, 2);
    }
}
