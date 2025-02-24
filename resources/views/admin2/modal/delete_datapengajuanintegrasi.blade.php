  <!-- Modal -->
  <div class="modal fade" id="hapuspengajuan{{$list->id}}" tabindex="-1" aria-labelledby="hapuspengajuan" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/datapengajuanintegrasi_delete{{$list->id}}" method="post">
            @csrf
            @method('delete')
            {{-- header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="HpauspengajuanLabel">Hapus Pengajuan Integrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <div class="modal-body">
          Apakah anda yakin ingin mengahapus data ini?
          Pengajuan : <strong>{{$list->nama_pengajuan_integrasi}}</strong>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tidak</button>
          <button type="submit" class="btn btn-primary">iya</button>
        </div>
    </form>
      </div>
    </div>
  </div>
