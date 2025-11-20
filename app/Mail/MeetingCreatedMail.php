<?php

namespace App\Mail;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Meeting */
    public $meeting;

    /**
     * Create a new message instance.
     *
     * @param Meeting $meeting
     */
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Resolve user and host names for email template
        $requestedByName = 'User';
        if ($this->meeting->requested_by) {
            $user = \App\Models\Auth\User::find($this->meeting->requested_by);
            if ($user) {
                $requestedByName = $user->full_name ?? ($user->first_name . ' ' . $user->last_name);
            }
        }

        $hostName = 'To be confirmed';
        if ($this->meeting->hosts_id) {
            $host = \App\Models\Host::find($this->meeting->hosts_id);
            if ($host) {
                $hostName = $host->name;
            }
        }

        return $this->subject('Meeting Created: ' . ($this->meeting->request_number ?? ''))
                    ->view('emails.meeting.created')
                    ->with([
                        'meeting' => $this->meeting,
                        'requested_by_name' => $requestedByName,
                        'host_name' => $hostName,
                    ]);
    }
}
