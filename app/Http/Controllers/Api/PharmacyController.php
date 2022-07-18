<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PharmacyController extends Controller
{
    use GeneralTrait;



    public function getMedicationByOfPharmacy(Request $request)
    {
        try {
            $data_array = [];
            $validator = Validator::make($request->all(), [
                'pharmacy_id' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->returnError("E001", $validator->getMessageBag()->toArray());
            }
            $pharmacy = MyPharmacy::find($request->pharmacy_id);
            if (!$pharmacy) {
                return $this->returnError('E001', 'هذاالمنتج  موجود');
            }

            $medications = $pharmacy->medications;
            foreach ($medications as $medication) {
                $data = MedicationMypharmacy::where(['mypharmacy_id' => $request->pharmacy_id, 'medication_id' => $medication->id])->first();

                $data_array[] = [
                    'id' => $medication->id,
                    'quntity' => $data->quntity,
                    'name' => $medication->trade_name,
                    'scientific_name' => $medication->scientific_name,
                    'photo' => $medication->photo,
                    'price' => $data->price,
                    'production_date' => $data->production_date,
                    'expiry_date' => $data->expiry_date
                ];
            }
            return $this->returnData('data', $data_array);
        } catch (Exception $exp) {
            return $this->returnError($exp->getCode(), $exp->getMessage());
        }
    }
}
