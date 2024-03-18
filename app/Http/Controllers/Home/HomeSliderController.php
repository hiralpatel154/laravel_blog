<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Illuminate\Support\Facades\Auth;

class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_page', compact('homeslide'));
    }
    public function UpdateSlider(Request $request)
    {
        $sid = $request->id;

        if ($request->file('home_slide')) {
            $file = $request->file('home_slide');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/home_slides'), $filename);
            $data['home_slide'] = $filename;
            HomeSlide::findOrFail($sid)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => 'upload/home_slides/'.$filename,
            ]);
            $notification = array(
                'message' => "Home Slide Upadted with Image Successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
      else {
            HomeSlide::findOrFail($sid)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);
            $notification = array(
                'message' => "Home Slide Upadted without Image Successfully",
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
