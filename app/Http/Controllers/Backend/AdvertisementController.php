<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $homepage_secion_banner_one = Adverisement::where('key', 'homepage_secion_banner_one')->first();
        $homepage_secion_banner_one = json_decode($homepage_secion_banner_one->value);
        return view('admin.advertisement.index', compact('homepage_secion_banner_one'));
    }

    public function homepageBannerSecionOne(Request $request)
    {
        $request->validate([
            'banner_image' => ['image'],
            'banner_url' => ['required']
           ]);

        $imagePath = $this->uploadImage($request, 'banner_image', 'uploads');

        $value =
        [
        'banner_one' =>[
            'banner_url' => $request->banner_url,
            'status' => $request->status == 'on' ? 1 : 0
        ]
        ];
        if(!empty($imagePath))
        {
            $value['banner_one']['banner_image'] = $imagePath;
        }
        else
        {
            $value['banner_one']['banner_image'] = $request->banner_old_image;
        }
        $value = json_encode($value);


        Adverisement::updateOrCreate(
        [ 'key' => 'homepage_secion_banner_one' ],
        [ 'value' => $value ]
        );
        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->back();
    }
}
