
<div class="modal fade" id="checkIssueModal" tabindex="-1" role="dialog" aria-labelledby="checkIssueLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header">
                <h5 class="modal-title" id="checkIssueLabel">Search issue</h5>
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