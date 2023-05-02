
<div class="modal fade" id="newPlatformModal" tabindex="-1" role="dialog" aria-labelledby="newPlatformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header">
                <h5 class="modal-title" id="newPlatformLabel">New Platform</h5>
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