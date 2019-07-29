@extends('html')

@section('fullscreencontent')

    <game-component nickname="{{ Session::get('nickname') }}" token="{{ $token }}"></game-component>


@endsection
