
<div class="modal fade" id="editPlatformModal" tabindex="-1" role="dialog" aria-labelledby="editPlatformModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header">
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