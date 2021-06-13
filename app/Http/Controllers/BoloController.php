<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BoloController extends Controller
{
    
    public function addCategory()
    {
      return view('post.addcategory');
    }

    public function storeCategory(Request $request)
    {

      $validatedData = $request->validate([
        'name' => 'required|max:25|min:4',
        'slug' => 'required|max:25|min:4',
    ]);

      $data = array();
      $data['name'] = $request->name;
      $data['slug'] = $request->slug;
      $category = DB::table('categories')->insert($data);

      if ($category) {
         $notification=array(
           'message'=>'Successfully Category Inserted',
           'alert-type'=>'success'
         );
         return Redirect()->route('all.category')->with($notification);
      }else {
        $notification=array(
          'message'=>'Something Wrong!',
          'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
      }

    }


    public function AllCategory()
    {
      $category = DB::table('categories')->get();
      return view('post.all_category',compact('category'));
    }
    public function ViewCategory($id)
    {
      $category = DB::table('categories')->where('id',$id)->first();
      return view('post.view_category', compact('category'));
    }

    public function DeleteCategory($id)
    {
      $delete = DB::table('categories')->where('id',$id)->delete();
      $notification=array(
        'message'=>'Category Successfully Deleted!',
        'alert-type'=>'error'
      );
      return Redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        return view('post.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request , $id)
    {

      $validatedData = $request->validate([
        'name' => 'required|max:25|min:4',
        'slug' => 'required|max:25|min:4',
    ]);

      $data = array();
      $data['name'] = $request->name;
      $data['slug'] = $request->slug;
      $category = DB::table('categories')->where('id',$id)->update($data);

      if ($category) {
         $notification=array(
           'message'=>'Successfully Category Updated',
           'alert-type'=>'success'
         );
         return Redirect()->route('all.category')->with($notification);
      }else {
        $notification=array(
          'message'=>'Nothing Updated!',
          'alert-type'=>'error'
        );
        return Redirect()->route('all.category')->with($notification);
      }


    }

}
