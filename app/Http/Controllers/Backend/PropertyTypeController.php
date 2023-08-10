<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{


    public function AllType(){

        $types = PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));

    } // End Method 

    public function AddType(){

        return view('backend.type.add_type');

    } // End Method 

    public function StoreType(Request $request){

        // Validation 
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200', // ห้ามใส่ข้อมูลซ้ำระบบจะเกิด error เตือนทันที
            'type_icon' => 'required'

        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon
        ]);

        $notification = array(
            'message' => 'Type Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification); 

    } // End Method 

    public function EditType($id){

        $types = PropertyType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));

    } // End Method 

    public function UpdateType(Request $request){

       $pid = $request->id;

       PropertyType::findOrFail($pid)->update([
        'type_name' => $request->type_name,
        'type_icon' => $request->type_icon,
    ]);


        $notification = array(
            'message' => 'Type Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification); 

    } // End Method 

    public function DeleteType($id){

         PropertyType::findOrFail($id)->delete();
 
 
         $notification = array(
             'message' => 'Type Delete Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('all.type')->with($notification); 
 
     } // End Method 

    ///////////// Amenitites All Method //////////////


        public function AllAmenitie(){

            $amenities = Amenities::latest()->get();
            return view('backend.amenities.all_amenities',compact('amenities'));

        } // End Method 

        public function AddAmenitie(){
            return view('backend.amenities.add_amenities');
        }// End Method 
}
