<?php

namespace NotificationChannels\AfroMessage;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Notifications\Notification;
use NotificationChannels\AfroMessage\Exceptions\CouldNotSendNotification;
use NotificationChannels\AfroMessage\Exceptions\InvalidMobileNumber;

class AfroMessageChannel
{
    protected PendingRequest $request;

    public function __construct(PendingRequest $http)
    {
        $this->request = $http;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     * @throws CouldNotSendNotification
     * @throws InvalidMobileNumber
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var AfroMessage $message */
        $message = $notification->toAfroMessage($notifiable);

        $mobileNumber = $notifiable->routeNotificationFor('afroMessage');

        if ($message->getTo()) {
            $mobileNumber = $message->getTo();
        }

        if (empty($mobileNumber)) {
            throw InvalidMobileNumber::error();
        }

        $params = [
            'message' => $message->getContent(),
            'sender' => $message->getSender(),
            'from' => $message->getFrom(),
            'to' => $message->getTo(),
        ];

        try {
            $this->request->get('/api/send', $params)->throw();
        } catch (Exception $e) {
            throw CouldNotSendNotification::error($e->getMessage());
        }
    }
}
