<div class="table-responsive">
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <thead>
            <tr class="fw-bolder text-muted bg-light">
                <th class="ps-4 rounded-start">Link</th>
                <th class="pe-4 text-end rounded-end">Used By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paypal->links as $link)
                <tr>
                    <td class="ps-4">{{ $link->link }}</td>
                    <td class="pe-4 text-end">{{ $link->user?->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
