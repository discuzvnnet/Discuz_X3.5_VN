<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id$
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


class sms {

	
	
	const DISCUZ_CLASS_SMS_TYPE_OTHERSRV = 0;
	const DISCUZ_CLASS_SMS_TYPE_SECCHECK = 1;
	const DISCUZ_CLASS_SMS_TYPE_NEWSLETT = 2;

	
	
	const DISCUZ_CLASS_SMS_ERROR_TIMELESS = -1;
	const DISCUZ_CLASS_SMS_ERROR_NUMLIMIT = -2;
	const DISCUZ_CLASS_SMS_ERROR_MILLIMIT = -3;
	const DISCUZ_CLASS_SMS_ERROR_GLBLIMIT = -4;
	const DISCUZ_CLASS_SMS_ERROR_CTFSMSGW = -5;
	const DISCUZ_CLASS_SMS_ERROR_CTFGWNME = -6;
	const DISCUZ_CLASS_SMS_ERROR_CTFGWCLS = -7;
	const DISCUZ_CLASS_SMS_ERROR_SMSDISAB = -8;
	const DISCUZ_CLASS_SMS_ERROR_SMSGWERR = -9;

	
	const DISCUZ_CLASS_SMS_VERIFY_FAIL = 0;
	const DISCUZ_CLASS_SMS_VERIFY_PASS = 1;

	
	const DISCUZ_CLASS_SMSGW_TYPE_SECCODE = 0;
	const DISCUZ_CLASS_SMSGW_TYPE_MESSAGE = 1;

	
	const DISCUZ_CLASS_SMSGW_TYPE_MSG = 0;
	const DISCUZ_CLASS_SMSGW_TYPE_TPL = 1;

	public static function checkseccode($uid, $type, $secmobicc, $secmobile, $seccode) {
		
		$smstimelimit = getglobal('setting/smstimelimit');
		$smstimelimit = $smstimelimit > 0 ? $smstimelimit : 86400;
		$lastsend = C::t('common_smslog')->get_lastsms_by_uumm($uid, $type, $secmobicc, $secmobile);
		$result = self::DISCUZ_CLASS_SMS_VERIFY_FAIL;
		if($seccode == $lastsend['content'] && !$lastsend['verify'] && time() - $lastsend['sendtime'] < $smstimelimit) {
			$result = self::DISCUZ_CLASS_SMS_VERIFY_PASS;
		}
		C::t('common_smslog')->update($lastsend['smslogid'], array('verify' => 1));
		return $result;
	}

	public static function sendseccode($uid, $type, $secmobicc, $secmobile, $seccode, $force = 0) {
		global $_G;
		$time = time();

		if(!getglobal('setting/smsstatus')) {
			$result = self::DISCUZ_CLASS_SMS_ERROR_SMSDISAB;
			self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
			return $result;
		}

		if(!$force) {
			
			$smstimelimit = getglobal('setting/smstimelimit');
			$smstimelimit = $smstimelimit > 0 ? $smstimelimit : 86400;
			
			$smsnumlimit = getglobal('setting/smsnumlimit');
			$smsnumlimit = $smsnumlimit > 0 ? $smsnumlimit : 5;
			
			$smsinterval = getglobal('setting/smsinterval');
			$smsinterval = $smsinterval > 0 ? $smsinterval : 300;
			
			$smsmillimit = getglobal('setting/smsmillimit');
			$smsmillimit = $smsmillimit > 0 ? $smsmillimit : 20;
			
			$smsglblimit = getglobal('setting/smsglblimit');
			$smsglblimit = $smsglblimit > 0 ? $smsglblimit : 1000;

			
			$ut = C::t('common_smslog')->get_sms_by_ut($uid, $smstimelimit);
			$mmt = C::t('common_smslog')->get_sms_by_mmt($secmobicc, $secmobile, $smstimelimit);
			if($time - $ut[0]['sendtime'] < $smsinterval || $time - $mmt[0]['sendtime'] < $smsinterval) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_TIMELESS;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
				return $result;
			}
			if(count($ut) > $smsnumlimit || count($mmt) > $smsnumlimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_NUMLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
				return $result;
			}

			
			$lastmilion = C::t('common_smslog')->count_sms_by_milions_mmt($secmobicc, $secmobile, $smstimelimit);
			if($lastmilion > $smsmillimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_MILLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
				return $result;
			}

			
			$globalsend = C::t('common_smslog')->count_sms_by_time($smstimelimit);
			if($globalsend > $smsglblimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_GLBLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
				return $result;
			}
		}

		$smsgwlist = C::t('common_smsgw')->fetch_all_gw_avaliable();
		foreach($smsgwlist as $key => $value) {
			if(array_search($secmobicc, explode(',', $value['sendrule'])) !== false) {
				if($value['type'] == self::DISCUZ_CLASS_SMSGW_TYPE_MSG) {
					return self::sendmessage($uid, $type, $secmobicc, $secmobile, $seccode, 1);
				}
				$smsgw = $value;
			}
		}

