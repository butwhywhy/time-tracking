<?php
/**
 * TaskFreak! Time Tracker
 * 
 * @package taskfreak_tt
 * @author Stan Ozier <taskfreak@gmail.com>
 * @version 0.5
 * @copyright GNU General Public License (GPL) version 3
 */
 
/**
 * Task
 * 
 * Class representing a task
 * @since 0.1
 */
class TaskModel extends Model {

	public function __construct() {
		parent::__construct('task');
		$this->addProperties(array(
			'id'				=> 'UID',
			'title'				=> 'STR',
			'note'				=> 'BBS',
			'priority'			=> 'NUM,'.json_encode($GLOBALS['config']['task']['priority']),
			'begin'				=> 'DTE',
			'deadline'			=> 'DTE',
			'status'			=> 'NUM,{"options":["todo","done","valid"],"default":0}',
			'archived'			=> 'BOL',
			'member_id'			=> 'NUM'
		));
	}
	
	/**
	 * check submitted data before saving task
	 */
	public function checkUid($usrId) {
		if ($this->isEmpty('begin')) {
			$this->set('begin','9999-00-00');
		}
		if ($this->isEmpty('deadline')) {
			$this->set('deadline','9999-00-00');
		}
		if ($this->isEmpty('member_id') && APP_SETUP_USER_MODEL) {
			$this->set('member_id', $usrId);
		}
		return parent::check('title');
	}
	
	/**
	 * parse a single line string for task params
	 * @return a task object
	 */
	public static function parse($str, &$def, &$dte) {
		if (!preg_match('/^(\* |\*{2,3})?([+|-][0-9]{0,2}|[0-9]{2}\/[0-9]{2})?( ?[0-9]+\))?(.+)?$/',$str, $arr)) {
			return false;
		}
		ArrayHelper::arrayTrim($arr);
		$obj = new TaskModel();
		$tst = (empty($arr[1]))?substr($arr[2],0,1):'*';
		switch ($tst) {
		case '*': // multiple
			if ($arr[1] == '**') {
				// reset default date (**)
				$dte = '';
			} else if ($arr[1] == '***') {
				// reset default title (***)
				$def = '';
			} else {
				if ($arr[2]) {
					// remember date
					if ($tst == '+') {
						if ($n = substr($arr[2], 1)) {
							// number of days later
							$obj->set('deadline',$arr[2].' days');
						} else {
							// no number, means today
							$obj->set('deadline', APP_SQL_TODAY);
						}
					} else {
						$dte = $arr[2];
					}
				}
				if ($arr[4]) {
					// remember title
					$def = $arr[4];
				}
			}
			return false;
			break;
		case '-': // no deadline
			$obj->set('deadline','9999-00-00');
			break;
		case '+': // specify deadline
			if ($n = substr($arr[2], 1)) {
				// number of days later
				$obj->set('deadline',$arr[2].' days');
			} else {
				// no number, means today
				$obj->set('deadline', date_format(new DateTime('now', $GLOBALS['config']['datetime']['timezone_user']), 'Y-m-d'));
			}
			break;
		default:
			if ($arr[2]) {
				// specific date set
				$obj->set('deadline', $arr[2]);
				$dte = $obj->get('deadline');
			} else if (!empty($dte)) {
				// use default date (from batch)
				$obj->set('deadline', $dte);
			} else if ($GLOBALS['config']['task']['date']) {
				// use default date (config)
				$obj->set('deadline', date_format(new DateTime($GLOBALS['config']['task']['date'], $GLOBALS['config']['datetime']['timezone_user']), 'Y-m-d'));
				// $dte = $obj->get('deadline');
			} else {
				// no date by default (config)
				$dte = '';
			}
		}
		$prio = $GLOBALS['config']['task']['priority']['default']; // default priority
		if ($arr[3]) {
			// priority ?
			$prio = intval(substr($arr[3],0,-1));
		}
		$obj->set('priority',$prio);
		$title = $arr[4];
		if ($def) {
			$title = $def.' : '.$title;
		}
		$obj->set('title',$title);
		return $obj;
	}
	
