@extends('layouts.basic')

@section('content_body')
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bullhorn"></i>
                        系统信息
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-info">
                        <h5>PHP版本</h5>

                        <p>{{ PHP_VERSION }}</p>
                    </div>
                    <div class="callout callout-info">
                        <h5>Laravel版本</h5>

                        <p>{{ app()->version() }}</p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop

