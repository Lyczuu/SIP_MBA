  <!-- Modal -->
  <div class="modal fade" id="hapuspengguna{{$list->id}}" tabindex="-1" aria-labelledby="hapuspengguna" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/datapenggunabaru_delete{{$list->id}}" method="post">
            @csrf
            @method('delete')
        {{-- header --}}
        <div class="modal-header bg-primary text-white">
          <h1 class="modal-title fs-5" id="Hapusdatapenggunaabel">Hapus Data Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin mengahapus data ini?
          pengguna : <strong>{{$list->username}}</strong>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tidak</button>
          <button type="submit" class="btn btn-primary">iya</button>
        </div>
    </form>
      </div>
    </div>
  </div>
