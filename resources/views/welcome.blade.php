<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
				<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- Styles -->
        <style>
					.udem-image{
						width:180px;
						height: 180px;
						margin-top:50px;
					}
					body{
							font-family: "Poppins", sans-serif;
							display: flex;
							justify-content: center;
							align-items: center;
							height: 100vh;
							overflow: auto;
							background: linear-gradient(to bottom, #56be65, #69bb8d, #59a49e, #498eaf, #3977c2);
					}
					.login-container{
							background: rgb(255, 255, 255);
							border-radius: 10px;
							padding: 20px;
							box-shadow: 0 0 10px rgba(0,0,0,0.1);
							width:450px;
							height: 350px;
							display: flex;
							flex-direction: column;
							justify-content: center;
							align-items: center;
						}
					.ingresar{
						background: #184d8f;
						color: white;
						padding: 10px 20px;
						border-radius: 15px;
						border: none;
						outline: none;
						box-shadow:  10px 10px 20px #bcbcbc,
												-10px -10px 20px #ffffff;
						transition: all 0.2s ease-in-out;
						font-family: "Poppins", sans-serif;

					}
					.ingresar:hover{
						background: #3977c2;
						color:white;
					}
					form{
						display: flex;
						flex-direction: column;
						justify-content: center;
						align-items: center;
						gap:20px;
						font-family: "Poppins", sans-serif;


					}
					input[type="text"], input[type="password"] {
						font-family: "Poppins", sans-serif;

						border: none;
						outline: none;
						border-bottom: 1px solid #000;
					}
			</style>
    </head>
    <body>
			<div class="container">
				@if (Route::has('login'))
						<nav class="-mx-3 flex flex-1 justify-end">
								@auth
										<a
												href="{{ url('/dashboard') }}"
												class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
										>
												Dashboard
										</a>
								@else
										{{-- <a
												href="{{ route('login') }}"
												class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
										>
												Iniciar sesión
										</a> --}}
	
										@if (Route::has('register'))
												{{-- <a
														href="{{ route('register') }}"
														class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
												>
														Registrarse
												</a> --}}
										@endif
								@endauth
						</nav>
				@endif
				<div class="login-container">
					<img src="{{asset('/assets/udem.png')}}" alt="" class="udem-image">
					<h1>Iniciar sesión</h1>
					{{-- <form action="">
						<img src="{{asset('/resources/assets/usuario.png')}}" alt="">
						<input type="text" name="" id="" placeholder="Correo">
						<img src="{{asset('/resources/assets/contra.png')}}" alt="">
						<input type="password" name="" id="" placeholder="Contraseña">
						<button type="submit" class="ingresar">Ingresar</button>

					</form> --}}
					<form method="POST" action="{{ route('login') }}">
						@csrf
		
						<!-- Email Address -->
						<div>
								<x-input-label for="email" :value="__('Correo')" />
								<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
								<x-input-error :messages="$errors->get('email')" class="mt-2" />
						</div>
		
						<!-- Password -->
						<div class="mt-4">
								<x-input-label for="password" :value="__('Contraseña')" />
		
								<x-text-input id="password" class="block mt-1 w-full"
																type="password"
																name="password"
																required autocomplete="current-password" />
		
								<x-input-error :messages="$errors->get('password')" class="mt-2" />
						</div>
		
						<!-- Remember Me -->
						<div class="block mt-4">
								<label for="remember_me" class="inline-flex items-center">
										<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
										<span class="ms-2 text-sm text-gray-600">Recordarme</span>
								</label>
						</div>
		
						<div class="flex items-center justify-end mt-4">
								{{-- @if (Route::has('password.request'))
										<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
												¿Olvidaste tu contraseña?
										</a>
								@endif --}}
		
								<button class="ingresar">Ingresar</button>
						</div>
				</form>
				</div>
			</div>
    </body>
</html>
