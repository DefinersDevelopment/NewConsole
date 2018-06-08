@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ben Testing</div>

                <div class="card-body">
                   @foreach ($posts as $p)
                        <p>{{ $p->title }}<br>
                         With Categories: 
                            <ul>
                            @foreach ($p->category as $cat)
                                <li>    {{$cat->name}}</li>
                            @endforeach
                            </ul>
                        </p>    
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
