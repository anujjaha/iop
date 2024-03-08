<!-- <div class="form-group">
    {{ Form::label('user_id', 'User Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('user_id', null, ['class' => 'form-control', 'placeholder' => 'User Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('account_id', 'Account Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('account_id', null, ['class' => 'form-control', 'placeholder' => 'Account Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('category_id', 'Category Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('category_id', null, ['class' => 'form-control', 'placeholder' => 'Category Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('temp_id', 'Temp Id :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('temp_id', null, ['class' => 'form-control', 'placeholder' => 'Temp Id', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('slug', 'Slug :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug', 'required' => 'required']) }}
    </div>
</div> -->
<div class="form-group">
    {{ Form::label('company_name', 'Company Name :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('owner_1', 'Main Owner :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('owner_1', null, ['class' => 'form-control', 'placeholder' => 'Main Owner', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('owner_2', 'Other Partner:', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('owner_2', null, ['class' => 'form-control', 'placeholder' => 'Partner']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('contact_primary', 'Primary Contact:', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('contact_primary', null, ['class' => 'form-control', 'placeholder' => 'Primary Contact', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('contact_secondary', 'Secondary Contact:', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('contact_secondary', null, ['class' => 'form-control', 'placeholder' => 'Secondary Contact']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('email', 'Email :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('website', 'Website :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website',]) }}
    </div>
</div><div class="form-group">
    {{ Form::label('address', 'Address :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('city', 'City :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) }}
    </div>
</div><div class="form-group">
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
    {{ Form::label('google_map', 'Google Map:', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::text('google_map', null, ['class' => 'form-control', 'placeholder' => 'Google Map Location']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('logo', 'Logo :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::file('logo', null, ['class' => 'form-control', 'placeholder' => 'Logo', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('image', 'Image :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::file('image', null, ['class' => 'form-control', 'placeholder' => 'Image', 'required' => 'required']) }}
    </div>
</div><div class="form-group">
    {{ Form::label('file_pdf', 'File Pdf :', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-10">
        {{ Form::file('file_pdf', null, ['class' => 'form-control', 'placeholder' => 'File Pdf', 'required' => 'required']) }}
    </div>
</div>