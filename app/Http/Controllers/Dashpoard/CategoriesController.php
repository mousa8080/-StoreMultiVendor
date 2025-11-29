<?php

namespace App\Http\Controllers\Dashpoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::paginate(2); //Return collection object //paginate difult 15 record.
        $request = request();
        // $query=Category::query();
        // if($name=$request->query('name')){
        //     $query->where('name','like',"%{$name}%");
        // }
        // if($status=$request->query('status')){
        //     $query->where('status',$status);
        // }

        // $categories = $query->paginate();
        // $categories = Category::active()->paginate();
        // DB::table('categories')->where('status','archived')->paginate()->dd();
        // $categories = Category::status('archived')->active()->paginate()->dd();

        // $categories = Category::filter($request->query())
        // ->latest()
        // ->orderBy('name','asc')
        // ->paginate();

        //selecta.*,b.name as parent_name from categories left join categoryeis as b on a.id=b.parent_id
        //join  select all from categories as a

        $categories = Category::/*leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parents.name as parent_name'])
            ->filter($request->query())
            // ->withTrashed() //come all categories include deleted
            // ->onlyTrashed() //come only deleted categories
            ->orderBy('categories.name')*/with('parent')
            // ->select('categories.*')
            // ->selectRaw('(select count(*) from products where products.category_id=categories.id) as products_count')
            ->withCount([
                'products as products_number' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->filter($request->query())
            ->paginate();
        //Return collection object //paginate difult 15 record.
        // $categories->first(); //Return object
        return view('dashpoard.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $parents = Category::all(); //Return collection object
        $category = new Category();

        return view('dashpoard.Categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->input('name');//url
        // $request->post('name');//post
        // $request->query('name');//url
        // $request->get('name');//url or post
        // $request->name;
        // $request['name'];
        // $request->all(); //return array of all input data
        // $request->only(['name','parent_id']); //return array of all input data only name
        // $request->except(['image','status']); //return array of all input data except name


        // $category=new Category($request->all());
        // $category->name=$request->post('name');
        // $category->parent_id=$request->post('parent_id');
        // $category->image=$request->file('image')->store('categories');
        // $category->status=$request->pos('status');
        // $category->save();
        // ['imge'=>'$path']

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $path = $file->store('uploads', ['disk' => 'public']);
        //     // $file->getClientOriginalName();
        //     // $file->getClientOriginalExtension();
        //     // $file->getClientMimeType(); //image/jpeg or png
        //     // $file->getSize();
        // }

        $request->validate(
            Category::rules(),
            [
                'name.unique' => 'this name is uniqe mousa',
                'name.required' => ' (:attribute) لازم تدخل الاسم يسطا'
            ]

        );

        $data = $request->except('image'); // data full except image
        $data['slug'] = Str::slug($request->name); // Add slug to data
        $data['image'] = $this->uploadImage($request); //override  'image' in $data
        if ($data['image']) {
            $data['image'] = $this->uploadImage($request);
        }
        //mass assiginment
        $category = Category::create($data);
        //PRG
        return redirect()->route('dashpoard.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = $category->products()->with('store')->paginate(5);
        return view('dashpoard.Categories.show', compact('category', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashpoard.categories.index')->with('info', 'Category not found');
        }
        $parents = Category::where(column: 'id', operator: '!=', value: $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '!=', $id);
            })->get();
        // if(!$category){
        //     return redirect()->route('dashpoard.categories.index')->with('danger', 'Category not found');== findorfild
        // }
        return view('dashpoard.Categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {

        $category = Category::findOrFail($id);
        $old_image = $category->image; // Get the old image path from database
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']); // Update slug when name changes
        $newImage = $this->uploadImage($request); //override  'image' in $data
        if ($newImage) {
            $data['image'] = $newImage;
        }

        $category->update($data);
        if ($old_image && $newImage) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashpoard.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //========================= delete image 
        // $category = Category::findOrFail($id);
        $category->delete();
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        //=========================
        // Category::where('id', $id)->delete();

        //=========================
        // Category::destroy($id);
        //=========================
        // Category::find($id)->delete();

        return redirect()->route('dashpoard.categories.index')->with('success', 'Category deleted successfully');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
    public function trashed()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashpoard.Categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashpoard.categories.trashed')->with('success', 'Category restored successfully');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashpoard.categories.trashed')->with('success', 'Category force deleted successfully');
    }
}
