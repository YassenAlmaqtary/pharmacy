<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicationRequest;
use App\Models\Category;
use App\Models\Medication;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user_id=MedicationMypharmacy::where('user_id',Auth::user()->id)->get();
        
        
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
            return "sucsses";
            
         }
        
        catch (Exception $exp) {
            DB::rollBack();
            removeImage($filePath);
            return $exp;
            return "erro";
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
