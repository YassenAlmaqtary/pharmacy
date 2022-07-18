<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllterNative;
use App\Models\AllterNativePharmacy;
use App\Models\Medication;
use App\Models\MyPharmacy;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllterNativeController extends Controller
{
    use GeneralTrait;
  public function getAltterNative(Request $request){

    try{
        $validator=Validator::make($request->all(),[
            'medication_id'=>'required|integer'
            ]);
    
            if($validator->fails()){
             return $this->returnError("E001",$validator->getMessageBag()->toArray());
        }
         $alltter_native=Medication::find($request->medication_id)->altterNatives;
         return  $this->returnData('data', $alltter_native);

    }
    catch(Exception $exp){}
    return $this->returnError($exp->getCode(), $exp->getMessage());

  }


  public function getMedication(Request $request){

   try{
    $validator=Validator::make($request->all(),[
      'allter_native_id'=>'required|integer'
      ]);

      if($validator->fails()){
       return $this->returnError("E001",$validator->getMessageBag()->toArray());
  }
   $medaction=AllterNative::find($request->allter_native_id)->medication;
   return  $this->returnData('data', $medaction);

    } 


   catch(Exception $exp){

    return $this->returnError($exp->getCode(), $exp->getMessage());
   }

  }

 

  public function getAllterNativeExsistePharmacy(Request $request){

    try{
      $data_arry=[];
      $validator=Validator::make($request->all(),[
        'pharmacy_id'=>'required|integer'
        ]);
  
        if($validator->fails()){
         return $this->returnError("E001",$validator->getMessageBag()->toArray());
      }
     $allter_natives=MyPharmacy::find($request->pharmacy_id)->allterNatives;
     foreach($allter_natives as $allter_native){
       $data=AllterNativePharmacy::where(['allter_native_id'=>$allter_native->id,'mypharmacy_id'=>$request->pharmacy_id])->first();
       $data_arry[]=[
        'id'=>$allter_native->id,
        'trade_name'=>$allter_native->trade_name,
        'scientific_name'=>$allter_native->scientific_name,
        'made_in'=>$allter_native->made_in,
        'photo'=>$allter_native->photo,
        'price'=>$data->price,
        'quntity'=>$data->quntity,
        'production_date'=>$data->production_date,
        'expiry_date'=>$data->expiry_date,
       ];
     }
     return $this->returnData('data', $data_arry);
     
     
    }
    catch(Exception $exp){
      return $this->returnError($exp->getCode(), $exp->getMessage());
    }
  }



}
