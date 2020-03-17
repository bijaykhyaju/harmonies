@extends('layouts.user-layout')

@section('mainSection')
<div class="app-main__outer">
    <div class="app-main__inner">
      <div class="row">

            <a class="col-md-6 col-xl-4 dashboard-menu" href="{{ url('/music-gallery')}}">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                      <h2>Music Gallery</h2>

                    </div>
                </div>
            </a>

            <a class="col-md-6 col-xl-4 dashboard-menu" href="">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <h2>Music Market Place</h2>
                    </div>
                </div>
            </a>

        </div>
        <div class="divider mt-0" style="margin-bottom: 20px;"></div>
        <div class="row">

              <a class="col-md-6 col-xl-4 dashboard-menu" href="{{ url('/instruments')}}">
                  <div class="card mb-3 widget-content bg-arielle-smile">
                      <div class="widget-content-wrapper text-white">
                        <h2>Music Instruments</h2>

                      </div>
                  </div>
              </a>



          </div>

    </div>
</div>



@endsection
