<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$expedient->full_code}}</title>
    <!-- Fonts -->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}
{{--    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">--}}

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

    @include('pdfTemplates.style1')

    <style>
        /* latin */
        @font-face {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/nunito/v16/XRXW3I6Li01BKofAjsOUYevIWzgPDA.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
</head>
<body>
<div id="watermark">
{{--    <img src="{{\Illuminate\Support\Facades\Storage::disk('templates')->url('avance.jpg')}}">--}}
{{--    <h1 id="header">{{ $text  }}</h1>--}}
{{--    <img id="barcode_s" src="' . $directorio . '/barcode_s.png">--}}
</div>
<div id="header">
    <div>
        <div style="float:left;width:40%; height: 120px;">
            <img class="image-logo" src="{{$gabinete->logo_url}}" alt="{{$gabinete->name}}">
        </div>
        <div style="float:left;width:60%; text-align: right">
            <div>
                <span class="large color-primary bold uppercase">{{$gabinete->name}}</span>
            </div>
            <div>
                <span class="color-primary">{{__('Fecha: ')}}</span>
                <span class="color-secondary">{{ $advanceContent['date'] }}</span>
            </div>
            <div>
                @if($expedient->reference)
                    <span class="color-primary">{{__('Referencia: ')}}</span>
                    <span class="color-secondary">{{ $expedient->reference }}</span>
                @endif
            </div>
            <div>
                <span class="color-primary bold uppercase" style="font-size: xx-large;">{{__('Avance')}} · </span>
                <span class="large color-primary bold uppercase">{{ $expedient->full_code }}</span>
            </div>
        </div>
    </div>

</div>
<hr class="no-margins primary-thick" style="margin-top: 3px;">
<div class="content">
    <div class="section">
        <h1 class="color-primary">{{__('Identificación del siniestro')}}</h1>
        <ol>
            <li>{{__('Solicitante')}}</li>
            <li>{{__('Datos de contacto')}}</li>
        </ol>
    </div>
    <div class="section">
        <h1 class="color-primary">{{__('Contenido del avance')}}</h1>
        <ol>
            <li>{{__('Avance')}}</li>
            <li>{{__('Fotografías')}}</li>
        </ol>
    </div>

    <p>{{\Illuminate\Support\Facades\Storage::disk('templates')->url('avance.jpg')}}</p>
    <p>Avance modelo 360Claims</p>
    <p>{!! $advanceContent['text'] !!}</p>
    <img style="height: 200px; width: 200px; text-align:center;" src="{{$gabinete->logo_url}}" alt="">
    <table style="width: 100%; background-color: #f7f7f7">
        <tr>
            <td>uno</td>
            <td>dos</td>
        </tr>
        <tr>
            <td><img src="{{$gabinete->logo_url}}" alt=""></td>
            <td>dos</td>
        </tr>
        <tr>
            <td>uno</td>
            <td>dos</td>
        </tr>
    </table>
</div>

</body>
</html>


{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Test View</title>--}}
{{--    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/app.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ ltrim(public_path('css/app.css'), '/') }}" />--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--</head>--}}
{{--<body class="font-sans antialiased">--}}

{{--<div class="grid grid-cols-3">--}}
{{--    <div class="bg-red-200 col-span-2 h-screen"></div>--}}
{{--    <div class="bg-blue-200 h-screen">--}}
{{--        <div class="grid grid-cols-8">--}}
{{--            <div class="col-span-7">--}}
{{--                <div class="rounded-t-full w-full h-screen flex items-center justify-center bg-green-600">--}}
{{--                    <div class="h-60 w-60 rounded-full bg-blue-500">{{ ltrim(public_path('css/app.css'), '/') }}</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--</body>--}}
{{--</html>--}}
