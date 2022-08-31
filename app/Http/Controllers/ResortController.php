<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resort;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResortController extends Controller
{
   
    public function index()
    {
        $data = Resort::paginate(8);
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
        $data = Resort::paginate(5);
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
        return redirect()->back()->with('status','Resort Added Successfully');
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
        return redirect()->back()->with('status','Resort updated Successfully');
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

       return redirect()->back()->with('status','Resort deleted Successfully');
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
      
    
        foreach($data as $item)
        {   
            if($request->start_date >= $item->start_date  &&  $request->start_date <= $item->end_date)
            {
                return redirect()->back()->with('status1','Resort is not available for the desired dates!');
            }
            if($request->end_date >= $item->start_date && $request->end_date <= $item->end_date )
            {
                return redirect()->back()->with('status1','Resort is not available for the desired dates!');
            }
            if($request->start_date >= $request->end_date)
            {
                return redirect()->back()->with('status3','Please enter valid dates!');
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


        $adminMail =User::inRandomOrder()->first();

        $data =['name'=>'abc'] ;
        $user = $request->email;
        $admin = $adminMail->email;
        Mail::send('mailView', $data, function ($message) use ($user,$admin) {
            $message->to($user);
            $message->to($admin);
            $message->subject('Booking Confirmation!');
            
        });


        return redirect()->back()->with('status2','Resort has been successfully booked');
    
}




public function  bookingList()
{
    $data = Booking::paginate(5);
    return view(' bookingList',['bookings'=>$data]);
    
}

public function searchData(Request $request)
{
    
     $data= Resort::where('name', 'like','%'.$request->input('query').'%')
                        ->orWhere('rent_per_day', 'like','%'.$request->input('query').'%')
                        ->orWhere('description', 'like','%'.$request->input('query').'%')
                        ->get();
                        
    //  dd($data);
   return view('searchData',['resorts'=>$data]);
}
public function searchBooking(Request $request)
{
    
     $data= Booking::where('resort_id', 'like','%'.$request->input('query').'%')
                        ->orWhere('phone', 'like','%'.$request->input('query').'%')
                        ->orWhere('email', 'like','%'.$request->input('query').'%')
                        ->orWhere('members', 'like','%'.$request->input('query').'%')
                        ->orWhere('start_date', 'like','%'.$request->input('query').'%')
                        ->orWhere('end_date', 'like','%'.$request->input('query').'%')
                        ->get();
                        
    //  dd($data);
   return view('searchBooking',['bookings'=>$data]);
}



}