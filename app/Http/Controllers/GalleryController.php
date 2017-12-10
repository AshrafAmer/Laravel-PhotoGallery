<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GalleryController extends Controller
{

    private $table = 'galleries';

    // list Galleries
    public function index(){
        // Get All Galleries
        $galleries = DB::table($this->table)->get();

        return view('gallery/index', compact('galleries'));
    }

    // Create Form
    public function create(){
        return view('gallery/create');
    }

    // store Form to DB
    public function store(Request $request){
        // GET Request Input
        $name = $request->input('name');
        $description = $request->input('description');
        $cover_image = $request->file('cover_image');
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
                'name' => $name,
                'description' => $description,
                'cover_image' => $fileNameToStore,
                'owner_id' => $owner_id
            ]
        );

        // Redirect
        return \Redirect::route('gallery.index')->with('message', 'Gallery Created');
    }

    // Show Galleries From DB
    public function show($id){
        // Get Galary
        $gallery = DB::table($this->table)->where('id', $id)->first();
        
        $photos = DB::table('photos')->where('gallery_id', $id)->get();

        return view('gallery/show', compact('gallery', 'photos'));


    }
}
