<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Seabit's DateTime Class
 *
 */
class SDT {
	
	//SDT stack
	private $SDT_info = array();

	var $books_begin_date;

	var $financial_year_begin_month = '04';

	var $financial_year_end_month = '03';

	var $current_financial_years;

	var $financial_year_begin;

	var $financial_year_end;
	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct()
	{	
		$this->ci =& get_instance();
		$this->books_begin_date = '2014-03-01';

		if ( date('m') < $this->financial_year_begin_month ) {
			$this->current_financial_years = ( date('Y')-1 ) . '-' . date('Y');
		} else {
			$this->current_financial_years =  date('Y') . '-' . ( date('Y')+1 );
		}
		
	}

	function getFinancialYears() {
		return $this->current_financial_years;
	}

	// Function to get number of days in a particular month.
	function getDaysinMonth( $month, $year ) {
		$d = cal_days_in_month( CAL_GREGORIAN, $month, $year );
		return $d;
	}
	
	function getEmpLeaveDedutionType( $employeeid = '' ) {
	   return 1;
	}

	// Function to get all days in a month.
	function getAllDaysinMonth( $month, $year ) {
		$arr = array();
		$noDays = $this->getDaysinMonth( $month, $year );
		if ( round($month) == date('m') && $year == date('Y') ) {
			$noDays = date('d');
		}
		for ( $d = 1; $d <= $noDays; $d++ ) {
			if ( $d < 10 ) $d = '0' . round($d);
			if ( $month < 10 ) $m = '0' . round($month);
			array_push( $arr , $year . '-' . $m . '-' . $d );
		}
		return $arr;
	}

	// Function to get all days in a year.
	function getAllDaysinFinancialYear( $fyear ) {
		$arr = array();

		$allMonths = $this->getMonthsFinaicialYear( $fyear );

		foreach ( $allMonths as $amonth ) {
			$noDays = $this->getDaysinMonth( getMonth( $amonth ), getYear( $amonth ) );
			if ( round( getMonth( $amonth ) ) == getMonth() && getYear( $amonth ) == getYear() ) {
				$noDays = date('d');
			}
			for ( $d = 1; $d <= $noDays; $d++ ) {
				if ( $d < 10 ) $d = '0' . round($d);
				if ( getMonth( $amonth ) < 10 ) { 
					$m = '0' . round( getMonth( $amonth ) );
				} else {
					$m = getMonth( $amonth );
				}
				array_push( $arr , getYear( $amonth )  . '-' . $m . '-' . $d );
			}
		}
		return $arr;
	}
	
	// Function to get all months between date.
	function getMonthsBetween( $vdate ) {
		$arr = array();
		$d1 = $vdate;
		$d2 = date('Y-m-d');
		$nomonths = (int)abs((strtotime($d1) - strtotime($d2))/(60*60*24*30))+1; 
		for ( $m = 1; $m <= $nomonths; $m++ ) {
			$st = date('F', strtotime($d1) ) . '-' . date('Y', strtotime($d1) );
			array_push( $arr , $d1 );
			$d1 = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d", strtotime($d1) ) ) ) . " +1 month") );
		}
		return $arr;
	}

	// Function to get all months between date.
	function getMonthsFinaicialYear( $fyear ) {
		$arr = array();

		$ystart1 = explode( '-', $fyear );
		$yend1 = explode( '-', $fyear );

		$ystart = $ystart1[0];
		$yend = $yend1[1];

		$d1 = $ystart . '-' . $this->financial_year_begin_month . '-01';
		$d2 = $yend . '-' . $this->financial_year_end_month . '-05';

		$nomonths = (int)abs((strtotime($d1) - strtotime($d2))/(60*60*24*30))+1; 
		for ( $m = 1; $m <= $nomonths; $m++ ) {
			$st = date('F', strtotime($d1) ) . '-' . date('Y', strtotime($d1) );
			array_push( $arr , $d1 );
			$d1 = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d", strtotime($d1) ) ) ) . " +1 month") );
		}
		return $arr;
	}

	function getDaysBetweenDate( $d1, $d2 ){
		$arr = array();
	
		$noDays = floor( abs(strtotime($d1) - strtotime($d2)) /(60*60*24));
		array_push( $arr , $d1 );
		for ( $d = 1; $d <= $noDays; $d++ ) {
			$dt = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d", strtotime($d1) ) ) ) . " +1 day") );
			$d1 = $dt;
			array_push( $arr , $d1 );
		}
		
		return $arr;	
	}
	
	function getWorkingDays( $year, $month, $ignore ) {
		$count = 0;
		$counter = mktime(0, 0, 0, $month, 1, $year);
		while ( date( "n", $counter ) == $month ) {
			if ( in_array( date( "w", $counter ), $ignore ) == false) {
				if ( $counter >= strtotime('now') ) return (int)$count;
				$count++;
			}
			$counter = strtotime("+1 day", $counter);
		}
		return (int)$count;
	}

}
// END SDT Class

/* End of file SDT.php */
/* Location: ./seabut/libraries/SDT.php */