@extends('layouts.presence')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Presence</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        }

        #map {
            height: 180px;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($check > 0)
                <button id="takeabsen" class="btn btn-danger btn-block">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Pulang
                </button>
            @else
                <button id="takeabsen" class="btn btn-success btn-block">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Masuk
                </button>
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>


    <audio id="notification_in">
        <source src="{{ asset('assets/audio/notification_in.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="notification_fail_time">
        <source src="{{ asset('assets/audio/notification_fail_time.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="notification_out_of_radius">
        <source src="{{ asset('assets/audio/notification_out_of_radius.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="notification_out">
        <source src="{{ asset('assets/audio/notification_out.mp3') }}" type="audio/mpeg">
    </audio>
@endsection

@push('myscript')
    <script>
        const notification_in = document.getElementById('notification_in');
        const notification_out = document.getElementById('notification_out');

        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach(".webcam-capture");

        let lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback)
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
            const map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            const marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            const circle = L.circle([-7.6990533, 110.5740319], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 20
            }).addTo(map);
        }

        function errorCallback() {

        }

        $('#takeabsen').click(function(e) {
            Webcam.snap(function(uri) {
                image = uri
            })
            let lokasi = $('#lokasi').val();
            $.ajax({
                type: 'POST',
                url: '/presence/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    const status = respond.split('|');
                    if (status[0] == 'success') {
                        if (status[3] == 'check_in') {
                            notification_in.play()
                        } else {
                            notification_out.play()
                        }
                        Swal.fire({
                            title: status[1],
                            text: status[2],
                            icon: 'success',
                        })
                        setTimeout(() => {
                            location.href = '/dashboard'
                        }, 2600);
                    } else {
                        if (status[3] == 'not_time') {
                            notification_fail_time.play()
                        } else if (status[3] == 'not_radius') {
                            notification_out_of_radius.play()
                        }
                        Swal.fire({
                            title: status[1],
                            text: status[2],
                            icon: 'error',
                        })
                    }
                }
            })
        })
    </script>
@endpush
