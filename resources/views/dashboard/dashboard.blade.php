@extends('layouts.presence')

@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="assets/img/sample/avatar/man.png" alt="avatar" class="imaged w64 rounded">
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ $user->name }}</h2>
                <span id="user-role">{{ $user->occupation }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presence && $presence->foto_in != null)
                                        <img src="{{ Storage::url('/uploads/absensi/' . $presence->foto_in) }}"
                                            class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presence && $presence->time_in != null ? $presence->time_in : 'Belum Pres..' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presence && $presence->foto_out != null)
                                        <img src="{{ Storage::url('/uploads/absensi/' . $presence->foto_out) }}"
                                            class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presence && $presence->time_out != null ? $presence->time_out : 'Belum Pres..' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="presencerecape">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important; line-height: 1rem">
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem; color: #724BCC"></ion-icon><br>
                            <span style="font-size: 0.8rem; font-weight: 500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important; line-height: 1rem">
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem; color: #FF7909"></ion-icon><br>
                            <span style="font-size: 0.8rem; font-weight: 500">Ijin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important; line-height: 1rem">
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem; color: #2DA94F"></ion-icon><br>
                            <span style="font-size: 0.8rem; font-weight: 500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important; line-height: 1rem">
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem; color: #EA4335"></ion-icon><br>
                            <span style="font-size: 0.8rem; font-weight: 500">Terlambat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Karyawan
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($presence_history as $presence)
                            <li>
                                <div class="item">
                                    @if ($presence->time_in && $presence->time_out != null)
                                        <div class="icon-box bg-primary">
                                            <ion-icon name="checkmark-done-outline" role="img" class="md hydrated"
                                                aria-label="checkmark done outline"></ion-icon>
                                        </div>
                                    @else
                                        <div class="icon-box bg-warning">
                                            <ion-icon name="alert-outline" role="img" class="md hydrated"
                                                aria-label="alert outline"></ion-icon>
                                        </div>
                                    @endif
                                    <div class="in">
                                        <div>{{ date('d M Y', strtotime($presence->tgl_presensi)) }}</div>
                                        <span class="badge badge-success">{{ $presence->time_in }}</span>
                                        @if ($presence->time_out != null)
                                            <span class="badge badge-dark">{{ $presence->time_out }}</span>
                                        @else
                                            <span class="badge badge-light" style="color:#FF0000">
                                                00:00:00
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($users as $user)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <button type="button" class="btn btn-light" data-container="body"
                                                data-toggle="popover" data-placement="top"
                                                data-content="Phone : {{ $user->phone }},  Email : {{ $user->email }}">
                                                {{ $user->name }}
                                            </button>
                                        </div>
                                        <span class="text-muted">{{ $user->occupation }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@endpush
