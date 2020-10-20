@extends('layout.main')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap.datepicker.min.css') }}" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap.datepicker.min.js') }}"></script>
<script src="{{ asset('js/offer.create.js') }}"></script>
@endsection

@section('content')
<div class="wrapper">
    <h1>Add coupons</h1>
    <form action="{{ route('offer.create') }}" method="POST">
        {{ csrf_field() }}
        <div class="inputwrapper">
            <label for="name">
                Name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" autofocus>
            @if ($errors->has('name'))
            <label class="error">
                <strong>{{ $errors->first('name') }}</strong>
            </label>
            @endif
        </div>
        <div class="inputwrapper">
            <label for="discount">
                Discount
            </label>
            <input id="discount" type="text" name="discount" value="{{ old('discount') }}" class="form-control">
            @if ($errors->has('discount'))
            <label class="error">
                <strong>{{ $errors->first('discount') }}</strong>
            </label>
            @endif
        </div>
        <div class="inputwrapper">
            <label for="expiration">
              procedure
            </label>
            <input id="expiration" type="text" name="expiration" value="{{ old('expiration', Carbon\Carbon::today()->format('d/m/Y')) }}" class="form-control">
            @if ($errors->has('expiration'))
            <label class="error">
                <strong>{{ $errors->first('expiration') }}</strong>
            </label>
            @endif
        </div>
        <div class="inputwrapper">
            <button type="submit" class="btn btn-primary">Send</button>
            <a href="{{ route('index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