	/*
	 * set archive status for multiple tasks
	 */
	public static function updateManyAtOnce($action, $arr) {
		if (!count($arr)) {
			return false;
		}
		$sta = '';
		switch ($action) {
			case 'report':
				$sta = 'deadline = DATE_ADD(deadline, INTERVAL 1 DAY)';
				break;
			case 'open':
				$sta = 'status=0';
				break;
			case 'close':
				$sta = 'status=1';
				break;
			case 'valid':
				$sta = 'status=2';
				break;
			case 'archive':
				$sta = 'archived=1';
				break;
			case 'unarchive':
				$sta = 'archived=0';
				break;
		}
		if ($sta) {
			$filter = 'id IN ('.implode(',',$arr).')';
			DbConnector::query('UPDATE task SET '.$sta.' WHERE '.$filter);
			return true;
		}
		return false;
	}
}

class TaskSummary extends TaskModel {

	public function __construct() {
		parent::__construct();
		$this->addProperties(array(
			'start'		=> 'DTM',
			'stop'		=> 'DTM',
			'spent'		=> 'NUM',
			'timers'	=> 'NUM'
		));
	}
	
	public function htmlPriority() {
		$arr = $this->getPropertyOptions('priority');
		$st = $this->get('priority');
		return $st.') '.TR::html('priority',$arr['options'][$st]);
	}
	
	public function htmlStatus() {
		$arr = $this->getPropertyOptions('status');
		$str = $this->get('status');
		$str = TR::html('task',$arr['options'][$str]);
		if ($this->get('archived')) {
			$str .= ' ('.TR::html('task','archived').')';
		}
		return $str;
	}
	
	public function htmlTimes() {
		return $this->html('start',APP_DATETIME_SHT).' &gt; '.$this->html('stop','%H:%M');
	}
	
	public function htmlBegin() {
		if ($this->isEmpty('start')) {
			if ($this->isEmpty('begin')) {
				return '-';
			} else {
				return $this->html('begin',APP_DATE);
			}
		} else {
			return $this->html('start',APP_DATETIME);
		}
	}
	
	public function getEnd() {
		if ($this->isEmpty('stop')) {
			if ($this->isEmpty('deadline')) {
				return '';
			} else {
				return $this->get('deadline');
			}
		} else {
			return $this->get('stop');
		}
	}
	
	public function htmlEnd($expanded=false, $default='-') {
		if ($this->isEmpty('stop')) {
			return $default;
		} else {
			return $this->html('stop',APP_DATETIME);
		}
	}
	
	public function htmlDeadline() {
		if ($this->isEmpty('deadline')) {
			return '-';
		} else {
			switch ($this->_diff) {
			case 9999:
				return '-';
			case -1:
				return TR::html('date','yesterday');
			case 0:
				return TR::html('date','today');
			case 1:
				return TR::html('date','tomorrow');
			default:
				return $this->html('deadline',APP_DATE);
			}
		}
	}
	
	public function getTimeSpent() {
		return $this->htmlTime($this->get('spent'), $this->isEmpty('start'));
	}
	
	public function getRealSpentSecs() {
		return APP_NOW - strtotime($this->get('start'));
	}
	
	public function getRealSpent() {
		$spent = $this->getRealSpentSecs();
		$h = floor($spent / 3600);
		$m = floor($spent / 60) - ($h*60);
		$s = $spent - ($h*3600 + $m*60);
		return str_pad($h, 2, '0',STR_PAD_LEFT)
			.':'.str_pad($m, 2, '0',STR_PAD_LEFT)
			.':'.str_pad($s, 2, '0',STR_PAD_LEFT);
	}
	
	public function chkDeadline() {
		if ($this->isEmpty('deadline')) {
			$this->_diff = 9999;
		} else {
			$dead = date_timestamp_get(new DateTime($this->get('deadline'), $GLOBALS['config']['datetime']['timezone_user']));
			// -TODO- optimize ! maybe using DateTime diff ?
			$usernow = date_timestamp_get(new DateTime('now'));
			$this->_diff = ceil(($dead - $usernow) / 3600 / 24);
		}		
	}
	
