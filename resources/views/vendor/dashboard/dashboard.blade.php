@extends('vendor.layouts.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Today's Orders</p>
                      <h4 style="color:#ffff">{{$todaysOrder}}</h4>
                    </a>
                  </div>
                  <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Td's Pending Orders</p>
                      <h4 style="color:#ffff">{{$todaysPendingOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Total Orders</p>
                      <h4 style="color:#ffff">{{$totalOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Total Pending Orders</p>
                      <h4 style="color:#ffff">{{$totalPendingOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.orders.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Completed Orders</p>
                      <h4 style="color:#ffff">{{$totalCompleteOrder}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item red" href="{{route('vendor.products.index')}}">
                      <i class="fas fa-cart-plus"></i>
                      <p>Total Products</p>
                      <h4 style="color:#ffff">{{$totalProducts}}</h4>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                    <i class="fas fa-star"></i>
                    <p>review</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                    <i class="far fa-heart"></i>
                    <p>wishlist</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('vendor.profile')}}">
                    <i class="fas fa-user-shield"></i>
                    <p>profile</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                    <i class="fal fa-map-marker-alt"></i>
                    <p>address</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
