<?php

namespace App\Mail;

use App\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The claim instance.
     *
     * @var Claim
     */
    public $claim;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->claim->status === 1) {
            $paramValue = encrypt(["doctor" => $this->claim->doctor_id]);
            $url = url('register') . '/?data=' . $paramValue;
            return $this->view('admin.emails.claims.reviewed')->with('url', $url)->subject('Review for claim profile');
        } else {
            return $this->view('admin.emails.claims.reviewed')->subject('Review for claim profile');

        }
    }
}