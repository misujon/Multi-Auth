@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Access Denied') }}</div>

                <div class="card-body">
                    <h3>Sorry you do not have access to this page!</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
