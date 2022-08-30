<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resort;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ResortController extends Controller
{
   
    public function index()
    {
        $data = Resort::all();
        return view('resorts',['resorts'=>$data]);
    }

    public function detail($id)
    {
        $detail = Resort::find($id);
        return view('detail',['resort'=>$detail]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addResort()
    {

        return view('addResort');
        
    }

    public function  resortData()
    {
        $data = Resort::all();
        return view(' resortData',['resorts'=>$data]);
        
    }
   



   


   
   
    public function store(Request $request)
    {

        // $request->validate([
        //     'name'=>'required',
        //     'rent_per_day' => 'required',
        //     'gallery'=> 'required'
        // ]);


        $resort = new Resort;
        $resort->name = $request->input('name');
        $resort->rent_per_day = $request->input('rent_per_day');
        $resort->description = $request->input('description');
        
        if($request->hasfile('gallery'))
        {
            $file = $request->file('gallery');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/resorts/', $filename);
            $resort->gallery = $filename;
        } 
        $resort->save();
        return redirect()->back()->with('status','resort Added Successfully');
    }

    
    public function edit($id)
    {
        $resort = Resort::find($id);
        return view('edit',['resort'=>$resort]);
    }
 
  
    public function update(Request $request, $id)
    {
        $resort = Resort::find($id);
        $resort->name = $request->input('name');
        $resort->rent_per_day = $request->input('rent_per_day');
        $resort->description = $request->input('description');
        
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
            $resort->gallery = $filename;
        } 
        $resort->update();
        return redirect()->back()->with('status','resort updated Successfully');
    }

  


    public function destroy($id)
    {
       $resort = Resort::find($id);
       $destination = 'uploads/resorts/'.$resort->gallery;
       if(File::exists($destination))
       {
            File::delete($destination);
       }
       $resort->delete();

       return redirect()->back()->with('status','resort deleted Successfully');
    }

    public function admin()
    {
        return view('adminpage');
    }

    function createAdmin(Request $request){
        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect('/');
        
    }

    public function booking($id,Request $request)
    {
        $resort = Resort::find($id);
        return view('booking',['resort'=>$resort]);
        
    }


    public function save(Request $request){
        $data=DB::table('bookings')
                    ->where('resort_id','=',$request->resort_id)
                    ->get();

        // dd($data);
        // $startDate1=$request->start_date;
        // $endDate1 = $request->end_date;
    
        foreach($data as $item)
        {
            if($request->start_date >= $item->start_date  &&  $request->start_date <= $item->end_date)
            {
                return redirect()->back()->with('status1','Resort can not be booked booked');
            }
            else if($request->end_date >= $item->start_date && $request->end_date <= $item->end_date )
            {
                return redirect()->back()->with('status1','Resort can not be booked booked');
            }
        
        }

        $book = new Booking;
        
        $book->resort_id=$request->resort_id;
        $book->name = $request->name;
        $book->email = $request->email;
        $book->phone = $request->phone;
        $book->members = $request->members;
        $book->start_date = $request->start_date;
        $book->end_date = $request->end_date;

        $book->save();    
        return redirect()->back()->with('status2','Resort has been successfully booked');
    
}

public function  bookingList()
{
    $data = Booking::all();
    return view(' bookingList',['bookings'=>$data]);
    
}
    
    

}