@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @test(2018) 
                    <?php
                     /*
                    to create simple @name(parameters)

                    1-go to routes folder and create file blade.php
                    2-write Blade::directive('name',function($parameters){
                        code that @name(parameter) will do
                    });

                    to create simple bladeif like 

                    @checkauth
                    @endcheckauth
                    1-go to routes folder and create file bladeif.php
                    2-write Blade::directive('checkauth',function($parameters){
                        code that @name(parameter) will do
                    });
                     */
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
