@extends('_layouts.main')

@section('body')
    <div class="grid gap-4 grid-cols-1 lg:grid-cols-12 max-w-5xl mx-auto">
        <div class="col-span-full lg:col-span-8 flex flex-col gap-8">
            <x-info-window title="whoami" class="p-4" icon="user">
            <div class="prose prose-stone text-black">
                <p>
                    High performance software engineer, specializing in C++ with a data-oriented approach.
                    Currently focusing on low-latency and real-time programming.
                </p>
                <p>
                    I have spent more hours configuring DevOps and infrastructure than I'm willing
                    to admit -- check out the <a href="/projects/datacenter/index.html">"datacenter"</a>.
                </p>
                <p>
                    As you can see, I am not a front end developer.
                </p>
            </div>
            </x-info-window>

            {{-- Projects section --}}
            <x-info-window title="projects" class="p-4" icon="lightbulb">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($projects as $p)
                        @include('_partials.card', [
                            'title' => $p->title,
                            'image' => $p->image,
                            'link' => $p->url,
                        ])
                    @endforeach
                </div>
            </x-info-window>

            {{-- Blog section --}}
            <x-info-window title="blog" class="p-4" icon="blog">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($blog as $p)
                        @include('_partials.card', [
                            'title' => $p->title,
                            'image' => $p->image,
                            'link' => $p->url,
                        ])
                    @endforeach
                </div>
            </x-info-window>
        </div>
        <div class="col-span-full lg:col-span-4 flex flex-col gap-8">
            <x-terminal-window title="links" icon="link">
                {{-- ['text' => 'Home', 'newtab' => false, 'icon_type' => 'solid', 'icon' => 'home', 'link' => ''], --}}
                @php
                    $links = [
                        ['text' => 'linkedin', 'icon_type' => 'brands', 'icon' => 'linkedin', 'link' => 'https://linkedin.com/in/alexbazzi'],
                        ['text' => 'gitgud.boo', 'icon_type' => 'brands', 'icon' => 'git-alt', 'link' => 'https://gitgud.boo/xbazzi'],
                    ];
                @endphp
                <div class="text-verde p-3">
                    <div class="flex flex-col gap-2 ">
                        @foreach ($links as $link)
                            @include('_partials.link', $link)
                        @endforeach
                        <a id="email-link" target='_blank' class="block" rel='noreferrer noopener' href='#'>
                            <img class="h-auto" src="/assets/img/gifs/email_keyboard.gif">
                        </a>
                    </div>
                </div>

            </x-terminal-window>

            <x-terminal-window title="meetingcpp.com -rss" icon="rss">
                <div class="text-xs p-4 text-verde rounded-md pl-1" id="rss-feed">Loading... Or is it?</div>
            </x-terminal-window>
        </div>
    </div>

    {{-- Footer --}}
@endsection
