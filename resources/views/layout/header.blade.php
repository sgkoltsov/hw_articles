<div class="container">
	<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">
			<!-- <a class="link-secondary" href="#">Subscribe</a> -->
			</div>

			<div class="col-4 text-center">
				<a class="blog-header-logo text-dark" href="/">Skillbox Laravel</a>
			</div>

			<div class="col-4 d-flex justify-content-end align-items-center">
				<a class="link-secondary" href="#" aria-label="Search">
			  		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
				</a>

				<!-- <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a> -->	

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))		                               
                            <a class="btn btn-sm btn-outline-secondary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>                
                    @endif

                    @if (Route::has('register'))		                                
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>                
                    @endif
                @else                    
                    
                	<span class="h5 me-2 mt-2">
                        {{ Auth::user()->name }}
                    </span>
                    
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>                    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                        
                @endguest
			</div>
		</div>
	</header>

	<div class="nav-scroller py-1 mb-2">
		<nav class="nav d-flex justify-content-between" style="justify-content: left!important;">
			<a class="p-2 link-secondary" href="/">Главная</a>
			<a class="p-2 link-secondary" href="/news">Новости</a>
			<a class="p-2 link-secondary" href="/about">О нас</a>
			<a class="p-2 link-secondary" href="/contacts">Контакты</a>
			<a class="p-2 link-secondary" href="/articles/create">Создать статью</a>			
			<a class="p-2 link-secondary" href="/telescope">Telescope</a>
						
		</nav>
	</div>

	<div class="nav-scroller">
		<nav class="nav d-flex justify-content-between" style="justify-content: left!important;">
			@admin				
				<a class="p-2 link-info" href="/admin/articles">Управление статьями</a>
				<a class="p-2 link-info" href="/admin/news">Управление новостями</a>
				<a class="p-2 link-info" href="/admin/feedback">Просмотр обращений</a>
			@endadmin
		</nav>
	</div>
</div>