@extends('Layout.app')
@section('title','Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                        <p class="count-card-logo"> <i class="fas fa-users fa-3x"></i> </p>
                        <h3 class="count-card-title">{{$TotalVisitor}}</h3>
                        <p class="count-card-text">Total Visitor</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                         <p class="count-card-logo"><i class="fas fa-globe fa-3x"></i></p>
                        <h3 class="count-card-title">{{$TotalService}}</h3>
                        <p class="count-card-text">Total Services</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                        <p class="count-card-logo"><i class="fas fa-code fa-3x"></i> </p>
                        <h3 class="count-card-title">{{$TotalProject}}</h3>
                        <p class="count-card-text">Total Projects</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                        <p class="count-card-logo"><i class="fas fa-book-open fa-3x"></i> </p>
                        <h3 class="count-card-title">{{$TotalCourse}}</h3>
                        <p class="count-card-text">Total Courses</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                        <p class="count-card-logo"><i class="fas fa-envelope fa-3x"></i> </p>
                        <h3 class="count-card-title">{{$TotalContact}}</h3>
                        <p class="count-card-text">Total Contacts</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 p-2">
                <div class="card count-card text-center">
                    <div class="card-body">
                        <p class="count-card-logo"><i class="fas fa-comments fa-3x"></i> </p>
                        <h3 class="count-card-title">{{$TotalReview}}</h3>
                        <p class="count-card-text">Total Reviews</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
