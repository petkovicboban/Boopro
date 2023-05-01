@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="d-flex justify-content-between mb-2">
          <div class="float-end">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newPlatformModal">
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
                    <button type="button" class="btn btn-primary editPlatform" data-platform="{{ $platform->id }}" data-toggle="modal" data-target="#editPlatformModal">
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

<div id="results" class="w-25 alert alert-success" style="display: none;"></div>
<div id="no-data" class="w-25 alert alert-danger" style="display: none;">
    <span id="message"></span>
</div>
@if ($errors)
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<div class="modal fade" id="newPlatformModal" tabindex="-1" role="dialog" aria-labelledby="newPlatformModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="npmodal">New Platform</h5>
            </div>
            <form method="POST" id="newPlatformForm">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="inputTitle">Platform name: (required field)</label>
                        <input type="text" class="form-control" id="inputTitle" name="title"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputRoute">API route: (required field)</label>
                        <input type="text" class="form-control" id="inputRoute" name="route"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputPositive">Prefix for positive results: (required field)</label>
                        <input type="text" class="form-control" id="inputPositive" name="positive"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputNegative">Prefix for negative results: (required field)</label>
                        <input type="text" class="form-control" id="inputNegative" name="negative"  />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPlatformModal" tabindex="-1" role="dialog" aria-labelledby="editPlatformModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="epmodal">Edit Platform</h5>
            </div>
            <form method="POST" id="editPlatformForm">
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="form-group mb-2">
                        <label for="inputTitle">Platform name: (required field)</label>
                        <input type="text" class="form-control" value="" id="inputTitle" name="title1"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputRoute">API route: (required field)</label>
                        <input type="text" class="form-control" value="" id="inputRoute" name="route1"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputPositive">Prefix for positive results: (required field)</label>
                        <input type="text" class="form-control" value="" id="inputPositive" name="positive1"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputNegative">Prefix for negative results: (required field)</label>
                        <input type="text" class="form-control" value="" id="inputNegative" name="negative1"  />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{ $platforms->links('pagination::bootstrap-5') }}

@endsection

@push('scripts')
@endpush