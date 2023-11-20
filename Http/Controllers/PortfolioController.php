<?php

namespace Modules\Portfolio\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Base\Entities\Photo;
use Modules\Portfolio\Entities\Portfolio;
use Modules\Portfolio\Entities\PortfolioCategory;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Portfolio::all();

        return view('portfolio::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = PortfolioCategory::all();

        return view('portfolio::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:portfolios'
        ]);
        try {
            $item = Portfolio::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'customer' => $request->customer,
                'time' => $request->time,
                'services' => $request->services,
                'image' => (isset($request->image)?file_store($request->image, 'assets/uploads/photos/portfolios_images/','photo_'):null),
                'before' => (isset($request->before)?file_store($request->before, 'assets/uploads/photos/portfolios_before/','photo_'):null),
                'after' => (isset($request->after)?file_store($request->after, 'assets/uploads/photos/portfolios_after/','photo_'):null)
            ]);

            if (isset($request->photo)){
                foreach ($request->photo as $ph){
                    $photo = new Photo();
                    $photo->path = file_store($ph, 'assets/uploads/photos/portfolio_gallery/', 'photo_');
                    $item->photos()->save($photo);
                }
            }

            return redirect()->route('portfolios.index')->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('portfolio::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Portfolio $Portfolio)
    {
        $categories = PortfolioCategory::all();

        return view('portfolio::edit', compact('Portfolio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Portfolio $Portfolio)
    {
        try {
            $Portfolio->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'customer' => $request->customer,
                'time' => $request->time,
                'services' => $request->services,
            ]);

            if (isset($request->image)) {
                if ($Portfolio->image){
                    File::delete($Portfolio->image);
                }
                $Portfolio->image = file_store($request->image, 'assets/uploads/photos/portfolios_images/', 'photo_');
                }
            if (isset($request->before)) {
                if ($Portfolio->before){
                    File::delete($Portfolio->before);
                }
                $Portfolio->before = file_store($request->before, 'assets/uploads/photos/portfolios_before/', 'photo_');
            }
            if (isset($request->after)) {
                if ($Portfolio->after){
                    File::delete($Portfolio->after);
                }
                $Portfolio->after = file_store($request->after, 'assets/uploads/photos/portfolios_after/', 'photo_');
            }
            $Portfolio->save();

            if (isset($request->photo)){
                foreach ($request->photo as $key => $ph){
                    if (isset($Portfolio->photos[$key])){
                        File::delete($Portfolio->photos[$key]->path);
                        $Portfolio->photos[$key]->path = file_store($ph, 'assets/uploads/photos/portfolio_gallery/', 'photo_');
                        $Portfolio->photos[$key]->save();
                    }else {
                        $photo = new Photo();
                        $photo->path = file_store($ph, 'assets/uploads/photos/portfolio_gallery/', 'photo_');
                        $Portfolio->photos()->save($photo);
                    }
                }
            }

            return redirect()->route('portfolios.index')->with('flash_message', 'با موفقیت بروزرسانی شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Portfolio $Portfolio)
    {
        try {
            $Portfolio->delete();

            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function photo_destroy(Photo $photo)
    {
        try {
            $photo->delete();

            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
