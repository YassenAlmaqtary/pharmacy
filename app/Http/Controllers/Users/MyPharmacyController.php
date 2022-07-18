<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParnacyRequest;
use App\Http\Requests\ParnacyRequestExsist;
use App\Models\Medication;
use App\Models\MedicationMypharmacy;
use App\Models\MyPharmacy;
use Carbon\Carbon;
use Doctrine\DBAL\Schema\View;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class MyPharmacyController extends Controller
{
    public function __construct()
    {
      
    $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharamcys=MyPharmacy::where(['user_id'=>Auth::user()->id])->selection()->get();
         
       return view('user.pharmacy.index',compact('pharamcys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('user.pharmacy.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParnacyRequest $request)
    {  
        try{
            $chek_data =MyPharmacy::select('id','name')->where('user_id',Auth::user()->id)->get();
            if(count($chek_data)>0){
                return  redirect()->route('user.pharmacy')->with(['success' => 'لقد اضفت من قبل']);
            }
             //return  time().'.'.$request->pdf->extension();
             $filePath="";
             $pdfPath="";
            
            if ($request->has('photo')) {
                $filePath = uploadImage('users', $request->photo);
            }
            if ($request->has('pdf')) {
                $pdfPath = uploadPdf('cves', $request->pdf);
            
            }
            // if (!$request->has('active'))

            //     $request->request->add(['active' => 0]);
            // else
            //     $request->request->add(['active' => 1]);

            DB::beginTransaction();
           
           MyPharmacy::insert(
            [
                'name' => $request->name,
               // 'statuse' => $request->active,
                'photo' => $filePath,
                'pdf_path'=>$pdfPath,
                'mobile1'=>$request->mobile1,
                'mobile2'=>$request->mobile2,
                'social_media'=>$request->social,
                'address'=>$request->address,
                'adderss_details'=>$request->adderss_details,
                'user_id'=>Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::commit();
            return  redirect()->route('user.pharmacy')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {
            DB::rollBack();
          removepdf($pdfPath);
            removeImage($filePath);
            return  redirect()->route('user.pharmacy')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        

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
            $pharmacy=MyPharmacy::find($id);
            
            if (!$pharmacy){
                 return redirect()->route('user.pharmacy')->with(['error' => 'هذة القسم غير موجودة']);
            }    
                
                 return view('user.pharmacy.ubdate',compact('pharmacy')); 
        }
        catch(Exception $exp){
            return  redirect()->route('user.pharmacy')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParnacyRequestExsist $request, $id)
     { 
    
    try {
        
        $pharmacy = MyPharmacy::find($id);
        if (!$pharmacy) {
            return redirect()->route('user.pharmacy')->with(['error' => 'هذة القسم غير موجودة']);
        }
        
        $chek_name=$this->valdtionHeleberPharmacy('name',$request->name);
        if($chek_name->count()>0){
            return redirect()->route('user.pharmacy')->with(['error' => 'اسم الصيدلية موجود مع مستخدم اخر']);
        }

        $chek_mobile1=$this->valdtionHeleberPharmacy('mobile1',$request->mobile1);
        if($chek_mobile1->count()>0){
            return redirect()->route('user.pharmacy')->with(['error' => 'رقم الموبايل موجود مع مستخدم اخر']);
        }
        $chek_mobile2=$this->valdtionHeleberPharmacy('mobile2',$request->mobile2);
        if($chek_mobile2->count()>0){
            return redirect()->route('user.pharmacy')->with(['error' => 'رقم الهاتف موجود مع مستخدم اخر']);
        }
        // if (!$request->has('active') ) {

        //     $request->request->add(['active' => 0]);
        // } else {
        //     $request->request->add(['active' => 1]);
        // }


        $filePath = $pharmacy->photo;
        if ($request->has('photo')) {
            removeImage($filePath);
            $filePath = uploadImage('categories', $request->photo);
        }
        $pdfPath = $pharmacy->pdf_path;
        if ($request->has('pdf')) {
            removepdf($pdfPath);
            $pdfPath = uploadpdf('cves', $request->pdf);
        }
        
        MyPharmacy::where('id', $id)->update([
            'name' => $request->name,
            'photo' => $filePath,
            'pdf_path'=>$pdfPath,
            'mobile1'=>$request->mobile1,
            'mobile2'=>$request->mobile2,
            'social_media'=>$request->social,
            'address'=>$request->address,
            'adderss_details'=>$request->adderss_details,
            'updated_at' => Carbon::now(),
        ]);
        return  redirect()->route('user.pharmacy')->with(['success' => 'تم التحديث بنجاح']);

    } catch (Exception $exp) {

        return  redirect()->route('user.pharmacy')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
            $myPharmacy=MyPharmacy::find($id);
            
            if(!$myPharmacy)
            return redirect()->route('user.medication')->with(['error' => 'هذة القسم غير موجودة']);
            $medications=$myPharmacy->medications;
            if($medications and $medications->count()>0)
            foreach($medications as $medication){
                MedicationMypharmacy::where('medication_id',$medication->id)->delete();
            }
           
            removeImage($myPharmacy->photo);
            $myPharmacy->delete();
            return  redirect()->route('user.pharmacy')->with(['success' => 'تم الحذف بنجاح']);
          
        }       
        
               
        
        catch(Expectation $exp){
            return  redirect()->route('user.pharmacy')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function valdtionHeleberPharmacy($coloum,$qury){

      $data= DB:: table('mypharmacys')
        ->where($coloum,'=',$qury)
        ->where('user_id','!=',Auth::user()->id)
        ->get();

        return $data;
    }
}
