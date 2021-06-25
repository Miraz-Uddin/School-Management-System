<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::latest()->paginate( 5 );
        
        return view( 'admin.category.index', [
            'datas' => $categories,
        ] );
    }

    public function trashes(){
        $deletedCategories = Category::onlyTrashed()->orderBy('deleted_at','DESC')->paginate( 3 );
        return view( 'admin.category.trash', [
            'datas' => $deletedCategories,
        ] );
    }

    public function create() {
        return view( 'admin.category.create' );
    }

    public function store( Request $request ) {

        $request->validate( [
            'category_name' => 'required|unique:categories|max:255',
        ], [
            'category_name.required' => 'Please Input Category Name',
            'category_name.unique'   => 'Please Create a Unique Category',
        ] );

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect( route( 'categories' ) )->with( 'success', 'Category Inserted Successfully' );
    }

    public function edit( $id ) {
        $category = Category::find( $id );
        return view( 'admin.category.edit', compact( 'category' ) );
    }

    public function update( Request $request, $id ) {

        $request->validate( [
            'category_name' => "required|unique:categories,category_name,$id|max:255",
        ], [
            'category_name.required' => 'Please Input Category Name',
            'category_name.unique'   => 'Please Update a Unique Category',
        ] );

        Category::findOrFail( $id )->update( [
            'category_name' => $request->category_name,
            'user_id'       => Auth::id(),
        ] );

        return redirect( route( 'categories' ) )->with( 'update', 'Category Updated Successfully' );
    }

    public function delete($id){
        Category::findOrFail( $id )->delete();
        return redirect()->back()->with( 'delete', 'A Category has been Moved to Trash' );
    }

    public function restore($id){
        Category::withTrashed()->findOrFail( $id )->restore();
        return redirect()->back()->with( 'restore', 'A Category has been Restored' );
    }

    public function destroy($id){
        Category::onlyTrashed()->findOrFail( $id )->forceDelete();
        return redirect()->back()->with( 'destroy', 'A Category has been Deleted Permanently' );
    }

}
