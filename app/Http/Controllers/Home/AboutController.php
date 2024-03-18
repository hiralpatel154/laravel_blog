<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }
    public function UpdateAbout(Request $request)
    {
        $aboutid = $request->id;

        if ($request->file('about_image')) {
            $file = $request->file('about_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/about_images'), $filename);
            $data['about_image'] = $filename;
            About::findOrFail($aboutid)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'about_image' => 'upload/about_images/'.$filename,
            ]);
            $notification = array(
                'message' => "About Page Upadted with Image Successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
      else {
            About::findOrFail($aboutid)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
            ]);
            $notification = array(
                'message' => "About Page Upadted without Image Successfully",
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
