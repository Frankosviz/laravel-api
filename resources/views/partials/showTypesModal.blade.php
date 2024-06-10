<!-- Modal -->
<div id="show-types" class="modal-dialog modal-xl">

  <div id="show-types" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dettagli del progetto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="f-d-main-second-container f-d-transparent-layer d-none">
            <p class="lightbrown fs-4 fw-bold">
              Descrizione del progetto
            </p>
            <p class="green fw-bold">
              {{ $project->type->description }}
            </p>
            <p class="lightbrown fs-4 fw-bold">
              Tipo di progetto
            </p>
            @if ($project->type)
        <p class="green fw-bold">
          {{ $project->type->name }}
        </p>
      @endif
            <p class="lightbrown fs-4 fw-bold">
              URL del progetto
            </p>
            <p class="green fw-bold me-auto p-2 bd-highlight">
              {{ $project->url }}
            </p>
            <p class="lightbrown fs-4 fw-bold">
              Immagine del progetto
            </p>
            <p class="green fw-bold me-auto p-2 bd-highlight">
              <img class="f-d-img" src="{{ asset('storage/' . $project->image_path)}}" alt="{{ $project->title}}">
            </p>
            <p class="lightbrown fs-4 fw-bold">
              Tecnologie utilizzate
            </p>
            <p class="green fw-bold me-auto p-2 bd-highlight">
              {{ $project->technologies->pluck('name')->implode(', ') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>