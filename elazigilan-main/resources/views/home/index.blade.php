@extends('home.layout')

@section('content')


    <div class="mt-5 container main-content">
        @if(\App\Models\File::where('is_top', 1)->count()>0)
        <div class="row">
            @foreach(\App\Models\File::where('is_top', 1)->get() as $file)
            <div style="background: url('{{asset('contentFiles/'.$file->path)}}') no-repeat; background-size: 100%; background-position: center; height: 200px;" class="col-lg-6 col-12">

            </div>
            @endforeach
        </div>
        @endif
        <div class="card card-main">
            <div class="card-body">
                <div class="row">
                    <div id="tags-1" class="col-12 col-lg-4">
                        @foreach(explode(',', $siteSettings->tags) as $tag)
                        <div class="tags p-1 m-1"><h4>{{$tag}}</h4></div>
                        @endforeach
                            <br>
                    </div>
                    <div class="col-12 col-lg-8">
                        @foreach($ads as $ad)
                        <div class="card w-100 p-3">
                            <div class="row">
                                <div class="col-4">
                                    @if($ad->files()->count()>0)
                                        <img class="card-img d-inline-block" src="{{asset('contentFiles/'.$ad->files->first()->path)}}" alt="Card image cap">
                                    @endif

                                </div>
                                <div class="col-8">
                                    <div class="card-body d-inline-block">
                                        <h5 class="card-title">{{$ad->title}}</h5>
                                        <p class="card-text">{!! mb_substr($ad->description, 0, 75, 'UTF-8') !!}</p>
                                        <a target="_blank" href="{{route('front.single.ad', $ad->id)}}" class="btn btn-custom">İlana Git</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            <br><br>

                    </div>
                    <div id="tags-2" class="col-12 col-lg-4">

                    </div>
                    <br><br><br>

                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
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


        $(document).ready(function (){
            var width = $(window).width();

            if (width < 992){
                a= false;
                if ($('#tags-1').html() != ''){

                    $('#tags-2').html($('#tags-1').html());
                    $('#tags-1').html('');
                }
            }else if (width >= 992){

                if ($('#tags-2').html() != ''){
                    $('#tags-1').html($('#tags-2').html());
                    $('#tags-2').html('');
                }

            }
            if(width < 1200 && width >= 992) {
                swiper.params.slidesPerView = 3;
                swiper.params.spaceBetween = 50;
            } else if(width < 992 && width >= 768) {
                swiper.params.slidesPerView = 2;
                swiper.params.spaceBetween = 50;
            } else if(width < 768){
                swiper.params.slidesPerView = 1;
                swiper.params.spaceBetween = 50;
            } else {
                swiper.params.slidesPerView = 4;
                swiper.params.spaceBetween = 50;
            }
            swiper.update();
        });

        var a=true;

        // Breakpoints
        $(window).on('resize', function(){
            var width = $(window).width();


            if (width < 992){
                if ($('#tags-1').html() != ''){

                    $('#tags-2').html($('#tags-1').html());
                    $('#tags-1').html('');
                }
            }else if (width >= 992){
                if (a == true){
                    $('#tags-2').html('');
                    a = false;
                }
                if ($('#tags-2').html() != ''){

                    $('#tags-1').html($('#tags-2').html());
                    $('#tags-2').html('');
                }

            }
            if(width < 1200 && width >= 992) {
                swiper.params.slidesPerView = 3;
                swiper.params.spaceBetween = 50;
            } else if(width < 992 && width >= 768) {
                swiper.params.slidesPerView = 2;
                swiper.params.spaceBetween = 50;
            } else if(width < 768){
                swiper.params.slidesPerView = 1;
                swiper.params.spaceBetween = 50;
            } else {
                swiper.params.slidesPerView = 4;
                swiper.params.spaceBetween = 50;
            }
            swiper.onResize();
        }).resize();
    </script>
@endsection
