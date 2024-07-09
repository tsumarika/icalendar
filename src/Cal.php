<?php

namespace Tsumari\Icalendar;
use Tsumari\Icalendar\Event;

class Cal
{
    private $events = [];

    private $company;
    private $project;

    private $calname;

    public function __construct($calname, $company = null, $project = null) {
        $this->calname = $calname;
        $this->company = (!is_null($company)) ? $company : "I*Calendar";
        $this->project = (!is_null($project)) ? $project : "I*Calendar";
    }

    public function addEvent(Event $event) {
        $this->events[] = $event;
    }

    public function addNewEvent($dtstart, $dtend, $summary, $description = null) {
        $event = new Event($dtstart, $dtend, $summary, $description);
        $this->events[] = $event;
    }

    public function generateICS() {
        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//{$this->company}//{$this->project}//EN\r\n";
        $ics .= "X-WR-CALNAME:{$this->calname}\r\n";

        foreach ($this->events as $event) {
            $ics .= $event->toICS();
        }

        $ics .= "END:VCALENDAR\r\n";

        return $ics;
    }
}
