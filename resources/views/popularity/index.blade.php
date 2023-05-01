@extends('layouts.app')


@section('content')
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

<div id="results" class="w-25 alert alert-success" style="display: none;">
    Term: <span id="term"></span><br>
    Score: <span id="score"></span>
</div>
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

<div class="modal fade" id="checkIssueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search issue</h5>
            </div>
            <form method="POST" id="checkIssueForm">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="inputName">Term: (required field)</label>
                        <input type="text" class="form-control" id="inputName" name="term"  />
                    </div>
                    <label for="platform">Select Platform:</label>
                    <div class="form-control">
                        <select class="form-select" id="platform" name="platform_id">
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newPlatformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Platform</h5>
            </div>
            <form method="POST" id="newPlatformForm">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="inputName">Platform name: (required field)</label>
                        <input type="text" class="form-control" id="inputTitle" name="title"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputName">API route: (required field)</label>
                        <input type="text" class="form-control" id="inputRoute" name="route"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputName">Prefix for positive results: (required field)</label>
                        <input type="text" class="form-control" id="inputPositive" name="positive"  />
                    </div>
                    <div class="form-group mb-2">
                        <label for="inputName">Prefix for negative results: (required field)</label>
                        <input type="text" class="form-control" id="inputNegative" name="negative"  />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{ $popularities->links('pagination::bootstrap-5') }}

@endsection

@push('scripts')
@endpush