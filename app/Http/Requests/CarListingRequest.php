<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CarListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validation = [
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'car_maker' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . now()->year,
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string|in:Manual,Automatic',
            'fuel_type' => 'required|string|in:Gasoline,Diesel',
            'engine_size' => 'nullable|string|max:50',
            'engine_type' => 'nullable|string|max:100',
            'engine_history' => 'required|string|in:Original Engine,Replaced Engine,Rebuilt Engine',
            'engine_condition' => 'required|string|in:Running,Needs Tuning,Not Running,Rebuilt Engine,Original Factory Engine',
            'restoration_history' => 'required|string|in:Fully Restored,Partially Restored,Barn Find,Unrestored Original',
            'original_parts_percentage' => 'nullable|numeric|min:0|max:100',
            'body_type' => 'nullable|string|in:Coupe,Sedan,Convertible,Wagon',
            'seat_material' => 'nullable|string|in:Leather,Cloth,Vinyl,Velour',
            'odometer' => 'required|string|in:Original,Rebuilt,Unknown',
            'license_plate_type' => 'nullable|string|in:Original Plate,Modern Plate,No Plate',
            'documentation_status' => 'required|string|in:Original Papers,Missing Papers,Custom Registration',
            'exterior_color' => 'nullable|string|max:50',
            'exterior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'interior_color' => 'nullable|string|max:50',
            'interior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'location_city' => 'required|string|max:100',
            'location_state' => 'required|string|max:100',
            'location_zipcode' => 'required|string|max:20',
            'description' => 'required|string|max:5000'
        ];

        if (Route::currentRouteName() === 'listings.store') {
            $validation['images'] = 'required|array|min:1|max:8';
            $validation['images.*'] = 'required|image|mimes:jpeg,jpg,png|max:10240';
        }

        return $validation;
    }
}
