  <!-- Modal -->
  <div class="modal fade" id="hapusmitra{{$list->id}}" tabindex="-1" aria-labelledby="hapusmitra" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/mitra_delete{{$list->id}}" method="post">
            @csrf
            @method('delete')
        {{-- header --}}
        <div class="modal-header bg-primary text-white">
          <h1 class="modal-title fs-5" id="HapusdatamitraLabel">Hapus Mitra</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin mengahapus data ini?
          mitra : <strong>{{$list->nama_mitra}}</strong>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tidak</button>
          <button type="submit" class="btn btn-primary">iya</button>
        </div>
    </form>
      </div>
    </div>
  </div>