		if(!isset($smsgw)) {
			$result = self::DISCUZ_CLASS_SMS_ERROR_CTFSMSGW;
			self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $seccode);
			return $result;
		}

		$efile = explode(':', $smsgw['class']);
		$efilename = 'smsgw_' . $smsgw['class'] . '.php';
		if(is_array($efile) && count($efile) > 1) {
			$smsgwfile = in_array($efile[0], $_G['setting']['plugins']['available']) ? DISCUZ_ROOT.'./source/plugin/'.$efile[0].'/smsgw/'.$efile[1] : '';
		} else {
			$smsgwfile = DISCUZ_ROOT.'./source/class/smsgw/'.$efilename;
		}

		if($smsgwfile) {
			include($smsgwfile);
			$classname = 'smsgw_' . $smsgw['class'];
			if(class_exists($classname)) {
				$class = new $classname();
				$result = $class->send($uid, $type, $secmobicc, $secmobile, array('seccode' => $seccode));
			} else {
				$result = self::DISCUZ_CLASS_SMS_ERROR_CTFGWCLS;
			}
		} else {
			$result = self::DISCUZ_CLASS_SMS_ERROR_CTFGWNME;
		}

		if($result < 0 && ($result == self::DISCUZ_CLASS_SMS_ERROR_CTFGWCLS || $result == self::DISCUZ_CLASS_SMS_ERROR_CTFGWNME)) {
			$data = array('available' => '0');
			C::t('common_smsgw')->update($smsgw['smsgwid'], $data);
		}

		self::writesmslog($type, $smsgw['smsgwid'], $result, $uid, $secmobicc, $secmobile, $time, $seccode);
		return $result;
	}

	public static function sendmessage($uid, $type, $secmobicc, $secmobile, $message, $force = 0) {
		global $_G;
		$time = time();

		if(!getglobal('setting/smsstatus')) {
			$result = self::DISCUZ_CLASS_SMS_ERROR_SMSDISAB;
			self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
			return $result;
		}

		if(!$force) {
			
			$smstimelimit = getglobal('setting/smstimelimit');
			$smstimelimit = $smstimelimit > 0 ? $smstimelimit : 86400;
			
			$smsnumlimit = getglobal('setting/smsnumlimit');
			$smsnumlimit = $smsnumlimit > 0 ? $smsnumlimit : 5;
			
			$smsinterval = getglobal('setting/smsinterval');
			$smsinterval = $smsinterval > 0 ? $smsinterval : 300;
			
			$smsmillimit = getglobal('setting/smsmillimit');
			$smsmillimit = $smsmillimit > 0 ? $smsmillimit : 20;
			
			$smsglblimit = getglobal('setting/smsglblimit');
			$smsglblimit = $smsglblimit > 0 ? $smsglblimit : 1000;

			
			$ut = C::t('common_smslog')->get_sms_by_ut($uid, $smstimelimit);
			$mmt = C::t('common_smslog')->get_sms_by_mmt($secmobicc, $secmobile, $smstimelimit);
			if($time - $ut[0]['sendtime'] < $smsinterval || $time - $mmt[0]['sendtime'] < $smsinterval) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_TIMELESS;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
				return $result;
			}
			if(count($ut) > $smsnumlimit || count($mmt) > $smsnumlimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_NUMLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
				return $result;
			}

			
			$lastmilion = C::t('common_smslog')->count_sms_by_milions_mmt($secmobicc, $secmobile, $smstimelimit);
			if($lastmilion > $smsmillimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_MILLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
				return $result;
			}

			
			$globalsend = C::t('common_smslog')->count_sms_by_time($smstimelimit);
			if($globalsend > $smsglblimit) {
				$result = self::DISCUZ_CLASS_SMS_ERROR_GLBLIMIT;
				self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
				return $result;
			}
		}

		$smsgwlist = C::t('common_smsgw')->fetch_all_gw_avaliable();
		foreach($smsgwlist as $key => $value) {
			if(array_search($secmobicc, explode(',', $value['sendrule'])) !== false) {
				if($value['type'] == self::DISCUZ_CLASS_SMSGW_TYPE_TPL) {
					continue;
				}
				$smsgw = $value;
			}
		}

		if(!isset($smsgw)) {
			$result = self::DISCUZ_CLASS_SMS_ERROR_CTFSMSGW;
			self::writesmslog($type, 0, $result, $uid, $secmobicc, $secmobile, $time, $message);
			return $result;
		}

		$efile = explode(':', $smsgw['class']);
		$efilename = 'smsgw_' . $smsgw['class'] . '.php';
		if(is_array($efile) && count($efile) > 1) {
			$smsgwfile = in_array($efile[0], $_G['setting']['plugins']['available']) ? DISCUZ_ROOT.'./source/plugin/'.$efile[0].'/smsgw/'.$efile[1] : '';
		} else {
			$smsgwfile = DISCUZ_ROOT.'./source/class/smsgw/'.$efilename;
		}

		if($smsgwfile) {
			include($smsgwfile);
			$classname = 'smsgw_' . $smsgw['class'];
			if(class_exists($classname)) {
				$class = new $classname();
				$array = $type == self::DISCUZ_CLASS_SMS_TYPE_SECCHECK ? array('seccode' => $message) : array('message' => $message);
				$result = $class->send($uid, $type, $secmobicc, $secmobile, $array);
			} else {
				$result = self::DISCUZ_CLASS_SMS_ERROR_CTFGWCLS;
			}
		} else {
			$result = self::DISCUZ_CLASS_SMS_ERROR_CTFGWNME;
		}

		if($result < 0 && ($result == self::DISCUZ_CLASS_SMS_ERROR_CTFGWCLS || $result == self::DISCUZ_CLASS_SMS_ERROR_CTFGWNME)) {
			$data = array('available' => '0');
			C::t('common_smsgw')->update($smsgw['smsgwid'], $data);
		}

		self::writesmslog(0, $smsgw['smsgwid'], $result, $uid, $secmobicc, $secmobile, $time, $message);
		return $result;
	}

	protected static function writesmslog($type, $smsgw, $status, $uid, $secmobicc, $secmobile, $sendtime = null, $content = '') {
		$sendtime = $sendtime === null ? time() : $sendtime;
		$arr = array('type' => $type, 'smsgw' => $smsgw, 'status' => $status, 'uid' => $uid, 'secmobicc' => $secmobicc, 'secmobile' => $secmobile, 'sendtime' => $sendtime, 'content' => $content);
		return C::t('common_smslog')->insert($arr);
	}

}
?>