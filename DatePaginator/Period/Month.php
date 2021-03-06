<?php

namespace steky\nette\DatePaginator\Period;
use \steky\nette\DatePaginator\IPeriod;
use \Nette\Object;
use \DateTime;

/**
 * Třída pro periodu jednoho měsíce.
 *
 * @author Martin Štekl <martin.stekl@gmail.com>
 * @since 2012-08-14
 */
class Month extends Object implements IPeriod {

	/**
	 * Vrací název periody.
	 *
	 * @return string
	 */
	public function getName() {
		return $this->getReflection()->getShortName();
	}

	/**
	 * Vrací velikost posunu bez znaménka ve formátu, který akceptuje funkce strtotime().
	 *
	 * @return string
	 */
	public function getPeriod() {
		return '1 month';
	}

    /**
     * Vrací formátovací řetězec pro datum.
     *
     * @return string
     */
    public function getFormatString() {
        return 'F Y';
    }

	/**
	 * Provede normalizaci data pro danou periodu. Jedná-li se o den zaokrouhlí na půlnoc daného data.
	 * Pro hodinovou periodu na začátek hodiny, tedy např.: 13:00:00.
	 *
	 * @param \DateTime $date
	 * @return \DateTime
	 */
	public function normalizeDate(DateTime $date) {
		$date = clone $date;
		return $date->modify('first day of this month')->setTime(0, 0, 0);
	}

}
