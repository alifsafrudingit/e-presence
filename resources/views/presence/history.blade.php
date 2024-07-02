@extends('layouts.presence')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Histori Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="month" id="month" class="form-control">
                            <option value="" disabled>-- Pilih Bulan --</option>
                            @for ($m = 1; $m <= count($month_name) - 1; $m++)
                                <option value="{{ $m }}" {{ date('m') == $m ? 'selected' : '' }}>
                                    {{ $month_name[$m] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="year" id="year" class="form-control">
                            <option value="" disabled>-- Pilih Tahun --</option>
                            @php
                                $start_year = 2022;
                                $current_year = date('Y');
                            @endphp
                            @for ($y = $start_year; $y <= $current_year; $y++)
                                <option value="{{ $y }}" {{ date('Y') == $y ? 'selected' : '' }}>
                                    {{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="getData">
                            <ion-icon name="search-outline"></ion-icon>Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col" id="showHistory"></div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('#getData').click(function(e) {
                let month = $("#month").val()
                let year = $("#year").val()
                $.ajax({
                    type: 'POST',
                    url: '/gethistory',
                    data: {
                        _token: "{{ csrf_token() }}",
                        month: month,
                        year: year,
                    },
                    cache: false,
                    success: function(data) {
                        $('#showHistory').html(data)
                    }
                })
            })
        })
    </script>
@endpush
