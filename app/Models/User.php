<?php

namespace App\Models;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Messages\MailMessage;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Boot the model and customize the email verification notification.
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->sendEmailVerificationNotification();
        });
    }

    /**
     * Override the default email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new class extends VerifyEmail {
            public function toMail($notifiable)
            {
                return (new MailMessage)
                    ->subject('Confirma tu registro en ProSalud')
                    ->greeting('¡Bienvenido a ProSalud, ' . $notifiable->name . '!')
                    ->line('Gracias por registrarte. Estos son tus datos:')
                    ->line('Nombre: ' . $notifiable->name)
                    ->line('Email: ' . $notifiable->email)
                    ->action('Confirmar mi correo', $this->verificationUrl($notifiable))
                    ->line('Si no creaste una cuenta, ignora este mensaje.');
            }
        });
    }

    /**
     * Relación con el modelo Paciente
     */
    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    /**
     * Relación con el modelo Profesional
     */
    public function profesional()
    {
        return $this->hasOne(Profesional::class);
    }

    /**
     * Relación con el modelo Proveedor
     */
    public function proveedor()
    {
        return $this->hasOne(Proveedor::class);
    }
}
