<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostController extends Controller
{
      public function writePost()
    {
      $category = DB::table('categories')->get();
      return view('post.writepost',compact('category'));
    }

    public function storePost(Request $request)
    {
      $validatedData = $request->validate([
        'title' => 'required | max:200',
        'details' => 'required',
        'image' => 'required | mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:1000',
    ]);
      $data = array();
      $data['title'] = $request->title;
      $data['details'] = $request->details;
      $data['category_id'] = $request->category_id;
      $image = $request->file('image');

      if ($image) {
        $image_name = hexdec(uniqid());
        $ext = strtolower($image->getclientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'public/frontend/image/';
        $image_url = $upload_path.$image_full_name;
        $success = $image->move($upload_path, $image_full_name);
        $data['image'] = $image_url;
        $post = DB::table('posts')->insert($data);
        $notification=array(
          'message'=>'Successfully Posted',
          'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

      }else {
        {
          $post = DB::table('posts')->insert($data);
          $notification=array(
            'message'=>'Successfully Posted',
            'alert-type'=>'success'
          );
          return Redirect()->back()->with($notification);
        }
      }
    }


    public function AllPost()
    {
      $post = DB::table('posts')
      ->join('categories', 'posts.category_id', 'categories.id')
      ->select('posts.*','categories.name')
      ->get();
      return view('post.all_post',compact('post'));
    }

    public function ViewPost($id)
    {
      $post = DB::table('posts')
            ->join('categories','posts.category_id','categories.id')
            ->select('posts.*','categories.name')
            ->where('posts.id',$id)
            ->first();
            //return response()->json($post);
            return view('post.view_post',compact('post'));
    }


    public function EditPost($id)
    {
      $category = DB::table('categories')->get();
      $post = DB::table('posts')->where('id',$id)->first();
      return view('post.edit_post',compact('post','category'));
    }


    public function UpdatePost(Request $request, $id)
    {
      $validatedData = $request->validate([
        'title' => 'required | max:200',
        'details' => 'required',
        'image' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:1000',
    ]);
      $data = array();
      $data['title'] = $request->title;
      $data['details'] = $request->details;
      $data['category_id'] = $request->category_id;
      $image = $request->file('image');

      if ($image) {
        $image_name = hexdec(uniqid());
        $ext = strtolower($image->getclientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'public/frontend/image/';
        $image_url = $upload_path.$image_full_name;
        $success = $image->move($upload_path, $image_full_name);
        $data['image'] = $image_url;

        unlink($request->old_image);
        DB::table('posts')->where('id',$id)->update($data);

        $notification=array(
          'message'=>'Successfully Posted',
          'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

      }else {
        {
          $data['image'] = $request->old_image;
        $post = DB::table('posts')->where('id',$id)->update($data);
          $notification=array(
            'message'=>'Successfully Posted',
            'alert-type'=>'success'
          );
          return Redirect()->route('all.post')->with($notification);
        }
      }


    }


    public function DeletePost($id)
    {
      $post = DB::table('posts')->where('id',$id)->first();
    $image = $post->image;


    $delete=DB::table('posts')->where('id',$id)->delete();

    if ($delete) {
      unlink($image);
      $notification=array(
        'message'=>'Successfully Post Deleted',
       'alert-type'=>'success'
      );
      return Redirect()->route('all.post')->with($notification);
    }
    else {
      $notification=array(
        'message'=>'Something went wrong!!',
        'alert-type'=>'error'
      );
      return Redirect()->route('all.post')->with($notification);
    }
    }


}
