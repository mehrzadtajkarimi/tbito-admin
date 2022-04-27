@extends('layouts.app')


@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">{{ $title }}</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <small>
                    <ol class="breadcrumb float-sm-left">
                        {{ $breadcrumb }}
                    </ol>
                </small>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{ $slot }}
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')
{{ $script ?? '' }}
@endsection