<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use App\Http\Requests\AdsRequest;
use Session;
use File;

class AdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::all();
        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ads_data = new Ads;
        return view('ads.create', compact('ads_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        $aData = $request->all();

        if ($request->hasFile('file') && in_array( strtolower($request->file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png'] ) ) {
            $ads_image = $request->file;
            $filename = 'ads_' . time() . '_'. rand(11111, 99999) . '.' . $ads_image->getClientOriginalExtension();
            if (!file_exists(base_path() . '/public/img/'))
                File::makeDirectory(base_path() . '/public/img/', 0777, true, true);
                $path = base_path() . '/public/img/' . $filename;
            try {
                move_uploaded_file($request->file('file'), $path);
            } catch (\Exception $e) {
                Session::flash('flash_error_message', app('translator')->getFromJson('Something went wrong.'));
                return redirect()->back();
            }
            $aData['image_filename'] = $filename;
        }

        $ads = new Ads;
        $ads->fill($aData)->save();

        Session::flash('flash_message', app('translator')->getFromJson('Successfully saved'));
        return redirect()->route('ads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ads_data = Ads::findOrFail($id);
        return view('ads.view', compact('ads_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $ads_data = Ads::find($id);
        
        if(!$ads_data) {
            Session::flash('flash_error_message', app('translator')->getFromJson('Something went wrong.'));
            return redirect()->back();
        }

        return view('ads.edit', compact('ads_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, $id)
    {
        $ads_data = Ads::findOrFail($id);
        $input = $request->all();
        
        if ($request->hasFile('file') && in_array( strtolower($request->file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png'] ) ) {
            $ads_image = $request->file;
            $filename = 'ads_' . time() . '_'. rand(11111, 99999) . '.' . $ads_image->getClientOriginalExtension();
            if (!file_exists(base_path() . '/public/img/'))
                File::makeDirectory(base_path() . '/public/img/', 0777, true, true);
                $path = base_path() . '/public/img/' . $filename;
            try {
                move_uploaded_file($request->file('file'), $path);
                //remove old file
                $removeOldFile = (isset($ads_data->image_filename) && $ads_data->image_filename != "") ? \File::delete('img/'.$ads_data->image_filename) : '';
            } catch (\Exception $e) {
                Session::flash('flash_error_message', app('translator')->getFromJson('Something went wrong.'));
                return redirect()->back();
            }
            $input['image_filename'] = $filename;
        }

        $ads_data->fill($input)->save();

        Session::flash('flash_message', app('translator')->getFromJson('Successfully updated.'));
        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads_data = Ads::find($id);
        if ($ads_data) {
            $removeOldFile = (isset($ads_data->image_filename) && $ads_data->image_filename != "") ? \File::delete('img/'.$ads_data->image_filename) : '';
            $ads_data->delete();
            Session::flash('flash_message', app('translator')->getFromJson('Successfully deleted.'));
        } else {
            Session::flash('flash_error_message', app('translator')->getFromJson('Something went wrong.'));
        }
        return redirect()->route('ads.index');
    }
}