@extends('layout.main')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.dynatable.css') }}" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.dynatable.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
<div class="wrapper">
    <h1>Coupons</h1>
    <div class="col-sm-4">
        <h2>{{ $vouchers_total }}</h2>
        All vouchers
    </div>
    <div class="col-sm-4">
        <h2>{{ $vouchers_unused }}</h2>
        Unused vouchers
    </div>
    <div class="col-sm-4">
        <h2>{{ $vouchers_used }}</h2>
        Used vouchers
    </div>
    <div class="clear"></div>
</div>
<div class="wrapper">
    <a href="{{ route('offer.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add coupons</a>
    <table id="dyntable" class="table table-bordered responsive">
        <thead>
            <tr>
                <th class="head0">CODE</th>
                <th class="head1">USED</th>
                <th class="head0">RECEIVER</th>
                <th class="head1">USE DATE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->code }}</td>
                <td><span class="fa {{ (is_null($voucher->used_on)) ? 'fa-times' : 'fa-check' }}"></span></td>
                <td>{{ $voucher->recipient->email }}</td>
                <td>{{ (is_null($voucher->used_on) ? '' : $voucher->used_on->format('d.m.Y')) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
