@extends('layouts.app')

@section('content')
  

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('conducteurs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
