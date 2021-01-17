@extends('layout.app')

@section('content')
    <section class="w-full sm:w-1/2 md:w-1/2 mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">My Setup</h1>
        <img src="/img/desk.jpg"
             alt="My Desk Setup" class="rounded pb-2">
        <p>
            Over the years my preferred platform for software development has gone through several iterations. When I
            first
            started playing around with software development at the end of 2013 I was using a MacBook Pro (2012 model I
            believe) as my primary computer along with Sublime Text as my code editor of choice.
        </p>
        <p>As well as my development environment going through an evolutionary cycle, so has the languages that I use
            for
            coding. When I started out I worked primarily in PHP before switching to using mostly JavaScript and
            Typescript.
            These days, I still work with JavaScript but I have also now added in some Python as well as PHP for back
            end
            language.</p>
        <p>
            Currently, I'm using a MacBook Pro 2020 13" with macOS Catalina as my primary machine.
            You
            can see the rest of the tools I use below:
        </p>

        <h2>Hardware:</h2>
        <ul>
            <li>
                Primary Computer:
                <ul>
                    <li>Laptop: MacBook Pro 2020 13" with macOS Catalina</li>
                    <li>Keyboard: Apple Magic Keyboard</li>
                    <li>Trackpad: Apple Magic Trackpad 2</li>
                    <li>Mouse: Logitech MX Master</li>
                    <li>Primary Display: Samsung U28E590D - 28" 4K</li>
                </ul>
            </li>
            <br/>
            <li>
                Secondary Computer:
                <ul>
                    <li>Desktop: Self built gaming machine with Windows 10 - generally only used for UI testing and some
                        light
                        gaming
                    </li>
                    <li>Keyboard: Corsair K55 RGB</li>
                    <li>Mouse: Logitech MX Master</li>
                    <li>Primary Display: Samsung U28E590D - 28" 4K</li>
                </ul>
            </li>
            <br/>
            <li>Speakers: Bose Companion 2 series III</li>
            <li>Headphones: Apple Airpods / Bose QuietComfort 35 mk II</li>
            <li>Storage: Synology DS120j</li>
        </ul>
        <h2>Software:</h2>
        <ul>
            <li>
                Editors:
                <ul>
                    <li>PyCharm</li>
                    <li>WebStorm</li>
                    <li>Visual Studio Code</li>
                </ul>
            </li>
            <br/>
            <li>
                Browsers:
                <ul>
                    <li>Brave</li>
                    <li>FireFox</li>
                    <li>Safari</li>
                </ul>
            </li>
            <br/>
            <li>
                Misc:
                <ul>
                    <li>Font: JetBrains Mono (also the font that's used on this site)</li>
                </ul>
            </li>
        </ul>
    </section>
@endsection()
