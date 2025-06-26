<h1>¡Bienvenido a ProSalud!</h1>
<p>Hola {{ $user->name }}, gracias por registrarte.</p>
<p>Tu email: {{ $user->email }}</p>
<p>Por favor confirma tu correo haciendo clic en el siguiente enlace:</p>
<p><a href="{{ url('/verificar-email/' . $token) }}">Confirmar mi correo</a></p>
