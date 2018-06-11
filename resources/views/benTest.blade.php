@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ben Testing</div>

                <div class="card-body">
                   @foreach ($posts as $p)
                        <p>Title:   {{ $p->title }}<br>

                        </p>    
                   @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
