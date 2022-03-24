@if(is_numeric($toFind))
    @if($po)
        <div class="list-group list-group-flush" style="color: #414141;">
            <a href="/supplier/{{ $po->supplier->rut }}/order/{{$po->order_number}}" class="list-group-item list-group-item-action media d-flex direct-search">
                {{ $po->order_number }} | {{ $po->supplier->name }} <br>
            </a>
        </div>
    @else
        <div class="list-group list-group-flush" style="color: #414141;"><a href="#" class="list-group-item list-group-item-action media d-flex direct-search">Es posible que la OC: '{{ $toFind }}' esté cerrada o no exista.</a></div>
    @endif
@else
    <div class="list-group list-group-flush" style="color: #414141;">
    @forelse($suppliers as $supplier)

            <a href="/supplier/{{ $supplier->rut }}/orders" class="list-group-item list-group-item-action media d-flex">
                <strong><i class="fas fa-truck"></i> {{ $supplier->rut }}</strong> &nbsp;{{ $supplier->name }}
                <br>
            </a>

    @empty
       <a href="#" class="list-group-item list-group-item-action media d-flex">No se encontraron Resultados con '{{ $toFind }}'</a>
    @endforelse
    </div>
@endif

