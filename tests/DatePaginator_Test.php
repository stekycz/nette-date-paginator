<?php

namespace steky\nette\DatePaginator\tests;
use \steky\nette\DatePaginator\DatePaginator;
use \steky\nette\DatePaginator\Period\Day;
use \steky\nette\DatePaginator\tests\Model;
use \PHPUnit_Framework_TestCase;
use \DateTime;

/**
 * Základní testy pro třídu stránkovače podle data.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-07-23
 */
class DatePaginator_Test extends PHPUnit_Framework_TestCase {

	/** @var \steky\nette\DatePaginator\DatePaginator */
	private $datePaginator;

	/**
	 * Nastaví stránkovačí mockované objekty modelu a periody.
	 */
	protected function setUp() {
		parent::setUp();
		$this->datePaginator = new DatePaginator();
		$this->datePaginator->setModel(new Model());
		$this->datePaginator->setPeriod(new Day());
	}

	/**
	 * @dataProvider dataProviderSetDate
	 * @param \DateTime $expected
	 * @param \DateTime $value
	 */
	public function testSetDate(DateTime $expected, DateTime $value) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($value);
		$this->assertEquals($expected, $date_paginator->getDate());
	}

	public function dataProviderSetDate() {
		return array(
			array(new DateTime('2012-07-22 00:00:00'), new DateTime('2012-07-22 00:00:00')),
			array(new DateTime('2012-07-23 00:00:00'), new DateTime('2012-07-23 12:34:56')),
		);
	}

	/**
	 * Testuje, že zadané datum nikdy nevystoupí ze zadaných mezí minimálního
	 * a maximálního data.
	 *
	 * @depends testSetDate
	 */
	public function testGetDateInRange() {
		$date_paginator = $this->datePaginator;

		$date_paginator->setDate(new DateTime('2012-06-01'));
		$this->assertEquals($date_paginator->getOldestDate(), $date_paginator->getDate());

		$date_paginator->setDate(new DateTime('2012-09-31'));
		$this->assertEquals($date_paginator->getNewestDate(), $date_paginator->getDate());
	}

	/**
	 * Testuje, zda není upravena instance zadaná jako parametr.
	 */
	public function testNotModifiedParameter() {
		$value = new DateTime('2012-07-23 12:34:56');
		$date_paginator = $this->datePaginator;

		$date_paginator->setDate($value);
		$this->assertEquals($value, new DateTime('2012-07-23 12:34:56'));
	}

	/**
	 * @dataProvider dataProviderWrongParameterType
	 * @expectedException \Nette\FatalErrorException
	 * @param mixed $parameter
	 */
	public function testWrongParameterTypeSetDate($parameter) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($parameter);
	}

	public function dataProviderWrongParameterType() {
		return array(
			array("testovací řetězec"),
			array(null),
			array(123),
			array(1.23),
			array(''),
			array(0),
			array(0.0),
		);
	}

	/**
	 * @depends testSetDate
	 * @dataProvider dataProviderIsOldest
	 * @param bool $expected
	 * @param \DateTime $current_date
	 */
	public function testIsOldest($expected, DateTime $current_date) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($current_date);
		$this->assertEquals($expected, $date_paginator->isOldest());
	}

	public function dataProviderIsOldest() {
		return array(
			array(true, new DateTime('2012-06-14 00:00:00')),
			array(false, new DateTime('2012-06-15 00:00:00')),
			array(true, new DateTime('2012-06-14 23:59:59')),
			array(false, new DateTime('2012-06-15 00:00:01')),
		);
	}

	/**
	 * @depends testSetDate
	 * @dataProvider dataProviderIsNewest
	 * @param bool $expected
	 * @param \DateTime $current_date
	 */
	public function testIsNewest($expected, DateTime $current_date) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($current_date);
		$this->assertEquals($expected, $date_paginator->isNewest());
	}

	public function dataProviderIsNewest() {
		return array(
			array(true, new DateTime('2012-09-14 00:00:00')),
			array(false, new DateTime('2012-09-13 00:00:00')),
			array(true, new DateTime('2012-09-14 00:00:01')),
			array(false, new DateTime('2012-09-13 23:59:59')),
		);
	}

	public function testGetDays() {
		$date_paginator = $this->datePaginator;
		$this->assertEquals(92, $date_paginator->getDays());
	}

	/**
	 * @dataProvider dataProviderGetPreviousDate
	 * @param \DateTime $expected
	 * @param \DateTime $current
	 */
	public function testGetPreviousDate(DateTime $expected, DateTime $current) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($current);
		$this->assertEquals($expected, $date_paginator->getPreviousDate());
	}

	public function dataProviderGetPreviousDate() {
		return array(
			array(new DateTime('2012-07-22 00:00:00'), new DateTime('2012-07-23 00:00:00')),
			array(new DateTime('2012-07-21 00:00:00'), new DateTime('2012-07-22 00:00:00')),
			array(new DateTime('2012-07-18 00:00:00'), new DateTime('2012-07-19 00:00:00')),
			array(new DateTime('2012-06-14 00:00:00'), new DateTime('2012-06-14 00:00:00')),
		);
	}

	/**
	 * @dataProvider dataProviderGetNextDate
	 * @param \DateTime $expected
	 * @param \DateTime $current
	 */
	public function testGetNextDate(DateTime $expected, DateTime $current) {
		$date_paginator = $this->datePaginator;
		$date_paginator->setDate($current);
		$this->assertEquals($expected, $date_paginator->getNextDate());
	}

	public function dataProviderGetNextDate() {
		return array(
			array(new DateTime('2012-07-24 00:00:00'), new DateTime('2012-07-23 00:00:00')),
			array(new DateTime('2012-07-25 00:00:00'), new DateTime('2012-07-24 00:00:00')),
			array(new DateTime('2012-07-28 00:00:00'), new DateTime('2012-07-27 00:00:00')),
			array(new DateTime('2012-09-14 00:00:00'), new DateTime('2012-09-14 00:00:00')),
		);
	}

}
