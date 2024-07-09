<?php

use PHPUnit\Framework\TestCase;
use Tsumari\Icalendar\Cal;

class ExampleTest extends TestCase
{
    public function test()
    {
        $cal = new Cal("てすとかれんだー");
        $cal->addNewEvent("2024-07-09 09:00", "2024-07-09 18:00", false, "Test1です");
        $cal->addNewEvent("2024-07-10 09:00", "2024-07-10 18:00", false, "Test2です");

        $ics = $cal->generateICS();

        $expect_ics = <<<ICS
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//I*Calendar//I*Calendar//EN
X-WR-CALNAME:てすとかれんだー
BEGIN:VEVENT
DTSTART:20240709T090000
DTEND:20240709T180000
SUMMARY:Test1です
DESCRIPTION:
END:VEVENT
BEGIN:VEVENT
DTSTART:20240710T090000
DTEND:20240710T180000
SUMMARY:Test2です
DESCRIPTION:
END:VEVENT
END:VCALENDAR

ICS;

        $this->assertEquals($ics, $expect_ics);

    }

    public function testAllDay()
    {
        $cal = new Cal("てすとかれんだー");
        $cal->addNewEvent("2024-07-09", "2024-07-10", true, "Test1です");
        $cal->addNewEvent("2024-07-11", "2024-07-11", true, "Test2です");

        $ics = $cal->generateICS();

        $expect_ics = <<<ICS
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//I*Calendar//I*Calendar//EN
X-WR-CALNAME:てすとかれんだー
BEGIN:VEVENT
DTSTART:20240709
DTEND:20240710
SUMMARY:Test1です
DESCRIPTION:
END:VEVENT
BEGIN:VEVENT
DTSTART:20240711
DTEND:20240711
SUMMARY:Test2です
DESCRIPTION:
END:VEVENT
END:VCALENDAR

ICS;
        $this->assertEquals($ics, $expect_ics);
    }
}
