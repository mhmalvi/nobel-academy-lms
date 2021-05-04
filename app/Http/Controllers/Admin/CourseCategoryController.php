<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Support\AppCryption;
use App\Models\CourseCategory;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $id = [
                'id' => ($request->id) ? AppCryption::decrypt($request->id) : null,
            ];

            $data = [
                'action_user' => Auth::id(),
                'category_code' => ($request->code) ? Str::ucfirst($request->code) : null,
                'category_name' => $request->category_name,
                'descriptions' => $request->descriptions
            ];

            $category = CourseCategory::updateOrCreate($id, $data);

            if ($category->id) {
                $category->uuid = $category->id;
                $category->save();
                $notification = [
                    'message'   =>  "{$category->category_name} successfully saved",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);
            }
        } catch (\Throwable $th) {
            /**
             * Return exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Get by id
     */
    public function edit(Request $request)
    {
        try {

            $id = AppCryption::decrypt($request->id);
            return new CourseCategoryResource(
                CourseCategory::findOrFail($id)
            );
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
