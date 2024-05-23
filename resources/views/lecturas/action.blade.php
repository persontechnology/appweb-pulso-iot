<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
        <a href="{{ route('lecturas.destroy',$lectura->id) }}" data-msg="{{ $lectura->xId($lectura->id)->dev_eui }}" onclick="event.preventDefault(); eliminar(this)" class="dropdown-item">
            <i class="ph ph-trash me-2"></i>
            Eliminar
        </a>
    </div>
</div>