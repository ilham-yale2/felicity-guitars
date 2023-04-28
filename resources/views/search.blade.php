@extends('layout.app', ['background' => 'background-multi-item.jpg'])
@section('title', 'Browse by Brand')
@section('content')
    <div class="aboutus">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 p-0">
                    <div class="row mx-0">
                        @forelse ($products as $item)
                            <div class="col-card col-6 card-product mb-4 text-center px-3">
                                <a href="{{route('detail-product',['name' => $item->slug])}}">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{asset('storage').'/'.$item->thumbnail}}" class="card-product-img" alt="{{$item->alt_text}}">
                                    </div>
                                    <p class="product-name text-gold copperplate mb-0">{{$item->name_2}}</p>    
                                    <p>
                                        More Info..
                                    </p>
                                </a>
                            </div>
                        @empty
                                <div class="text-center w-100 pt-5">
                                    <h2 style="text-transform: none">No Product</h2>
                                </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

