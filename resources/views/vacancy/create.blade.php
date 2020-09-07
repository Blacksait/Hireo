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
                                    {!! Form::open(['action' => 'VacancyController@store' , 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
                                    <div class="form-group" style="width: 50%">
                                        {!! Form::label('name','Добавление имени') !!}
                                        {!! Form::text('name','',['class' => 'form-control' , 'placeholder' => 'Введите имя']) !!}
                                    </div>

                                    <div class="form-group" style="width: 50%">
                                        {!! Form::label('title','Добавление краткого описания') !!}
                                        {!! Form::text('title','',['class' => 'form-control' , 'placeholder' => 'Введите описание']) !!}
                                    </div>

                                    <div class="form-group" style="width: 50%">
                                        {!! Form::label('place','Добавление города') !!}
                                        {!! Form::text('place','',['class' => 'form-control' , 'placeholder' => 'Введите город']) !!}
                                    </div>




                                    <div class="form-group" style="width: 50%">
                                        {!! Form::label('payment','Добавление зарплаты') !!}
                                        {!! Form::text('payment','',['class' => 'form-control' , 'placeholder' => 'добавтье зарплату']) !!}
                                    </div>

                                    <div class="sidebar-widget" style="width: 50%;">
                                        <h3>Category</h3>
                                        <select class="selectpicker default"  multiple data-selected-text-format="count" name="category_types[]" data-size="7" title="All Categories" >
                                            @foreach(\App\Category::all() as $category)
                                                <option value="{{$category->id}}" name="{{$category->name}}" @if(in_array($category->label, request('category_types',[]))) selected @endif>{{ $category->label  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="sidebar-widget" style="width: 50%;">
                                        <h3>Jobs</h3>

{{--                                        <label class="switch"><input type="checkbox" name="job_types[]" value="{{ $job->name  }}" @if(in_array($job->name, request('job_types',[]))) checked @endif ><span class="switch-button"></span> {{ $job->label  }}</label>--}}

                                        <select class="selectpicker default"  multiple data-selected-text-format="count" name="job_types[]" data-size="7" title="All Jobs" >
                                            @foreach(\App\Job::all() as $job)
                                                <option value="{{$job->id}}" name="{{$job->name}}" @if(in_array($job->label, request('job_types',[]))) selected @endif>{{ $job->label  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="tags-container">
                                        @foreach(\App\Tag::all() as $tag)
                                            <div class="tags-container">
                                                <div class="tag">
                                                    <input type="checkbox" id="tag{{$tag->id}}" name="tag_types[]" value="{{$tag->id}}" @if(in_array($tag->name, request('tag_types',[]))) checked @endif />
                                                    <label  for="tag{{$tag->id}}">{{ $tag->label  }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                    <div class="form-group" style="color: #666;" style="width: 50%">

                                        {!! Form::label('logo','Добавление картинки') !!}
                                        {{Form::file('logo')}}
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
