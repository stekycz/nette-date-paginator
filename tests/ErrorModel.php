<?php

namespace steky\nette\DatePaginator\tests;
use DateTime;

/**
 * Třída modelu pro testování špatných dat.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-10-25
 */
class ErrorModel extends Model {

	/**
	 * Vrací datum nejstaršího záznamu.
	 *
	 * @return \DateTime
	 */
	public function getOldestDate() {
		return new DateTime('2012-06-14');
	}

	/**
	 * Vrací datum nejnovějšího záznamu.
	 *
	 * @return \DateTime
	 */
	public function getNewestDate() {
		return new DateTime('2012-05-14');
	}

}
