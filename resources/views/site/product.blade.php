@extends('layouts.home')
@section('menu')
    @include('site.home.menu1')
@endsection
@section('content')
<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            @include('site.home.category')

            @include('site.home.product-list')


        </div>
    </section>
@endsection