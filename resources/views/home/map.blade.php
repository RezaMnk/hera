@extends('home.layouts.app')

@section('title', 'ورود')

@section('breadcrumb')
    <x-breadcrumb title="ورود" desc="فرم ورود به حساب کاربری" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div id="map" class="w-100" style="height: 50vh"></div>
                <form>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="long" id="long">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @include('home.layouts.partials.footer')
@endsection

@push('scripts')
    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>

    <script type="text/javascript">

        @php
            $text = 'میدان شهدا';

            $coordinates = \App\Models\Map::search($text);
        @endphp

        let lat = {{ $coordinates['lat'] }};
        let lon = {{ $coordinates['long'] }};

        let icon = L.icon({
            iconUrl: '{{ asset('assets/icons/leaflet/location.svg') }}',
            iconSize:     [38, 100], // size of the icon
            iconAnchor:   [18, 67], // point of the icon which will correspond to marker's location
        });

        let map = new L.Map('map', {
            key: 'web.a26d783d73c94bec9900322ce1a88f99',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: [35.6913604736328, 51.4785614013672],
            zoom: 14,
        });
        var marker = L.marker([lat, lon], {icon: icon}).addTo(map);
        map.on('click', function(e) {
            if(marker)
                map.removeLayer(marker);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('long').value = e.latlng.lng;
            marker = L.marker([e.latlng], {icon: icon}).addTo(map);
        });

    </script>
@endpush
