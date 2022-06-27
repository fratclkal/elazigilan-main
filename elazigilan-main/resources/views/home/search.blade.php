@extends('home.layout')

@section('content')


    <div class="mt-5 container main-content">
        <div class="card card-main">
            <div class="card-body">

                <div class="row">

                    <div align="center" class="col-12">
                        <br>
                        <h3>{{$ad->title}}</h3>
                        <br>
                        <!-- Swiper -->
                        <div class="swiper-container w-50 mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($ad->files()->get() as $file)
                                    <div class="swiper-slide detail-slide" style="background-position: center; background-image: url('{{asset('contentFiles/'.$file->path)}}')"></div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div align="center">
                        <br>
                        <b>İletişim:</b> {{$ad->contact}}
                        <br><br>
                        <div class="row w-50">
                            <div align="left" class="col-6">
                                @php($i=0)
                                @foreach($ad->attributes()->get() as $attribute)
                                    @if($i%2==0)
                                        <b>{{$attribute->key}}:</b> {{$attribute->value}}
                                        <br>
                                    @endif
                                    @php($i++)
                                @endforeach
                            </div>
                            <div align="left" class="col-6">
                                @php($i=0)
                                @foreach($ad->attributes()->get() as $attribute)
                                    @if($i%2==1)
                                        <b>{{$attribute->key}}:</b> {{$attribute->value}}
                                        <br>
                                    @endif
                                    @php($i++)
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div align="center" class="mt-5 mb-5">
                        <div class="row w-50">
                            <div align="left" class="col-12">
                                {!! $ad->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

@endsection
