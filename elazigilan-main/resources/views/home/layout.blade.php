@php
$siteSettings = \App\Models\SiteSettings::all()[0];
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$siteSettings->description}}">
    <meta name="keywords" content="{{$siteSettings->tags}}">
    <title>{{$siteSettings->title}}</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


</head>
<body>

<div class="top-header">
    <div class="container">
        <h1 class="p-3">{{$siteSettings->page_title}}</h1>
    </div>
    <div class="navigate">
        <div class="container">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('front.index')}}">En Yeni Önce</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('front.index.order', 'popular')}}">En Popüler Önce</a>
                </li>
            </ul>
        </div>
    </div>
</div>



@yield('content')



<div class="footer">
    <div class="container pt-5">
        <div class="row">
            <div align="right" class="col-6">
                {{$siteSettings->title}}
            </div>
            <div align="left" class="col-6 footer-sec-col">
                {{$siteSettings->title}}
            </div>
        </div>
    </div>
</div>





</body>
</html>
