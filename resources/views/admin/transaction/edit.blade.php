<form class="form edit-form" method="POST" action="{{ route('admin.transaction.update', $transaction->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-5">
                <label class="form-label">Update Status</label>
                <select name="status" class="form-control">
                    <option value="">Select any Option</option>
                    <option value="pending" {{ $transaction->status == "pending" ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $transaction->status == "approved" ? 'selected' : '' }}>Approved</option>
                    <option value="declined" {{ $transaction->status == "declined" ? 'selected' : '' }}>Declined</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-5">
            <button type="submit" class="btn btn-primary me-2">
                Save Changes
            </button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('#edit_details_modal')">
                Discard
            </button>
        </div>
    </div>
</form>
