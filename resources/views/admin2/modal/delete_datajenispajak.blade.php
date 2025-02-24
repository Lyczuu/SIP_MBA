  <!-- Modal -->
  <div class="modal fade" id="hapusjenispajak{{$list->id}}" tabindex="-1" aria-labelledby="hapusjenispajak" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/datajenispajak_delete{{$list->id}}" method="post">
            @csrf
            @method('delete')
        <div class="modal-header bg-primary text-white">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pajak</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin mengahapus data ini?
          Jenis Pajak : <strong>{{$list->nama_jenis_pajak}}</strong>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tidak</button>
          <button type="submit" class="btn btn-primary">iya</button>
        </div>
    </form>
      </div>
    </div>
  </div>
