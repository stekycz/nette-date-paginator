<?php

namespace DatePaginator\tests\Period;
use \steky\nette\DatePaginator\Period\Month;
use \PHPUnit_Framework_TestCase;
use \DateTime;

/**
 * Třída testující správné chování periody jednoho měsíce.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-08-19
 */
class Month_Test extends PHPUnit_Framework_TestCase {

	/**
	 * Testuje správnost vraceného názvu periody.
	 */
	public function testGetName() {
		$expected_name = 'Month';
		$period = new Month();
		$this->assertEquals($expected_name, $period->getName());
	}

	/**
	 * Testuje správnost vracené periody.
	 */
	public function testGetPeriod() {
		$expected_period = '1 month';
		$period = new Month();
		$this->assertEquals($expected_period, $period->getPeriod());
	}

	/**
	 * Testuje, že perioda správně normalizuje data.
	 */
	public function testNormalizeDate() {
		$expected_normalized_date = new DateTime('2012-08-01 00:00:00');
		$date = new DateTime('2012-08-19 12:34:56');
		$period = new Month();
		// Je datum správně normalizované?
		$this->assertEquals($expected_normalized_date, $period->normalizeDate($date));
		// Nezměnil se původní objekt?
		$this->assertEquals(new DateTime('2012-08-19 12:34:56'), $date);
	}

}
