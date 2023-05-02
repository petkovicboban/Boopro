@extends('layouts.app')

@section('content')

@include('partials.show-message-modal')
@include('partials.new-platform-modal')
@include('partials.edit-platform-modal')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="d-flex justify-content-between mb-2">
          <div class="float-end">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newPlatformModal">
                Add new Platform
            </button>
          </div>
        </div>
    </div>
</div>

<table class="table" style="table-layout: fixed;">
    <thead class="border">
        <tr>
            <th style="width:5%">No</th>
            <th style="width:15%" class="font-weight-bold">Platform</th>
            <th style="width:40%" class="font-weight-bold">Route</th>
            <th class="font-weight-bold">Positive prefix</th>
            <th class="font-weight-bold">Negative prefix</th>
            <th class="font-weight-bold">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($platforms as $platform)
        <tr>
            <td>{{ $page == 1 ? $loop->index + 1 : ($page - 1)*10 + $loop->index + 1 }}</td>
            <td>{{ $platform->title }}</td>
            <td>{{ $platform->route }}</td>
            <td>{{ $platform->positive }}</td>
            <td>{{ $platform->negative }}</td>
            <td>
                <button type="button" class="btn btn-success editPlatform" data-platform="{{ $platform->id }}" data-toggle="modal" data-target="#editPlatformModal">
                    &nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;
                </button>
                <button type="button" class="btn btn-danger deletePlatform" data-platform="{{ $platform->id }}">
                    Delete
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $platforms->links('pagination::bootstrap-5') }}

@endsection