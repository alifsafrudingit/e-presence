@extends('layouts.presence')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Permission Or Sick Data</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="{{ route('presence.permit_application') }}" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
