<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('media/images'), $imageName);



        return response()->json([
            'location' => asset('media/images/' . $imageName)
        ]);
    }
}
