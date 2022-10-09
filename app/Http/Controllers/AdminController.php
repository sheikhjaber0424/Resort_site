<?php

namespace App\Http\Controllers;

use App\Models\Resort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    
    public function index()
    {
        $resorts = Resort::paginate(5);
        return view(' admin.resorts_data_table',compact('resorts'));
        
    }


  
    public function create()
    {
        return view('admin.resort_add');

    }



    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'rent_per_day' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'gallery' => ['required', 'image']
        ]);
   

       
        if($request->hasfile('gallery'))
        {          
            $file = $request->file('gallery');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/resorts/', $filename);
            $valid['gallery'] = $filename;
        } 
       

        Resort::create($valid);

        return redirect()->back()->with('status','Resort Added Successfully');
    }




    public function show(Resort $resort)
    {
        //
    }

  


    public function edit(Resort $resort)
    {       

        return view('admin.resort_edit',['resort'=>$resort]);
    }

    

    public function update(Request $request, Resort $resort)
    {
       $valid = $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'rent_per_day' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'gallery' => ['required', 'image']
        ]);

        
        if($request->hasfile('gallery'))
        {
            $destination = 'uploads/resorts/'.$resort->gallery;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('gallery');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/resorts/', $filename);
            $valid['gallery'] = $filename;
        } 

        $resort->update($valid);

        return redirect()->back()->with('status','Resort updated Successfully');
    }

  

    public function destroy(Resort $resort)
    {
   
        $destination = 'uploads/resorts/'.$resort->gallery;
        if(File::exists($destination))
        {
             File::delete($destination);
        }
        
        if ($resort->delete())
        return back()->with('success', 'Book Deleted Successfully');
    }
}
