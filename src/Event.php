<?php

namespace Tsumari\Icalendar;
use DateTime;
use DateTimeZone;

class Event
{
    private $dtstart;
    private $dtend;
    private $allday;
    private $summary;
    private $description;

    private $timezone = 'Asia/Tokyo';

    public function __construct($dtstart, $dtend, $allday, $summary, $description = null) {
        $this->allday = $allday;
        $this->dtstart = $this->formatDateTime($dtstart);
        $this->dtend = $this->formatDateTime($dtend);
        $this->summary = $summary;
        $this->description = $description;
    }

    public function toICS() {
        $ics = "BEGIN:VEVENT\r\n";
        $ics .= "DTSTART:{$this->dtstart}\r\n";
        $ics .= "DTEND:{$this->dtend}\r\n";
        $ics .= "SUMMARY:{$this->summary}\r\n";
        $ics .= "DESCRIPTION:{$this->description}\r\n";
        $ics .= "END:VEVENT\r\n";

        return $ics;
    }

    private function formatDateTime($datetime) {
        $date = new DateTime($datetime, new DateTimeZone($this->timezone));
        if($this->allday) {
            return $date->format('Ymd');
        } else {
            return $date->format('Ymd\THis');
        }
    }

}
