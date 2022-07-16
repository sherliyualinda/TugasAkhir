<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title')</title>

  {{-- Style --}}
  @stack('prepend-style')
  @include('includes.style')
  @stack('addon-style')
</head>

<body>
  <div class="theme-layout">
  {{-- Navbar --}}
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		@include('theme.nav_bar')
	</nav>


  {{-- Page Content --}}
  @yield('content')

  {{-- Footer --}}
  @include('includes.footer')

</div>

  {{-- Script --}}
  @stack('prepend-script')
  @include('includes.script')
  @stack('addon-script')
  @yield('script')
</body>

</html>