@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $role->name }}
                    </div>

                    <?php $isEdit = true; ?>
                    <div class="card-body">
                        {!! Form::model($role, ['route' => ['admin.role.update', $role->id], 'method' => 'put']) !!}

                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('name', $value = null, ['class' => 'form-control', 'required' => true]) }}
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button class="btn btn-md btn-primary  float-end" type="submit">Save Role</button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
