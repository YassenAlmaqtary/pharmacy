<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      
    $this->middleware('auth')->except(['create','store']);

    }

    public function index()
    {

        $vendors = Auth::user();
        return view('user.vendors.index',compact('vendors'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('user.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            
                DB::beginTransaction(); 
               $user= User::Create(['name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'statuse'=>$request->active
                ]);  
                DB::commit();
                Auth::login($user);

                 return redirect()->route('user.vendors')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch(Exception $exp){
            
            DB::rollBack();
            return  redirect()->route('user.vendors.create')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $users=User::select()->find($id); 
            if (!$users)
                 return redirect()->route('user.vendors')->with(['error' => 'هذة القسم غير موجودة']);
                //$users = $users->makeVisible(['password']);
               // $users = $users->makeHidden(['name']);
            return view('user.vendors.ubdate',compact('users'));
         }
         catch(Exception $exp){
             return  redirect()->route('user.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try{
            $users=User::select()->find($id); 
            
            if (!$users)
                return redirect()->route('user.vendors')->with(['error' => 'هذة القسم غير موجودة']);
            
                // if (!$request->has('active')) {

                //     $request->request->add(['active' => 0]);
                // } else {
                //     $request->request->add(['active' => 1]);
                // }  
                User::where('id', $id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'updated_at' => Carbon::now(),
                ]);
                return redirect()->route('user.vendors')->with(['success' => 'تم الحفظ بنجاح']);


         }catch(Exception $exp){
            return  redirect()->route('user.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
         }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
