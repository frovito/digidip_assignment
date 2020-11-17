@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <h3 style="display:inline-block;">Available positions</h3>
                <a href="/jobs/create">
                    <button type="button" class="btn btn-primary btn-sm float-right">Publish Job</button>
                </a>  
              </div>
            </div>
            @foreach ($jobs as $job)
            <div class="card">
                <div class="card-body">
                    <div class="card text-center">
                        <div class="card-header">
                          {{ $job->title }}
                        </div>
                        <div class="card-body">
                          <p class="card-text">{{ $job->description }}</p>
                        </div>
                        <div class="card-footer text-muted">
                          Published on {{ date('F j, Y', strtotime($job->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
