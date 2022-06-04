<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Medication;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use App\Traits\GeneralTrait;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MedicationController extends Controller
{
    use GeneralTrait;
    public function getMedicationWithPharmce(Request $request){
        
       try{
           $validator=Validator::make($request->all(),[
           'page'=>'integer'
           ]);
           if($validator->fails()){
            return $this->returnError("E001",$validator->getMessageBag()->toArray());
           }
         
           $data_array=[];
        $medications_id=MedicationMypharmacy::select('medication_id')->get();
        if(!$medications_id)
        return $this->returnError('E001', 'هذاالمنتج  موجود');
        foreach($medications_id as $medication_id){
         if($request)   
         $medication_pharmacy=Medication::with('Pharmacys')->where('id',$medication_id->medication_id)->paginate($request->page);
         else
         $medication_pharmacy=Medication::with('Pharmacys')->where('id',$medication_id->medication_id)->get();
         $data_array[]=$medication_pharmacy;
        }
        return $this->returnData('data', $data_array);
    }
    catch(Exception $exp){
        return $this->returnError($exp->getCode(), $exp->getMessage());
    }
}



public function getMedicationWithCategory(Request $request){

   try{
      
    $validator=Validator::make($request->all(),[
        'categorie_id'=>'required|integer'
        ]);

        if($validator->fails()){
         return $this->returnError("E001",$validator->getMessageBag()->toArray());
        }
        $data_array=[];
        $medications=Category::find($request->categorie_id)->medications();
        
        
        foreach($medications as $medication){
            $data_array[]=[
                'id'=>$medication->id,
                'name'=>Medication::select('trade_name')->find($medication->medication_id)->trade_name,
                'made_in'=>Medication::select('made_in')->find($medication->medication_id)->made_in,
                'photo'=>Medication::select('photo')->find($medication->medication_id)->photo,
                'name_pharmacy'=>MyPharmacy::select('name')->find($medication->mypharmacy_id)->name,
                'pric'=>$medication->price,
                'quntity'=>$medication->quntity,
                'production_date'=>$medication->production_date,
                'expiry_date'=>$medication->expiry_date,
                'status'=>$medication->getActive()
        
        ];

        }
        return $this->returnData('data', $data_array);
      
   }
   catch(Exception $exp){
    return $this->returnError($exp->getCode(), $exp->getMessage());
   }

}

public function getAllCategorys(Request $request){
  try{
    $validator=Validator::make($request->all(),[
        'page'=>'integer'
        ]);
        if($validator->fails()){
         return $this->returnError("E001",$validator->getMessageBag()->toArray());
        }
        if ($request->has('page'))
        $categorys=Category::select('id','name')->active()->paginate($request->page);
        else
        $categorys=Category::select('id','name')->active()->get();
        return $this->returnData('data', $categorys);

  }
  catch(Exception $exp){
    return $this->returnError($exp->getCode(), $exp->getMessage());
  }
}



}