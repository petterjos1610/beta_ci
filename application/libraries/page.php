<?php
class Page {
	static $cms = "VIEW_CMS";
	static $cmd = array("VIEW_CMD","CREATE_CMD","EDIT_CMD");
	static $usr = array("VIEW_USRTYPE","CREATE_USRTYPE","EDIT_USRTYPE","VIEW_USR","CREATE_USR","EDIT_USR");
	static $prv = array("VIEW_PRIV","SET_PRIV");
	static $tkt = array("VIEW_TKTSUBJ","CREATE_TKTSUBJ","EDIT_TKTSUBJ","VIEW_TKT","OPEN_TKT","EDIT_TKT","CLOSE_TKT","SEND_TKTMSG","CONFIRM_TKT");
	static $srv = array("VIEW_SRVCPRO","CREATE_SRVCPRO","EDIT_SRVCPRO","CONFIRM_SRVCPRO","CREATE_STAFF");
	static $prg = array("VIEW_PROGS","CREATE_PROG","EDIT_PROG","CLR_PROG","UNCLR_PROG","CONFIRM_PROG","VIEW_FULLPROG");
	static $crs = array("VIEW_COURSE","CREATE_COURSE","EDIT_COURSE","CONFIRM_COURSE");
	static $slc = array("VIEW_SESSLOC","CREATE_SESSLOC","EDIT_SESSLOC");
	static $stp = array("VIEW_STUTYPE","CREATE_STUTYPE","EDIT_STUTYPE");
	static $itt = array("VIEW_INTVNTYPE","CREATE_INTVNTYPE","EDIT_INTVNTYPE");
	static $elt = array("VIEW_ELITYPE","CREATE_ELITYPE","EDIT_ELITYPE");
	static $eth = array("VIEW_ETHNI","CREATE_ETHNI","EDIT_ETHNI");
	static $sjt = array("VIEW_SUBJ","CREATE_SUBJ","EDIT_SUBJ");
	static $pit = array("VIEW_PHSTYPE","CREATE_PHSTYPE","EDIT_PHSTYPE");
	static $crr = array("VIEW_CRRTYPE","CREATE_CRRTYPE","EDIT_CRRTYPE");
	static $cbt = array("VIEW_CITY","CREATE_CITY","EDIT_CITY");
	static $ulg = array("VIEW_USRLOG");
	static $rel = array("VIEW_RELIGION","CREATE_RELIGION","EDIT_RELIGION");
	static $sch = array("VIEW_SCH","CREATE_SCH","EDIT_SCH");
	static $stf = array("VIEW_SCHSTAFF","CREATE_SCHSTAFF","EDIT_SCHSTAFF");
	static $stu = array("VIEW_STUD","CREATE_STUD","EDIT_STUD");
	static $enr = array("VIEW_ENROL","CREATE_ENROL","DELETE_ENROL");
	static $ass = array("CREATE_ASS","SELF_ASS");
	static $rat = array("CREATE_RATE","CONFIRM_RATE","CREATE_STURATE","VIEW_RATE");
	static $rep = array("VIEW_REPORT","VIEW_IMPREPORT","VIEW_INTHIST","VIEW_GRADES","VIEW_IMPANA","VIEW_BEHREP");
	static $mat = array("VIEW_MATCH","CREATE_MATCH","APPROVE_MATCH","VIEW_PROGMAT");
	static $spa = array("STEP_1","STEP_2");
	static $ads = array("VIEW_ADS","CREATE_AD","EDIT_AD","CONFIRM_AD","CLICK_AD");
	static $faq = array("PROG_HELP");
	
	private $title = "";
	
	public function __construct($title = "Edukit Management System") {
		$this->title = $title;
	}
}