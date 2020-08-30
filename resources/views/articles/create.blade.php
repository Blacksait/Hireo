@extends('layout.main')

@section('content')

    <!-- Intro Banner
================================================== -->
    <!-- add class "disable-gradient" to enable consistent background overlay -->
    <div class="intro-banner" data-background-image="images/home-background.jpg">
        <div class="container">

            <div class="container mt-5 mb-5">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 mb-5">
                        <div class="card mb-5">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="container mb-5">
                                        {!! Form::open(['action' => 'ArticlesController@store' , 'method' => 'POST']) !!}
                                        <div class="form-group" style="width: 50%">
                                            {!! Form::label('title','Добавление названия работы') !!}
                                            {!! Form::text('title','',['class' => 'form-control' , 'placeholder' => 'Введите название работы']) !!}
                                        </div>
                                        {!! Form::submit('Добавить',['class' => 'btn btn-success']) !!}
                                        {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Membership Plans / End-->

@endsection
