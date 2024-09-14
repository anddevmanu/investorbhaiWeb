<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){

        $categories = Category::orderBy('id', 'desc')->paginate(10);


        $user = Auth::user();

        if($user->role === 'admin'){
            return view('admin.pages.category.list', compact('categories'));
        }elseif($user->role === 'editor'){
            return view('editor.pages.category.list', compact('categories'));
        }

        return abort(403, 'Unauthorized action.');
    }


    public function create(){
        $user = Auth::user();

        if($user->role === 'admin'){
            return view('admin.pages.category.create');
        }elseif($user->role === 'editor'){
            return view('editor.pages.category.create');
        }

        return abort(403, 'Unauthorized action.');
    }

    public function store(Request $request){
       $validated = $request->validate([
            'category_name' => 'required|string|unique:tbl_categories,category_name',
            'category_description' => 'nullable|string',
            'status' => 'required'
        ]);

        Category::create([
            'category_name' => $validated['category_name'],
            'category_description' => $validated['category_description'],
            'status' => $validated['status']
        ]);

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('category.list')->with('message', 'Category Created Successfully!');
        } elseif ($user->role === 'editor') {
            return redirect()->route('category.list')->with('message', 'Category Created Successfully!');
        }

        return abort(403, 'Unauthorized action.');
    }

    public function edit($id){

        $category = Category::findOrFail($id);

        $user = Auth::user();

        if($user->role === 'admin'){
            return view('admin.pages.category.edit', compact('category'));
        }elseif($user->role === 'editor'){
            return view('editor.pages.category.edit', compact('category'));
        }

        return abort(403, 'Unauthorized action.');
    }

    public function update(Request $request, $id)
    {
    // Validate the request data
        $validated = $request->validate([
            'category_name' => 'required|string|unique:tbl_categories,category_name,' . $id,
            'category_description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

         // Update the category with the validated data
        $category->update([
            'category_name' => $validated['category_name'],
            'category_description' => $validated['category_description'],
            'status' => $validated['status'],
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('category.list')->with('message', 'Category updated successfully!');
        } elseif ($user->role === 'editor') {
            return redirect()->route('category.list')->with('message', 'Category updated successfully!');
        }

        // Default redirect for unauthorized access
        return abort(403, 'Unauthorized action.');
    }

    public function delete($id)
{
    // Find the category by ID
    $category = Category::findOrFail($id);

    // Delete the category
    $category->delete();

    // Get the authenticated user
    $user = Auth::user();

    // Redirect based on user role
    if ($user->role === 'admin') {
        return redirect()->route('category.list')->with('message', 'Category deleted successfully!');
    } elseif ($user->role === 'editor') {
        return redirect()->route('category.list')->with('message', 'Category deleted successfully!');
    }

    // Default redirect in case of unauthorized access
    return abort(403, 'Unauthorized action.');
}


}
