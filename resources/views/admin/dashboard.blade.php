@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb')
@include('admin.layouts.breadcrumbs', [
'breadcrumbs' => [
'home' => route('admin_dashboard'),
'Dashboard' => '',
]
])
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>
</div>
@endsection
@section('customScripts')

@endsection