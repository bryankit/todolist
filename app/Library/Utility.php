<?php

namespace App\Library;

class Utility
{
    /**
     * Set the file path for the uploaded image.
     *
     * @param \Illuminate\Http\Request $request
     * @return string The file path of the uploaded image
     */
    public static function setFilePath($request)
    {
        $filePath = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('images', $filename);
            $filePath = '/images/' . $filename;
        }
        return $filePath;
    }
}