<?php

namespace App\Repositories;

use App\Models\Marker;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class MarkerRepository extends Repository 
{
    public function __construct(Marker $marker) 
    {
        $this->model = $marker;
    }
    
    public function addMarker($request) 
    {
        $data = $request->except(['_token', 'image']);

        if (empty($data)) {
            return ['error'=>'No data'];
        }

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');

            // resize uploaded image
            if ($image->isValid()){
                $img = Image::make($image);
                $str = Str::random(5);
                $img_name = $str.'.jpg';

                $img->fit(300, 200)->save(public_path().'/'.config('settings.theme').'/images/markers/'.$img_name);

                $data['img'] = $img_name;
            }
        }

        $this->model->fill($data);

        $request->user()->markers()->save($this->model);
    }

    public function updateMarker($request, $marker) 
    {
        $data = $request->except(['_token', 'image', '_method']);
        
        if (empty($data)) {
            return ['error'=>'No data'];
        }
        
        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            // resize uploaded image
            if ($image->isValid()){
                $img = Image::make($image);
                $str = Str::random(5);
                $img_name = $str.'.jpg';

                $img->fit(300, 200)->save(public_path().'/'.config('settings.theme').'/images/markers/'.$img_name);

                $data['img'] = $img_name;
            }
        }

        $marker->fill($data);

        $marker->update();
    }

    public function deleteMarker($marker) 
    {
        // delete information about comments
        $marker->comments()->delete();

        $marker->delete(); 
    }
}
