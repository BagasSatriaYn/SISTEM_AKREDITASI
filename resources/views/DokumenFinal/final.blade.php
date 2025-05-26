@extends('layouts.app')

@section('title', 'Final')

@section('breadcrumb-title', 'Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <h2>Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Dokumen</h5>
                    <p class="card-text display-6">56</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dokumen Baru</h5>
                    <p class="card-text display-6">8</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dalam Proses</h5>
                    <p class="card-text display-6">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Selesai</h5>
                    <p class="card-text display-6">36</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
*/