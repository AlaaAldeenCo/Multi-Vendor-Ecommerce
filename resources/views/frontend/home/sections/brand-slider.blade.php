<section id="wsus__brand_sleder" class="brand_slider_2">
    <div class="container">
        <div class="brand_border">
            <div class="row brand_slider">

                @foreach ($brands as $brand)
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="{{asset($brand->logo)}}" alt="{{$brand->name}}" class="img-fluid w-100">
                    </div>
                </div>
                @endforeach


                {{-- <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_2.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_3.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_4.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_5.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_6.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="wsus__brand_logo">
                        <img src="images/brand_logo_3.jpg" alt="brand" class="img-fluid w-100">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
