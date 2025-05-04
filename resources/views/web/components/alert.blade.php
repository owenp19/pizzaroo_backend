<div class="alert alert-{{ $type ?? 'info' }} shadow-md rounded-md px-4 py-3 mb-4 text-sm font-medium text-white
    {{ $type === 'success' ? 'bg-green-500' : ($type === 'danger' ? 'bg-red-500' : ($type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500')) }}">
    {{ $slot ?? 'Este es un mensaje de alerta predeterminado.' }}
</div>
