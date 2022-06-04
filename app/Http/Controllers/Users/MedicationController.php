<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicationRequest;
use App\Http\Requests\MedicationRequsetExsits;
use App\Models\Category;
use App\Models\Medication;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        
        $medications=MedicationMypharmacy::where('user_id',Auth::user()->id)->selection()->get();
        
        $MedicationArry=[];
        foreach( $medications as $medication){
            $medication_decription=Medication::where(['id'=>$medication->medication_id])->selection()->first();

                $MedicationArry[]=[
                    'id'=>$medication->id,
                    'trade_name'=>$medication_decription->trade_name,
                    'scientific_name'=>$medication_decription->scientific_name,
                    'made_in'=>$medication_decription->made_in,
                    'photo'=>$medication_decription->photo,
                    'pric'=>$medication->price,
                    'quntity'=>$medication->quntity,
                    'production_date'=>$medication->production_date,
                    'expiry_date'=>$medication->expiry_date,
                    'status'=>$medication->getActive()
            
            ];
                          
       
    }
     
    return view('user.medication.index',compact('MedicationArry'));
        
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catgorys = Category::select()->active()->get();
        
        $mypharmacys=MyPharmacy::where('user_id',Auth::user()->id)->select('id','name')->active()->get();
        

        return view('user.medication.create', compact('catgorys','mypharmacys'));
    }


    public function createExste()
    {
        $catgorys = Category::select()->active()->get();
        $medications=Medication::select('id','trade_name')->active()->get();
        $mypharmacys=MyPharmacy::where('user_id',Auth::user()->id)->select('id','name')->active()->get();
        
        return view('user.medication.create_exsite', compact('catgorys','mypharmacys','medications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicationRequest $request)
    {
        try {
            
            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('medications', $request->photo);
            }
               if (!$request->has('active'))

                 $request->request->add(['active' => 0]);
             else
               $request->request->add(['active' => 1]);

             

            DB::beginTransaction();
            
            
         $Medication_id = Medication::insertGetId(
                [
                    'trade_name' => $request->trade_name,
                    'scientific_name' => $request->scientific_name,
                    'made_in' => $request->made_in,
                    'photo' => $filePath,
                    //'active' => $request->active,
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
            MedicationMypharmacy::create([
                'mypharmacy_id'=>$request->mypharmacy_id,
                'medication_id'=>$Medication_id,
                'price'=>$request->price,
                'status'=>$request->active,
                'categorie_id'=> $request->categories_id,
                'production_date'=> $request->production_date,
                'expiry_date'=> $request->expiry_date,
                'quntity' => $request->quntity,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),  
            ]);
            Db::commit();
            return  redirect()->route('user.medication')->with(['success' => 'تم الحفظ بنجاح']);
            
         }
        
        catch (Exception $exp) {
            DB::rollBack();
            removeImage($filePath);
            return  redirect()->route('user.medication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function storeExists(MedicationRequsetExsits $request)
    {
        try {
            
              
               if (!$request->has('active'))

                 $request->request->add(['active' => 0]);
             else
               $request->request->add(['active' => 1]);

             

            DB::beginTransaction();

           
            MedicationMypharmacy::create([
                'mypharmacy_id'=>$request->mypharmacy_id,
                'medication_id'=>$request->medication_id,
                'price'=>$request->price,
                'status'=>$request->active,
                'categorie_id'=> $request->categories_id,
                'production_date'=> $request->production_date,
                'expiry_date'=> $request->expiry_date,
                'quntity' => $request->quntity,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),  
            ]);
            Db::commit();
            return  redirect()->route('user.medication')->with(['success' => 'تم الحفظ بنجاح']);
            
         }
        
        catch (Exception $exp) {
            DB::rollBack();
            return  redirect()->route('user.medication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
    {   try{
    
           $data=[];
            $medication_Pharmace=MedicationMypharmacy::selection()->find($id);
            if(!$medication_Pharmace){
                return redirect()->route('user.medication')->with(['error' => 'هذة القسم غير موجودة']);
            }
            $mypharmacy = MyPharmacy::select('id','name')->where('user_id',Auth::user()->id)->get();
            //return $medication_Pharmace;
            $category = Category::select('id','name')->where('id',$medication_Pharmace->categorie_id)->active()->get();
            $catgorys = Category::select('id','name')->active()->get();
            $medication=Medication::select('id','trade_name')->where('id',$medication_Pharmace->medication_id)->get();
            $medications=Medication::select('id','trade_name')->get();
            $data=[
                 'id'=>$medication_Pharmace->id,
                 'quntity'=>$medication_Pharmace->quntity,
                 'price'=>$medication_Pharmace->price,
                 'expiry_date'=>$medication_Pharmace->expiry_date,
                 'production_date'=>$medication_Pharmace->production_date,
                 'category'=> $category,
                 'categorys'=> $catgorys,
                 'medication'=>$medication,
                 'medications'=>$medications,
                 'mypharmacy'=>$mypharmacy,
                ];

              return view('user.medication.ubdate',compact('data'));

    }       
       catch(Exception $exp){
           return $exp;
        return  redirect()->route('user.medication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicationRequsetExsits $request, $id)
    {
        try{
          $medication_Pharmace=MedicationMypharmacy::find($id);
          if(!$medication_Pharmace)
            return redirect()->route('user.medication')->with(['error' => 'هذة القسم غير موجودة']);

            if (!$request->has('status'))

                 $request->request->add(['status' => 0]);
             else
               $request->request->add(['status' => 1]);
               
           $data= $request->except(['_method','_token']);
           
           DB::beginTransaction();
           MedicationMypharmacy::where('id',$id)->update($data);
           DB::commit();
           return  redirect()->route('user.medication')->with(['success' => 'تم الحفظ بنجاح']);

        }
        catch(Exception $exp){
            DB::rollBack();
            return  redirect()->route('user.medication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']); 

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
        try{
            $medicationMypharmacy=MedicationMypharmacy::find($id);
            if(!$medicationMypharmacy)
            return redirect()->route('user.medication')->with(['error' => 'هذة القسم غير موجودة']);
            $medicationMypharmacy->delete();
            return  redirect()->route('user.medication')->with(['success' => 'تم الحذف بنجاح']);

        }
        catch(Exception $exp){
            return  redirect()->route('user.medication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']); 
        }
    }
}
