<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CarAPIController extends Controller
{
    function getCars() {
        $cars = Car::all();
        return response()->json([
            'data' => $cars
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => [
                'required',
                'unique:cars',
                'regex:/^[A-Z]{1,2} [0-9]{4} [A-Z]{2}$/'
            ],
            'car_type' => 'required',
            'location_id' => 'required|exists:locations,id',
            'car_type_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ], [
            'license_plate.required' => 'This field is required!',
            'license_plate.unique' => 'This license plate already exists!',
            'license_plate.regex' => 'The license plate must follow the format X XXXX XX or XX XXXX XX.',
            'car_type.required' => 'This field is required!',
            'location_id.required' => 'This field is required!',
            'location_id.exists' => 'Invalid location selected!',
            'car_type_image.required' => 'The car type image is required!',
            'car_type_image.image' => 'The file must be an image.',
            'car_type_image.mimes' => 'Only jpeg, png, jpg, and svg images are allowed.',
            'car_type_image.max' => 'Image size must not exceed 2MB.',
        ]);

        $data = $request->all();
        $data['parked_at'] = now();

        
        if ($request->hasFile('car_type_image')) {
            $data['car_type_image'] = $request->file('car_type_image')->store('car_images', 'public');
        }

        Car::create($data);

        return response('Car Added Succesfully!');
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'license_plate' => [
                'required',
                'unique:cars,license_plate,' . $car->id,
                'regex:/^[A-Z]{1,2} [0-9]{4} [A-Z]{2}$/'
            ],
            'car_type' => 'required',
            'location_id' => 'required|exists:locations,id',
            'car_type_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ], [
            'license_plate.required' => 'This field is required!',
            'license_plate.unique' => 'This license plate already exists!',
            'license_plate.regex' => 'The license plate must follow the format X XXXX XX or XX XXXX XX.',
            'car_type.required' => 'This field is required!',
            'location_id.required' => 'This field is required!',
            'location_id.exists' => 'Invalid location selected!',
            'car_type_image.image' => 'The file must be an image.',
            'car_type_image.mimes' => 'Only jpeg, png, jpg, and svg images are allowed.',
            'car_type_image.max' => 'Image size must not exceed 2MB.',
        ]);

        $data = $request->all();
        $data['parked_at'] = now();

       
        if ($request->hasFile('car_type_image')) {
            
            if ($car->car_type_image) {
               
                Storage::delete('public/' . $car->car_type_image);
            }

           
            $data['car_type_image'] = $request->file('car_type_image')->store('car_images', 'public');
        }

       
        $car->update($data);

        return response('Car Updated Succesfully!');
    }

    public function destroy(Car $car)
    {
        if ($car->car_type_image) {
        
            Storage::delete('public/' . $car->car_type_image);
        }
        $car->delete();
        return response('Car deleted successfully!');
    }    
}
