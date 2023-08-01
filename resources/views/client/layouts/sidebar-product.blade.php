<div id="accordion" class="font-weight-bolder">
    @php
    $index = 1;
    @endphp
    @foreach($category as $cat)
    <div class="card">
        <div class="card-header bg-dark">
            <a class="card-link text-light" data-toggle="collapse" href="#collapse{{ $index }}">
            {{ $cat->name }}
          </a>
        </div>
        <div id="collapse{{ $index }}" class="collapse" data-parent="#accordion">
            <div class="card-body bg-secondary">
                <ul class="list-group list-inline">
                    <li><a href="product.html/{{ $cat->slug }}-{{ $cat->id }}" class="text-decoration-none text-light">All</a></li>
                    @foreach($brand as $bra)
                    @if($cat->id == $bra->category_id)
                    <li><a href="product.html/{{ $cat->slug }}-{{ $cat->id }}/{{ $bra->slug }}-{{ $bra->id }}" class="text-decoration-none text-light">{{ $bra->name }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @php
    $index ++;
    @endphp
    @endforeach
</div>