	public function isOpened($user_id) {
		// -TODO- if no "validate" option, do not allow on closed tasks
		return ($this->get('status') < 2 && (!$this->get('archived')) && ($this->get('member_id') == $user_id));
	}
	
	public function curCss($default='') {
		$arr = array();
		if ($this->_diff < 0) {
            $arr[] = 'overdue';
		} else if ($this->_diff == 0) {
			$arr[] = 'today';
		} else {
			$arr[] = 'future';
		}
		if ($default) {
			$arr[] = $default;
		}
		if (count($arr)) {
			return ' class="'.implode(' ',$arr).'"';
		} else {
			return '';
		}
	}
	
	public function htmlDate() {
		$str = $this->html('end_date',APP_DATE_FRM,'no_date');
		if ($css = $this->curCss()) {
			return '<span'.$css.'>'.$str.'</span>';
		} else {
			return $str;
		}
	}
	
	public static function htmlTime($spent, $stopped=true) {
		if (empty($spent)) {
			if ($stopped) {
				return '--:--';
			} else {
				return TR::html('task','running');
			}
		}
		$h = floor($spent / 60);
		$m = $spent - ($h*60);
		return str_pad($h, 2, '0',STR_PAD_LEFT).':'.str_pad($m, 2, '0',STR_PAD_LEFT);
	}
	
	/**
	 * export data in array for the mobile version (ajax requests)
	 */
	public function exportData($method='html') {
		// prepare general info
		$arrInfo = array();
		$arr = $this->getFields();
		foreach ($arr as $key => $type) {
			$arrInfo[$key] = $this->$method($key);
		}
		
		// prepare timer history and totals
		$total = 0;
		$arrSpent = array();
		if ($this->get('spent')) {
			do {
				$total += $this->get('spent');
				// start and stop times
				$times = $this->htmlTimes();
				$spent = $this->getTimeSpent();
				$arrSpent[$times] = $spent;
			} while ($this->next());
		}
		
		$arrInfo['total'] = $this->htmlTime($total);
		
		return array('info' => $arrInfo, 'spent' => $arrSpent);
		// return $arrInfo;
	}
	
	/**
	* update current task status
	*/
	public function updateStatus($status) {
		$this->connectDb();
		$this->set('status',$status);
		$this->fields('status');
		return parent::update();
	}
	
	/**
	 * override load function
	 */
	public function load($filter='') {
		$this->select('id, title, begin, deadline, start, stop, status, archived, '
			.'CEIL(spent/60) as spent');
		$this->from('task');
		$this->leftJoin('timer','task.id=timer.task_id');
		return parent::load($filter, false);
	}
	
	/**
	 * load current running timer
	 */
	public static function loadCurrent($id=0) {
		$obj = new TaskSummary();
		$obj->connectDb();
		if ($id) {
			$obj->setUid($id);
			if ($obj->load()) {
				return $obj;
			}
		} else {
			$ftr = "stop='0000-00-00 00:00:00'";
			if (!empty($_SESSION['appUserId'])) {
				$ftr .= " AND member_id='".$_SESSION['appUserId']."'";
			}
			if ($obj->load($ftr)) {
				return $obj;
			}
		}
		return false;
	}

	public function loadCompactList() {
	/*
		SELECT task.*, MIN(start) as start, MAX(stop) as stop, SUM(CEIL(spent/60)) as spent
		FROM `task` 
		LEFT JOIN timer ON task.id = timer.task_id
		WHERE status < 2
		GROUP BY id
	*/
		$this->select('task.*, MIN(start) as start, MAX(stop) as stop, '
			.'SUM(CEIL(spent/60)) as spent, COUNT(timer.task_id) AS timers');
		$this->from('task');
		$this->leftJoin('timer','task.id=timer.task_id');
		$this->groupBy('id');
		return parent::loadList(false);
	}
	
	public function loadExpandList() {
		$this->select('task.*, start, stop, CEIL(spent/60) as spent');
		$this->from('task');
		$this->leftJoin('timer','task.id=timer.task_id');
		return parent::loadList(false);
	}
	
}
