<div>
  <h5>Ubah Data Subkriteria</h5>
  <hr>
  <form class="form form-vertical" wire:submit.prevent="updateForm()">
    @csrf
    <div class="form-body">
      <div class="form-group col-12">
        <label for="range">Range</label>
        <input type="text" class="form-control @error('rangeForm') is-invalid @enderror" name="rangeForm"
          wire:model="rangeForm" required {{ $isFormActive ? '' : 'disabled' }} value="{{ $rangeForm }}">
        @error('rangeForm')
          @include('layouts.partial.invalid-form', ['message' => $message])
        @enderror
      </div>
      <div class="form-group col-12">
        <label for="nilai">Nilai</label>
        <select class="form-select @error('nilaiForm') is-invalid @enderror" name="nilaiForm" wire:model="nilaiForm"
          required {{ $isFormActive ? '' : 'disabled' }}>
          @for ($i = 1; $i <= 5; $i++)
            <option value='{{ $i }}' {{ $i == $nilaiForm ? 'selected' : '' }}>{{ $i }}</option>
          @endfor
        </select>
        @error('nilaiForm')
          @include('layouts.partial.invalid-form', ['message' => $message])
        @enderror
      </div>
    </div>
    <div class="col-12 d-flex justify-content-end">
      <button type="submit" class="btn btn-primary mt-4">Ubah Data</button>
    </div>
  </form>

  <section id="list-subkriteria" class="mt-4">
    <div class="row match-height">
      <div class="col-12">
        <div class="card m-0 border shadow-none">
          <div class="card-content">
            <div class="card-body">
              <h5 class="text-center">Daftar Subkriteria</h5>
              <button type="button" class="btn btn-sm btn-danger" wire:click="removeAll()"
                onclick="confirm('Ingin Menghapus Semua Subkriteria?') || event.stopImmediatePropagation()">
                Hapus Semua
              </button>
              @foreach ($allSubkriteriaByKriteriaId as $index => $subkriteria)
                <div class="row align-items-center mt-3">
                  <div class="col-10">
                    <div class="row">
                      <div class="form-group col-12 col-md-6">
                        <label for="range">Range</label>
                        <input type="text" class="form-control" name="range" readonly
                          value="{{ $subkriteria->range }}">
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label for="nilai">Nilai</label>
                        <input type="text" class="form-control" name="nilai" readonly
                          value="{{ $subkriteria->nilai }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="d-flex flex-column">
                      <button type="button" class="btn btn-sm btn-outline-primary min-width-70"
                        wire:click="update({{ $subkriteria->id }})" wire:key="update.{{ $subkriteria->id }}">
                        Ubah
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-danger min-width-70 mt-2"
                        wire:click="remove({{ $subkriteria->id }})" wire:key="remove.{{ $subkriteria->id }}"
                        onclick="confirm('Ingin Menghapus Subkriteria Nilai : {{ $subkriteria->nilai }} ?') || event.stopImmediatePropagation()">
                        Hapus
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
