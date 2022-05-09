<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('categories', $request->photo);
            }
            if (!$request->has('active'))

                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            DB::beginTransaction();
            Category::insert(
                [
                    'name' => $request->name,
                    'details' => $request->description,
                    'statuse' => $request->active,
                    'photo' => $filePath,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]
            );
            DB::commit();
            return  redirect()->route('admin.categorys')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {
            DB::rollBack();
            removeImage($filePath);
            return  redirect()->route('admin.categorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $categorys = Category::select()->find($id);
            if (!$categorys)
                return redirect()->route('admin.categorys')->with(['error' => 'هذة اللغة غير موجودة']);

            return view('admin.categories.ubdate', compact('categorys'));
        } catch (Exception $exp) {

            return  redirect()->route('admin.categorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $categorys = Category::select()->find($id);
            if (!$categorys) {
                return redirect()->route('admin.categorys')->with(['error' => 'هذة القسم غير موجودة']);
            }
            if (!$request->has('active')) {

                $request->request->add(['active' => 0]);
            } else {
                $request->request->add(['active' => 1]);
            }

            $filePath = $categorys->photo;
            if ($request->has('photo')) {
                removeImage($filePath);
                $filePath = uploadImage('categories', $request->photo);
            }
            Category::where('id', $id)->update([
                'name' => $request->name,
                'details' => $request->description,
                'statuse' => $request->active,
                'photo' => $filePath,
                'updated_at' => Carbon::now(),
            ]);
            return  redirect()->route('admin.categorys')->with(['success' => 'تم التحديث بنجاح']);

        } catch (Exception $exp) {

            return  redirect()->route('admin.categorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        
    }
}
