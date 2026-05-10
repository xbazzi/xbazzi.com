<div class="">
    @include('_partials.terminal-title', ['text' => 'links', 'icon' => 'link'])
    <div class="bg-gradient-to-t from-black via-gray-900 to-black opacity-80">
        {{-- <nav id="nav"> --}}
        <div class="text-white">
            <ul>
                <li>
                    @include('_partials.link', [
                        'text' => 'Home',
                        'icon_type' => 'solid',
                        'icon' => 'home',
                        'newtab' => false,
                        'link' => '/',
                    ])
                </li>
                <li>
                    @include('_partials.link', [
                        'text' => 'GitHub',
                        'icon_type' => 'brands',
                        'icon' => 'github',
                        'link' => 'https://github.com/xbazzi',
                    ])
                </li>
                <li>
                    @include('_partials.link', [
                        'text' => 'LinkedIn',
                        'icon_type' => 'brands',
                        'icon' => 'linkedin',
                        'link' => 'https://linkedin.com/in/alexbazzi',
                    ])
                </li>
            </ul>
            <div class="flex justify-between items-center pb-2 pl-5 pt-2 ">
                <a target='_blank' rel='noreferrer noopener' href='mailto:xander@xbazzi.com'>
                    <img class="h-auto" src="/assets/img/gifs/email_keyboard.gif">
                </a>
            </div>
        </div>
    </div>
    {{-- </nav> --}}
</div>

<div class="mt-5 bg-gradient-to-t from-black via-gray-900 to-black opacity-80">
    @include('_partials.terminal-title', ['text' => 'isocpp.org_rss', 'icon' => 'rss'])
    <div class="text-white pl-1" id="rss-feed">Loading... Or is it?</div>
</div>
</div>
