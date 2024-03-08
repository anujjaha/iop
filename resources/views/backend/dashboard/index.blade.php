@extends('backend.layouts.app')

@section ('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h3>Dashboard</h3>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Welcome To Laravel 9 Quick Panel</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            Hi My Self Anuj Jaha, Fullstack developer with 8+ years of Experience.
        </div>
        <div class="card-footer">
            Email: <a href="mailto:er.anujjaha@gmail.com">er.anujjaha@gmail.com</a>
            <span class="float-right">Mob: +91 8000060541</span>
        </div>
    </div>
</div>
@endsection