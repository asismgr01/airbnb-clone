@extends('layouts.template')
@section('content')
        <div class="container">
      @if($hotels)
      @foreach($hotels as $key => $value)
      <h3>{{ $hotels[$key]->hotel_name }}</h3>
      <h6>{{ $hotels[$key]->address }}</h6>
      <div class="row">
        <div class="col-md-8">      
          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{asset('uploads/hotel-images/Hotel-images201905140905196.jpg')}}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/hotel-images/Hotel-images2019051104050949.jpg')}}" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/hotel-images/Hotel-images201905110405095.jpg')}}" class="d-block w-100" alt="...">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
        <div class="col-md-4">
          <div class="mapouter"><div class="gmap_canvas"><iframe width="285" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com"></a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:285px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:285px;}</style></div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          {!! $hotels[$key]->description !!}
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>     
@endsection
