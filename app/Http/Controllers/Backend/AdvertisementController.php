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

        $homepage_secion_banner_two = Adverisement::where('key', 'homepage_secion_banner_two')->first();
        $homepage_secion_banner_two = json_decode($homepage_secion_banner_two?->value);
        return view('admin.advertisement.index', compact('homepage_secion_banner_one', 'homepage_secion_banner_two'));
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

    public function homepageBannerSecionTwo(Request $request)
    {
        $request->validate([
            'banner_one_image' => ['image'],
            'banner_one_url' => ['required'],
            'banner_two_image' => ['image'],
            'banner_two_url' => ['required']
        ]);

        $imagePath = $this->updateImage($request, 'banner_one_image', 'uploads');
        $imagePathTwo = $this->updateImage($request, 'banner_two_image', 'uploads');

        $value = [
            'banner_one' =>[
                'banner_url' => $request->banner_one_url,
                'status' => $request->banner_one_status == 'on' ? 1 : 0
            ],
            'banner_two' =>[
                'banner_url' => $request->banner_two_url,
                'status' => $request->banner_two_status == 'on' ? 1 : 0
            ]
        ];

        if(!empty($imagePath))
        {
            $value['banner_one']['banner_image'] = $imagePath;
        }

        else
        {
            $value['banner_one']['banner_image'] = $request->banner_one_old_image;
        }

        if(!empty($imagePathTwo))
        {
            $value['banner_two']['banner_image'] = $imagePathTwo;
        }

        else
        {
            $value['banner_two']['banner_image'] = $request->banner_two_old_image;
        }

        $value = json_encode($value);
        Adverisement::updateOrCreate(
            [ 'key' => 'homepage_secion_banner_two' ],
            [ 'value' => $value ]
            );
            toastr('Updated Successfully!', 'success', 'success');
            return redirect()->back();

    }
}
