@extends('layouts.presence')

@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Permit Application</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('presence.store_permit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="col">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label class="form-label">Nomor Identitas</label>
                            <input type="text" class="form-control" value="{{ old('name') ?? $user->identity_number }}"
                                name="name" placeholder="Nama Lengkap" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <label class="form-label">Tanggal Ijin / Sakit</label>
                            <input type="text" class="form-control datepicker" name="permit_date">
                        </div>
                    </div>

                    {{-- <div class="col-6">
                            <button type="button" class="btn btn-danger btn-block">Sakit</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-warning btn-block">Ijin</button>
                        </div> --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1">
                        <label class="form-check-label" for="inlineRadio1">Ijin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2">
                        <label class="form-check-label" for="inlineRadio2">Sakit</label>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="submit" class="btn btn-primary btn-block">
                                <ion-icon name="refresh-outline"></ion-icon>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({
                yearRange: [2020, currYear - 0],
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endpush
