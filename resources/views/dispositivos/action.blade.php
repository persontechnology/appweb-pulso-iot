<div class="dropdown">
    <a href="#" class="text-body dropdown-toggle" data-bs-toggle="dropdown">
        <i class="ph-gear"></i>
    </a>

    <div class="dropdown-menu">
        <a href="{{ route('dispositivos.edit',$dis->dev_eui_hex) }}" class="dropdown-item">
            <i class="ph ph-pencil-simple me-2"></i>
            Editar
        </a>
        <a href="{{ route('dispositivos.destroy',$dis->dev_eui_hex) }}" data-msg="{{ $dis->name }}" onclick="event.preventDefault(); eliminar(this)" class="dropdown-item">
            <i class="ph ph-trash me-2"></i>
            Eliminar
        </a>
    </div>
</div>