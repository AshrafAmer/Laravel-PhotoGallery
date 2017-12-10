<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PhotoController extends Controller
{
    // Create Form - Add photo
    public function create($id){
        return view('photo/create', compact('id'));
    }

    // store photo to DB
    public function store(Request $request){
        // GET Request Input
        $gallery_id = $request->input('id');
        $title = $request->input('title');
        $description = $request->input('description');
        $location = $request->input('location');
        $cover_image = $request->file('image');
        $owner_id = 1;

        // check Image Uploading..
        if($cover_image){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            //$fileNameToStore = 'noimage.jpg';
        }
        // Insert into the DB
        DB::table($this->table)->insert(
            [
                'title' => $title,
                'description' => $description,
                'location' => $location,
                'gallery_id' => $gallery_id,
                'image' => $fileNameToStore,
                'owner_id' => $owner_id
            ]
        );

        // Redirect
        return \Redirect::route('gallery.show', array('id' => $gallery_id));
    }

    // Show photos details From DB
    public function details($id){
        // Get this Photo
        $photo = DB::table('photos')->where('id', $id)->first();

        return view('photo/details', compact('photo'));
    }
}
