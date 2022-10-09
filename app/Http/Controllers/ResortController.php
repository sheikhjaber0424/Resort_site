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
        return view('resorts.index',['resorts'=>$data]);
    }





    public function detail($id)
    {
        $detail = Resort::find($id);
        return view('resorts.detail',['resort'=>$detail]);
    }
   




    public function addResort()
    {

        return view('admin.resort_add');
        
    }





    public function  resortData()
    {
        $data = Resort::paginate(5);
        return view(' admin.resorts_data_table',['resorts'=>$data]);
        
    }
   




    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'rent_per_day' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'gallery' => ['required', 'image']
        ]);
   

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
        return view('admin.resort_edit',['resort'=>$resort]);
    }
 
  





    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'rent_per_day' => ['required', 'integer'],
            'description' => ['required', 'max:255'],
            'gallery' => ['required', 'image']
        ]);

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

        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:5', 'max:16'],
        ]);

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
        return view('resorts.booking',['resort'=>$resort]);
        
    }





    public function save(Request $request){

       $valid =  $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required',  'max:11'],
            'members' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);


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
    return view(' admin.resort_booking_list',['bookings'=>$data]);
    
}






public function searchData(Request $request)
{
    
     $data= Resort::where('name', 'like','%'.$request->input('query').'%')
                        ->orWhere('rent_per_day', 'like','%'.$request->input('query').'%')
                        ->orWhere('description', 'like','%'.$request->input('query').'%')
                        ->get();
                        
    //  dd($data);
   return view('admin.search_resort',['resorts'=>$data]);
}







public function searchBooking(Request $request)
{
    
     $data= Booking::where('resort_id', 'like','%'.$request->input('query').'%')
                        ->orWhere('email', 'like','%'.$request->input('query').'%')
                        ->orWhere('members', 'like','%'.$request->input('query').'%')
                        ->orWhere('start_date', 'like','%'.$request->input('query').'%')
                        ->orWhere('end_date', 'like','%'.$request->input('query').'%')
                        ->get();
                        
    //  dd($data);
   return view('admin.search_booking',['bookings'=>$data]);
}



}