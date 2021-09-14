<div class="form-group row">
    <label class="col-sm-3 col-form-label">Name <span class="required">*</span></label>
    <div class="col-sm-9">
        {{ Form::text('name', $value = null, ['class' => 'form-control', 'required' => true]) }}
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Email <span class="required">*</span></label>
    <div class="col-sm-9">
        {{ Form::text('email', $value = null, ['class' => 'form-control', 'required' => true, 'disabled'=>($isEdit?true:false)]) }}
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Currency <span class="required">*</span></label>
    <div class="col-sm-9">
        {{ Form::select('role_id', $user_roles, $value = null, ['class' => 'form-control', 'required' => true]) }}
        <span class="text-danger">{{ $errors->first('role_id') }}</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Status <span class="required">*</span></label>
    <div class="col-sm-9">
        {{ Form::select('status', ["active" => "active", "inactive" => "inactive"], $value = null, ['class' => 'form-control', 'required' => true]) }}
        <span class="text-danger">{{ $errors->first('status') }}</span>
    </div>
</div>

@if(!$isEdit)
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Password <span class="required">*</span></label>
        <div class="col-sm-9">
            {{ Form::password('password', $value = null, ['class' => 'form-control', 'required' => true]) }}
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>
    </div>
@endif
