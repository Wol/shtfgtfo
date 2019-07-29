@extends('html')

@section('content')

    <div class="mb-4 flex">
        <h1 class="flex-1">Currently active games</h1>
        <div>
            {{ Session::get('nickname') }}
        </div>
    </div>

    <div class="grid lg:grid-col-3 md:grid-col-2 sm:grid-col-1 grid-gap-4">
    @foreach($games as $game)

        <div class="border rounded p-4">
            <h2>{{ $game['map'] }}</h2>
            <div>
                <span class="text-xl">{{ $game['score']['percentage'] }}</span>
                <span>%</span>
            </div>
            <div>
                {{ $game['date'] }}
            </div>
            <div>
                <a href="/game/{{ $game['token'] }}">
                    <i class="fal fa-map-marked-alt"></i>
                </a>
                {{ $game['token'] }}
            </div>
        </div>


    @endforeach
    </div>


@endsection
