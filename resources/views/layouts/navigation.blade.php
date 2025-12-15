<nav x-data="{ open: false }">
    <div>
        <div>
            <div>
                <a href="{{ route('dashboard') }}">
                    <div>K</div>
                    <span>Family Cafe</span>
                </a>
                <div>
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    <a href="{{ route('order.index') }}">Menu</a>
                </div>
            </div>
            <div>
                <div x-data="{ dropOpen: false }">
                    <button @click="dropOpen = !dropOpen">
                        <div>{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <div x-show="dropOpen" @click.away="dropOpen = false" x-transition>
                        <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <button @click="open = !open">
                    <span x-show="!open">Menu</span>
                    <span x-show="open">Close</span>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': !open}">
        <div>
            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            <a href="{{ route('order.index') }}">Menu</a>
        </div>
        <div>
            <div>
                <div>{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div>
                    <div>{{ Auth::user()->name }}</div>
                    <div>{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">{{ __('Log Out') }}</button>
            </form>
        </div>
    </div>
</nav>
