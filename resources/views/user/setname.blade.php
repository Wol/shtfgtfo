@extends('html')

@section('content')

    <form action="/user/setname" method="POST">
        @csrf


        <div class="flex flex-col items-center">

            <div>Please enter your nickname to track your movements</div>
            <input type="text" name="nickname" class="rounded border my-4" placeholder="Nickname"/>
            <button type="submit" class="py-2 px-4 border rounded bg-blue-200">Save</button>


        </div>

    </form>

@endsection
