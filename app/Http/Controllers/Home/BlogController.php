<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));
    }
    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.add_blog', compact('categories'));
    }
    public function StoreBlog(Request $request)
    {
        $file = $request->file('blog_image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('upload/blog_images'), $filename);
        $data['blog_image'] = $filename;
        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => 'upload/blog_images/' . $filename,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);
    }
    public function EditBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.edit_blog', compact('blog', 'categories'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;
        if ($request->file('blog_image')) {
            $file = $request->file('blog_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/blog_images'), $filename);
            $data['blog_image'] = $filename;
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => 'upload/blog_images/' . $filename,

            ]);
            $notification = array(
                'message' => 'Blog Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        } else {

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,

            ]);

            $notification = array(
                'message' => 'Blog Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        }
    }
    public function DeleteBlog($id)
    {
        $blog = Blog::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function BlogDetail($id){
        $allblogs = Blog::latest()->limit(2)->get();
        $blogsdetail = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('frontend.blog_details',compact('blogsdetail','allblogs','categories'));
    }
    public function CategoryBlog($id) {
        $allblogs = Blog::latest()->limit(5)->get();
        $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details',compact('blogpost','allblogs','categories','categoryname'));
    }
    public function HomeBlog(){
        $allblogs = Blog::latest()->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('frontend.blog', compact('allblogs','categories'));
    }
    public function HomeMain() {
        return view('frontend.index');
    }
}
