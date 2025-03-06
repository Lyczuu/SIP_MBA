<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Data ke Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ route('payment.export') }}" method="GET"> --}}
                    <div class="mb-3">
                        <label for="jumlah_data" class="form-label">Jumlah Data</label>
                        <input type="number" name="jumlah_data" id="jumlah_data" class="form-control" min="1" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Export</button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
