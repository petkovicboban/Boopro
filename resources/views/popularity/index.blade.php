@extends('layouts.app')


@section('content')

@include('partials.show-message-modal')
@include('partials.check-issue-modal')
@include('partials.result-modal')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="d-flex justify-content-between mb-2">
          <div class="d-inline-flex">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkIssueModal">
                Check Issue
            </button>
          </div>
        </div>
    </div>
</div>

<table class="table" style="table-layout: fixed;">
    <thead class="border">
        <tr>
            <th style="width:5%">No</th>
            <th class="font-weight-bold">Term</th>
            <th class="font-weight-bold">Platform</th>
            <th class="font-weight-bold">Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($popularities as $key => $popularity)
        <tr>
            <td>{{ $page == 1 ? $loop->index + 1 : ($page - 1)*10 + $loop->index + 1 }}</td>
            <td>{{ $popularity->term }}</td>
            <td>{{ $popularity->dynamic_routes->title }}</td>
            <td>{{ $popularity->score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $popularities->links('pagination::bootstrap-5') }}

@endsection