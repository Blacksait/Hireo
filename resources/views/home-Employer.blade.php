@extends('layout.main')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card" style="margin-top:5%;">
                <div class="card-header" style="margin-bottom:5%;">Кабинет пользователя</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container mb-5" style="margin-bottom: 10%;">
                        Вы вошли как Employer!!!
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
