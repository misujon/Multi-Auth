@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $user->name }} - ({{ $user->role->name }})
                    </div>

                    <?php $isEdit = true; ?>
                    <div class="card-body">
                        {!! Form::model($user, ['route' => ['manager.user.update', $user->id], 'method' => 'put']) !!}

                            @csrf
                            @include('manager/_form')

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button class="btn btn-md btn-primary  float-end" type="submit">Save User</button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
