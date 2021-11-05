<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required'
        ]);
        $cat = array();
        $cat['name'] = $request->name;

        $category = Category::create($cat);
        $input = array();
        if ($request->hasFile('image') && $request->image != null) {
            $image = $request->file('image');
            $destinationPath = 'image/';
            $profileImage = "image/" . date('Y-m-d-His') . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['imagefile'] = "$profileImage";
        }

        $category->image()->create($input);
        return redirect(route('categories.index'));

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $input = array();

        if ($request->hasFile('image') && $request->image != null) {
            $image = $request->file('image');
            // $imagePath = public_path('public/' . $category->image);
            if (File::exists($category->image)) {
                unlink($category->image);
            }
            $destinationPath = 'image/';
            $profileImage = "image/" . date('Y-m-d-His') . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $category->update($input);
        return redirect(route('categories.index'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (File::exists($category->image)) {
            unlink($category->image);
        }
        $category->delete();
        return redirect(route('categories.index'));
    }

    public function dropzoneindex()
    {
        return view('category.dropzone');
    }

    public function dropzonestore(Request $request)
    {
        // $category = Category::findOrFail(1);
        $category = User::findOrFail($request->user_id);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('images'), $fileName);
        $category->image()->create(['imagefile' => $fileName]);
        return response()->json(['success' => $fileName]);
        // $input = array();
        // if ($request->hasFile('file') && $request->image != null) {
        //     $image = $request->file('file');
        //     $destinationPath = 'image/';
        //     $profileImage = "image/" . date('Y-m-d-His') . "-" . $image->getClientOriginalName();
        //     $image->move($destinationPath, $profileImage);
        //     $input['imagefile'] = "$profileImage";
        // }

        // $category->image()->create($input);
        // return response()->json(['success' => $input['imagefile']]);
    }
}