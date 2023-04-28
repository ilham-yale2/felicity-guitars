@extends('layout.app', ['background' => 'background-multi-item.jpg'], ['subject' => $subject])
@section('title', 'Browse by Category')
@section('content')
<style>
    @media (min-width: 1200px){
        .container, .container-lg, .container-md, .container-sm, .container-xl {
            max-width: 95%;
        }
    }

    body{
        background-position: top;
    }

    body:before {
        background: unset;
    }
</style>
    <div class="aboutus">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12 mb-5 d-block d-md-none">
                    <button class="btn d-flex align-items-center text-white bg-orange btn-toggle-filter rounded">
                        <h3 class="mb-0 mr-3">Show filter</h3>
                        <span class="iconify" data-icon="ion:caret-forward-circle-sharp" data-width="30"></span>
                    </button>
                </div>
                <div class="col-md-2 d-flex nav-filter">
                    <div class="col-10 px-0 mt-5 mt-md-0">
                        @if (isset($title))
                        <div class="border-gold-bottom">
                            <h4 class="mb-0">{{$title}}</h4>
                        </div>
                        @endif
                        <ul class="list-none mt-4 list-brand">
                            @if ($brands)    
                                @foreach ($brands as $item)                                
                                <li class="text-capitalize">
                                    <a class="filter text-gold" href="{{route('browse-category')}}?subject={{$subject}}&brd={{$item}}{{$ctg}}"><span class="text-country"><b>{{str_replace('_', '-', $item)}}</b></span></a>
                                </li>
                                @endforeach
                            
                            @endif
                            
                        </ul>
                        <ul class="list-none brand-list mt-4 mb-3">
                            @if ($condition)
                                <li class="">
                                    <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&condition=1"><span>New</span></a>
                                </li>
                                <li class="mt-0">
                                    <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&condition=2"><span>Used</span></a>
                                </li>
                            @endif
                            @if ($subject == 'Guitar')
                                @if ($type == 'all' || 'without acoustic')                        
                                    <li class="mt-4">
                                        <a class="filter" href="{{route('browse-category')}}?subject=Guitar{{$ctg}}&type=1"><span>Solidbody</span></a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject=Guitar{{$ctg}}&type=2"><span>Semi-hollowbody</span></a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject=Guitar{{$ctg}}&type=3"><span>Offset</span></a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject=Guitar{{$ctg}}&type=4"><span>Hollowbody</span></a>
                                    </li>
                                @endif
                                @if ($type == 'all')
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject=Guitar{{$ctg}}&type=5"><span>Acoustic</span></a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                        @if ($subject == 'Merch-Apparel')
                            <ul class="list-none">
                                    
                                <li>
                                    <div class="filter">Men's</div>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=Long-sleeve-ts&gender=men" class="filter">Long-sleeve T’s</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=short-sleeve-ts&gender=men" class="filter">Short-sleeve T’s</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=singlets&gender=men" class="filter">Singlets</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=bandanas&gender=men" class="filter">Bandanas</a>
                                </li>
                                <li class="mt-2">
                                    <div class="filter">Women's</div>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=Long-sleeve-ts&gender=women" class="filter">Long-sleeve T’s</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=short-sleeve-ts&gender=women" class="filter">Short-sleeve T’s</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=singlets&gender=women" class="filter">Singlets</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=bandanas&gender=women" class="filter">Bandanas</a>
                                </li>
                                
                                <li class="mt-2">
                                    <div class="filter">Uni-sex</div>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=hats&gender=unisex" class="filter">Hats</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=belts&gender=unisex" class="filter">Belts</a>
                                </li>
                                <li class="mt-2">
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=hats&gender=unisex" class="filter">Keepsakes</a>
                                </li>
                                <li class="mt-2">
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=mugs" class="filter">Mugs</a>
                                </li>
                                <li>
                                    <a href="{{route('browse-category')}}?subject={{$subject}}&type=cosaters" class="filter">Coasters</a>
                                </li>
                            </ul>
                        @endif
                        @if ($types)
                            <ul class="list-none brand-list mt-3" >
                                @foreach ($types as $item)
                                    <li class="my-0">
                                        <a class="{{$bold ? 'fw-bold' : ''}} {{($subject == 'Exotic-Instruments') ? 'text-gold' : ''}}" href="{{route('browse-category')}}?subject={{$subject}}&type={{str_replace('_', '-', $item)}}">{{str_replace('_','-', str_replace('-', ' / ', $item))}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if (isset($addition))
                            <ul class="list-none mt-4">
                                
                                <ul class="list-none brand-list mt-3">
                                    @forelse ($addition as $item)
                                        <li><a href="{{route('browse-category')}}?subject={{$subject}}&type={{$item}}">{{str_replace('_', '-', str_replace('-', ' & ', $item))}}</a></li>
                                    @empty
                                    
                                    @endforelse
                                </ul>
                            </ul>
                        @endif
                        @if ($subject == 'Exotic-Instruments')
                            <ul class="list-none mt-3">
                                <li class="">
                                    <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&condition=1"><span>New</span></a>
                                </li>
                                <li class="mt-0">
                                    <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&condition=2"><span>Used</span></a>
                                </li>
                            </ul>
                        @endif

                        <div class="d-flex d-md-block">
                            <ul class="mt-4 list-none brand-list">
                                <li class="{{(isset($price) || isset($price_list)) ? '' : 'd-none'}}">$ Price Range</li>
                                @if (isset($price))    
                                    <li class="">
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_price=0&to_price=999"><span class="mr-4">-  </span> 999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=1000&to_price=1999"><span>1000 -  </span> 1999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=2000&to_price=2999"><span>2000 -  </span> 2999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=3000&to_price=3999"><span>3000 -  </span> 3999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=4000&to_price=4999"><span>4000 -  </span> 4999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=5000&to_price=5999"><span>5000 -  </span> 5999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=6000&to_price=6999"><span>6000 -  </span> 6999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=7000&to_price=7999"><span>7000 -  </span> 7999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=8000&to_price=8999"><span>8000 -  </span> 8999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&from_price=9000&to_price=9999"><span>9000 -  </span> 9999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subjet={{$subject}}{{$ctg}}&up_to=10000"><span>10000 -  </span> </a>
                                    </li>
                                @elseif(isset($price_list))
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=50&to_price=99"><span>50  &nbsp - &nbsp  </span> 99</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=100&to_price=199"><span>100 -  </span> 199</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=200&to_price=299"><span>200 -  </span> 299</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=300&to_price=399"><span>300 -  </span> 399</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&from_price=400&to_price=499"><span>400 -  </span> 499</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}ctg={{$ctg}}&up_to=5000"><span>500 -  </span></a>
                                    </li>
                                @endif
                            </ul>
                            @if (isset($year))
                                <ul class="mt-4 list-none brand-list ml-auto ml-md-0">
                                    <li> Year</li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=1950&to_year=1959"><span>1950 - </span>1959</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=1960&to_year=1969"><span>1960 - </span>1969</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=1970&to_year=1979"><span>1970 - </span>1979</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=1980&to_year=1989"><span>1980 - </span>1989</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=1990&to_year=1999"><span>1990 - </span>1999</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=2000&to_year=2009"><span>2000 - </span>2009</a>
                                    </li>
                                    <li>
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&from_year=2010&to_year=2019"><span>2010 - </span>2019</a>
                                    </li>
                                    <li class="pb-5">
                                        <a class="filter" href="{{route('browse-category')}}?subject={{$subject}}{{$ctg}}&up_year=2020"><span>2020 - </span></a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-2 px-0 d-block d-md-none">
                        <button class="btn text-white btn-toggle-filter">
                            <span class="iconify" data-icon="ion:caret-back-circle" data-width="35"></span>
                        </button>
                    </div>
                </div>
                @if (count($products) > 0 )
                <div class="col-md-10 p-0">
                    {{-- <a href="{{route('index')}}" class="btn btn-outline position-fixed button-home">Home</a> --}}
                    <div class="row mx-0">
                        @foreach ($products as $product)
                            <div class="{{$col ?? 'col-card'}} col-6 card-product mb-4 text-center px-3 py-0">
                                <a href="{{route($route,['name' => $product->slug])}}">
                                    <div class="d-flex justify-content-center {{ $box }}">
                                        <img src="{{asset('storage').'/'.$product->thumbnail}}" class="{{$image ?? 'card-product-img'}}" alt="{{$product->alt_text}}">
                                    </div>
                                    <p class="product-name text-gold copperplate mb-0">{{$product->name_2}}</p>    
                                    <p>
                                        More Info..
                                    </p>
                                </a>
                                {{-- <div class="d-flex flex-wrap border-bottom border-white pb-3">
                                    <div class="img-product col-5 p-0">
                                        <div class="p-2 bg-white">
                                        </div>
                                        <div class="bg-orange text-center text-white py-1">
                                            IDR {{number_format($product->sell_price)}} 
                                        </div>
                                    </div>
                                    <div class="col-6 pr-0 d-flex flex-wrap" style="min-height: 250px">
                                        <p class="mb-1 w-100 d-none d-md-block">{{ \Illuminate\Support\Str::limit(strip_tags($product->text), 220,'...') }}
                                        </p>
                                        <p class="mb-1 w-100 d-block d-md-none">{{ \Illuminate\Support\Str::limit(strip_tags($product->text), 270,'...') }}
                                        </p>
                                        <a class="w-100 mt-auto" href="{{route('detail-product',['name' => $product->slug])}}"><button class="btn border border-white btn-read w-100">Read
                                                More</button></a>
                                    </div>
                                </div> --}}
                            </div>
                        @endforeach
                        <div class="w-100 d-flex">
                            <div class="ml-auto paginate-product">
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center col-md-8 col-12 pt-5 mt-5">
                    <h1 class="text-orange copperplate mb-0">Coming soon!</h1>
                    @if ($empty_text)
                        <h3 style="font-size: 28px" class="text-gold copperplate">{{$empty_text}}</h3>
                    @else
                    <h2 class="text-gold copperplate">{{$empty_text ?? '~ Stay tuned ~'}}</h2>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('js/category.js')}}"></script>
<script>
    function redirect(url){
        window.location.href=url
    }
    $('.btn-toggle-filter').on('click', function(){
        $('.nav-filter').toggleClass('show')
    })

    $('.type-drop').click(function(){
        $(this).find('.sub-type').slideToggle()
    })

    $('.page-item a').each(function(index){
        var href = $(this).attr('href') + '&subject={{$subject}}&ctg={{app("request")->input("ctg")}}'
        $(this).attr('href', href)
    })
    // setBrand('{{$ctg}}')
</script>
@endsection