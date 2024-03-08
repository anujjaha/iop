<div class="form-group">
    {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('name', 'Name :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('primary_contact', 'Primary Contact :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('primary_contact', null, ['class' => 'form-control', 'placeholder' => 'Primary Contact']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', 'Email :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('address', 'Address :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('city', 'City :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('state', 'State :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('pincode', 'Pincode :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('pincode', null, ['class' => 'form-control', 'placeholder' => 'Pincode']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('website', 'Website :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('gmap', 'Gmap :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('gmap', null, ['class' => 'form-control', 'placeholder' => 'Gmap']) }}
    </div>
</div>