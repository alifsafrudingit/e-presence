<ul class="listview image-listview">
    @foreach ($histories as $history)
        <li>
            </div>
            <div class="item">
                <div class="in">
                    <div class="col-6">
                        <b>{{ date('l, d-m-Y', strtotime($history->tgl_presensi)) }}</b><br>
                        @if ($history->time_in > '09:00')
                            <span class="text-muted">Terlambat</span>
                        @endif
                        @if ($history->time_out == null)
                            <span class="text-muted">& belum absen pulang</span>
                        @endif
                    </div>
                    <div class="col-3 text-center">
                        <img id="myImg" src="{{ Storage::url('/uploads/absensi/' . $history->foto_in) }}"
                            class="imaged w48 shadow mb-05">
                        @if ($history->time_in > '09:00')
                            <span style="color: #FF0000">{{ $history->time_in }}</span>
                        @else
                            <span>{{ $history->time_in }}</span>
                        @endif
                    </div>
                    <div class="col-3 text-center">
                        @if ($history->time_out != null)
                            <img id="myImg" src="{{ Storage::url('/uploads/absensi/' . $history->foto_out) }}"
                                class="imaged w48 mb-05">
                            <span>{{ $history->time_out }}</span>
                        @else
                            <div class="iconpresence">
                                <ion-icon name="camera"></ion-icon><br>
                                <span class="text-muted">--:--:--</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
