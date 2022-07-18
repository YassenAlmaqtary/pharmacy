<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AltterNativeRequest;
use App\Http\Requests\AltterNativeRequestExsists;
use App\Models\AllterNative;
use App\Models\AllterNativePharmacy;
use App\Models\Medication;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllterNativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {

        $allterMedications=AllterNativePharmacy::where('user_id',Auth::user()->id)->selection()->get();
            
        $MedicationArry=[];
        foreach( $allterMedications as $allterMedication){
            $medication_decription=AllterNative::where(['id'=>$allterMedication->allter_native_id])->selection()->first();
            
              
                $MedicationArry[]=[
                    'id'=>$allterMedication->id,
                    'trade_name'=>$medication_decription->trade_name,
                    'scientific_name'=>$medication_decription->scientific_name,
                    'made_in'=>$medication_decription->made_in,
                    'photo'=>$medication_decription->photo,
                    'pric'=>$allterMedication->price,
                    'quntity'=>$allterMedication->quntity,
                    'production_date'=>$allterMedication->production_date,
                    'expiry_date'=>$allterMedication->expiry_date,
                    'status'=>$allterMedication->getStatus(),
                    'medication_id'=>$medication_decription->medication_id,
            
            ];
                          
        
        }
        
        return view('user.allter_native.index',compact('MedicationArry'));
    }
 
       
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createExste(){

      $medications=Medication::select('id', 'trade_name')->get();
      
      
       return  view('user.allter_native.create_exsite',compact('medications'));
    }


    public function create()
    {
        $medications_pharmacys=MedicationMypharmacy::where('user_id',Auth::user()->id)->selection()->get();
        $MedicationArry=[];
        foreach( $medications_pharmacys as $medication_pharmacy){
            $medication_decription=Medication::where(['id'=>$medication_pharmacy->medication_id])->select('id','trade_name')->first();

                $MedicationArry[]=[
                    'medication_pharmacy_id'=>$medication_pharmacy->id,
                    'trade_name'=>$medication_decription->trade_name,
                    'medication_id'=>$medication_decription->id
                ];
        }  
        

       return view('user.allter_native.create',compact('MedicationArry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(AltterNativeRequest $request)
    {
        
        try {
            
            $filePath = "";
            $myPharmacy_id=MyPharmacy::select('id')->Where('user_id',Auth::user()->id)->first()->id;
           
            if ($request->has('photo')) {
                $filePath = uploadImage('allter_natives', $request->photo);
            }
               if (!$request->has('active'))

                 $request->request->add(['active' => 0]);
             else
               $request->request->add(['active' => 1]);

             

            DB::beginTransaction();
            
            
         $allter_native_id = AllterNative::insertGetId(
                [
                    'trade_name' => $request->trade_name,
                    'scientific_name' => $request->scientific_name,
                    'medication_id'=>$request->medication_id,
                    'made_in' => $request->made_in,
                    'photo' => $filePath,
                    //'status' => $request->active,
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
            AllterNativePharmacy::create([
                'allter_native_id'=>$allter_native_id,
                'medication_id'=>$request->medication_id,
                'mypharmacy_id'=>$myPharmacy_id,
                'price'=>$request->price,
                'status'=>$request->active,
                'production_date'=> $request->production_date,
                'expiry_date'=> $request->expiry_date,
                'quntity' => $request->quntity,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),  
            ]);
            Db::commit();
        
            return  redirect()->route('user.allter_native')->with(['success' => 'تم الحفظ بنجاح']);
            
         }
        

         
        catch (Exception $exp) {
            DB::rollBack();
            removeImage($filePath);
            return  redirect()->route('user.allter_native')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function storeExists(AltterNativeRequestExsists $request){
    
       try{
        $data_chek= AllterNativePharmacy::where(['allter_native_id'=>$request->allter_native_id,'user_id'=>Auth::user()->id])->get();
        if(count($data_chek)>0){
            return  redirect()->route('user.allter_native')->with(['error' => 'لقد اضفت هذا الدواء بالفعل']);
        }
        $myPharmacy_id=MyPharmacy::select('id')->Where('user_id',Auth::user()->id)->first()->id;
           
           if (!$request->has('active'))

             $request->request->add(['active' => 0]);
         else
           $request->request->add(['active' => 1]);


           AllterNativePharmacy::create([
            'allter_native_id'=>$request->allter_native_id,
            'medication_id'=>$request->medication_id,
            'mypharmacy_id'=>$myPharmacy_id,
            'price'=>$request->price,
            'status'=>$request->active,
            'production_date'=> $request->production_date,
            'expiry_date'=> $request->expiry_date,
            'quntity' => $request->quntity,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),  
        ]);
        Db::commit();
        return  redirect()->route('user.allter_native')->with(['success' => 'تم الحفظ بنجاح']);
        
     }
    
    catch (Exception $exp) {
        DB::rollBack();
        return  redirect()->route('user.allter_native')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }


    }

    public function show($id)
    {
        
        $medication_decription=Medication::find($id);
              
       
                $MedicationArry[]=[
                    'id'=>$medication_decription->id,
                    'trade_name'=>$medication_decription->trade_name,
                    'scientific_name'=>$medication_decription->scientific_name,
                    'made_in'=>$medication_decription->made_in,
                    'photo'=>$medication_decription->photo,
                    'active'=>$medication_decription->getActive(),
            
            ];
          
                
        
        return view('user.allter_native.show',compact('MedicationArry'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data=[];
            $allterNativePharmacy=AllterNativePharmacy::selection()->find($id);


            if(!$allterNativePharmacy){
                return redirect()->route('user.allter_native')->with(['error' => 'هذة القسم غير موجودة']);
            }
        
            $alltenNantive=AllterNative::select('id','trade_name')->where('id',$allterNativePharmacy->allter_native_id)->first();
           
        
            $data=[
                'id'=>$allterNativePharmacy->id,
                'quntity'=>$allterNativePharmacy->quntity,
                'price'=>$allterNativePharmacy->price,
                'expiry_date'=>$allterNativePharmacy->expiry_date,
                'production_date'=>$allterNativePharmacy->production_date,
                'allterNitave'=>$alltenNantive,
            ];
                
             
                
              return view('user.allter_native.ubdate',compact('data'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AltterNativeRequestExsists $request, $id)
    {
        try{
            $allter_native_Pharmace=AllterNativePharmacy::find($id);
            if(!$allter_native_Pharmace)
              return redirect()->route('user.allter_native')->with(['error' => 'هذة القسم غير موجودة']);
  
              if (!$request->has('status'))
  
                   $request->request->add(['status' => 0]);
               else
                 $request->request->add(['status' => 1]);
                 
             $data= $request->except(['_method','_token']);
             
             DB::beginTransaction();
             AllterNativePharmacy::where('id',$id)->update($data);
             DB::commit();
             return  redirect()->route('user.allter_native')->with(['success' => 'تم الحفظ بنجاح']);
  
          }
          catch(Exception $exp){
        
              DB::rollBack();
              return  redirect()->route('user.allter_native')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']); 
  
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
            $allter_native_Pharmace=AllterNativePharmacy::find($id);
            if(!$allter_native_Pharmace)
            return redirect()->route('user.allter_native')->with(['error' => 'هذة القسم غير موجودة']);
            $allter_native_Pharmace->delete();
            return  redirect()->route('user.allter_native')->with(['success' => 'تم الحذف بنجاح']);

        }
        catch(Exception $exp){
            return  redirect()->route('user.allter_native.create')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']); 
        }
    }


    public function loadeAllterNative(Request $request){

          try{
            
        $result = "<option>"."اختر"."</option>";
        if($request->id){
            
         $data['allter_native']=AllterNative::where('medication_id',$request->id)->select('id', 'trade_name')->status()->get();
         
         foreach ($data['allter_native'] as $allter_native){
            $result .= '<option value="'.$allter_native->id.'">'.$allter_native->trade_name.'</option>';
        }
        }
        return $result;

      }
      catch(Exception $exp){
        redirect()->route('user.allter_native')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']); 
      }
          
          
    }

    }

