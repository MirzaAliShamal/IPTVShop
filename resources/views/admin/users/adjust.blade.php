<form class="form edit-form" method="POST" action="{{ route('admin.user.adjust.balance', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-5">
                <label class="required form-label">Action</label>
                <select name="action" class="form-control" required>
                    <option value="">Select any Option</option>
                    <option value="deposit">Deposit</option>
                    <option value="refund">Refund</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group mb-5">
                <label class="required form-label">Amount</label>
                <input type="text" name="amount" class="form-control" placeholder="e.g. 10" value="" autocomplete="off" required>
            </div>
        </div>
        <div class="col-12 mt-5">
            <button type="submit" class="btn btn-primary me-2">
                Save Changes
            </button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('#adjust_details_modal')">
                Discard
            </button>
        </div>
    </div>
</form>
