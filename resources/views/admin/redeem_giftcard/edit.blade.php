<form class="form edit-form" method="POST" action="{{ route('admin.redeem.gift.card.update', $userGiftCard->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-5">
                <label class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control" placeholder="e.g. 50" value="{{ $userGiftCard->amount }}" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group mb-5">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select any Option</option>
                    <option value="pending" {{ $userGiftCard->status == "pending" ? 'selected' : '' }}>Pending</option>
                    <option value="redeemed" {{ $userGiftCard->status == "redeemed" ? 'selected' : '' }}>Redeemed</option>
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
