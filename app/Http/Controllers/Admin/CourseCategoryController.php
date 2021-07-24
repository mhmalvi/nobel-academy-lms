<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Support\AppCryption;
use App\Models\CourseCategory;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCategoryResource;
use App\Http\Resources\CourseCategory as CourseCategoryCollection;
use App\Http\Requests\CourseCategoryRequest as CategoryRequest;

class CourseCategoryController extends Controller
{
    /**
     * Category Collections
     */
    public function getData()
    {
        return new CourseCategoryCollection(CourseCategory::all());
    }



    /**
     * return create catgory page
     * with created categories
     */
    public function index()
    {
        $categories = CourseCategory::orderBy('created_at', 'desc')->get();
        return view('admin.categories.create', compact('categories'));
    }



    /**
     * Store newly created categories
     * CategoryRequest check for valid request
     */
    public function storeOrUpdate(CategoryRequest $request)
    {
        try {
            $category = $request->createOrUpdate();

            $notification = [
                'message'   =>  "{$category->category_name} successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Get by id
     */
    public function edit(Request $request)
    {
        try {

            $id = AppCryption::encrypt($request->id);
            return new CourseCategoryResource(
                CourseCategory::where('uuid', $id)->first()
            );
        } catch (\Throwable $th) {
            return response()->json([
                'data' => AppExceptions::throwback($th),
                'status' => 404
            ]);
        }
    }



    /**
     * Remove Data
     */
    public function destroy(Request $request)
    {
        $arr = $request->id;
        $csv = implode(", ", array_map(function ($arr) {
            return AppCryption::decrypt($arr);
        }, $arr));

        try {
            DB::delete("DELETE FROM course_categories WHERE id IN ($csv)");
            return response()->json(['status' => 200]);
        } catch (\Throwable $th) {
            /**
             * Return exception
             */
            return response()->json([
                'data' => AppExceptions::throwback($th),
                'status' => 404
            ]);
        }
    }
}
