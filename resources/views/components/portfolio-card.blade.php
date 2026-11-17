{{-- Kartu portofolio bergaya papan stasiun. --}}
@props([
    'project',
    'index' => 0,
    'wide' => false,
])

<article {{ $attributes->merge(['class' => 'pcard'.($wide ? ' pcard--wide' : '')]) }} data-reveal="card" data-filter-item="{{ $project['category'] }}">
    <a href="{{ route('portfolio.show', $project['slug']) }}" class="pcard__link" data-cursor="Lihat">
        <header class="pcard__sign">
            <span class="pcard__num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <span class="pcard__title">
                <strong>{{ $project['title'] }}</strong>
                <em>{{ $project['client'] }} · {{ $project['year'] }}</em>
            </span>
            <span class="pcard__go"><x-arrow dir="ne" /></span>
        </header>

        <div class="pcard__media">
            <x-poster :color="$project['color']" :variant="$project['variant']" :image="$project['image']"
                      :alt="'Ilustrasi proyek '.$project['title']" :letter="substr($project['category'], 0, 1)" />
        </div>

        <div class="pcard__body">
            <p>{{ $project['summary'] }}</p>
            <ul class="tags" aria-label="Teknologi yang digunakan">
                @foreach ($project['tech'] as $tech)
                    <li>{{ $tech }}</li>
                @endforeach
            </ul>
        </div>
    </a>
</article>
