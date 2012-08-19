<?php

namespace steky\nette\DatePaginator\tests;
use \steky\nette\DatePaginator\IModel;
use \Nette\Object;
use \DateTime;

/**
 * Třída modelu určená jen pro testování.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-08-19
 */
class Model extends Object implements IModel {

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
		return new DateTime('2012-09-14');
	}

	/**
	 * Vrací datum nejbližšího staršího záznamu než zadané datum. Pokud
	 * neexisttuje starší, vrací zadané.
	 *
	 * @param \DateTime $current_date
	 * @return \DateTime
	 */
	public function getClosestPrevious(DateTime $current_date) {
		$current_date = clone $current_date;
		return $current_date->modify('- 1 day');
	}

	/**
	 * Vrací datum nejbližšího novějšího záznamu než zadané datum. Pokud
	 * neexisttuje starší, vrací zadané.
	 *
	 * @param \DateTime $current_date
	 * @return \DateTime
	 */
	public function getClosestNext(DateTime $current_date) {
		$current_date = clone $current_date;
		return $current_date->modify('+ 1 day');
	}

}
