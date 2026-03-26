<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoEstadoActualizado extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Pedido $pedido, public string $estadoAnterior) {}

    public function envelope(): Envelope
    {
        $emojis = [
            'procesando' => '📦',
            'enviado'    => '🚚',
            'entregado'  => '✅',
            'anulado'    => '❌',
            'cancelado'  => '🚫',
        ];
        $emoji = $emojis[$this->pedido->estado] ?? '📋';

        return new Envelope(
            subject: $emoji . ' Tu pedido #' . $this->pedido->id . ' está ' . ucfirst($this->pedido->estado) . ' — ZT|SHOES',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido-estado',
        );
    }
}
