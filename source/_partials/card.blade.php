@props([
    'image' => '',
    'image_alt' => 'Foo bar',
    'link' => '/',
    'title' => 'Something',
])


<a href="{{ $link }}"
    style="background-image: url('{{$image}}'); background-size: cover; background-position: center center;"
    class="block
        w-full h-48 lg:h-56 transition-all border border-black/60 rounded-md rounded-xs
        hover:shadow-lg hover:border-verde
        relative group overflow-hidden
">
    <div class="w-full h-full bg-black/0 transition-all rounded-md group-hover:bg-black/60 absolute top-0 left-0"></div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black/70 to-transparent rounded-b-md"></div>
    <!-- <img src="{{ $image }}" alt="{{ $image_alt }}" class="w-full rounded-md h-auto"> -->
    <p class="text-xs sm:text-sm text-center break-words p-2 absolute bottom-1 left-1 right-1 z-10 line-clamp-2 transition transform ease-in-out text-white group-hover:text-center group-hover:-translate-y-32"> {{ $title }}</p>
</a>
