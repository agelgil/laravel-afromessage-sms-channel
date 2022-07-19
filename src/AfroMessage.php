<?php

namespace NotificationChannels\AfroMessage;

class AfroMessage
{
    /** @var string */
    protected string $content;

    /** @var string|null */
    protected ?string $sender = null;

    /** @var string|null */
    protected ?string $from = null;

    /** @var string|null */
    protected ?string $to = null;

    /**
     * Set content for this message.
     *
     * @param  string  $content
     * @return self
     */
    public function content(string $content): self
    {
        $this->content = trim($content);

        return $this;
    }

    /**
     * @param  string|null  $sender
     * @return self
     */
    public function sender(?string $sender): self
    {
        $this->sender = trim($sender);

        return $this;
    }

    /**
     * @param  string|null  $from
     * @return self
     */
    public function from(?string $from): self
    {
        $this->from = trim($from);

        return $this;
    }

    /**
     * @param  string|null  $to
     * @return self
     */
    public function to(?string $to): self
    {
        $this->to = trim($to);

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getSender(): ?string
    {
        return $this->sender ?? config('services.afromessage.sender');
    }

    /**
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from ?? config('services.afromessage.from');
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }
}
