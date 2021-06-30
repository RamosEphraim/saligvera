<?php 
date_default_timezone_set('Asia/Manila');
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
	switch ($_POST['action']) {
		case 'getAllProjectsByEAId':
		getAllProjectsByEAId();
		break;
		
		case 'getAllProjectImages':
		getAllProjectImages();
		break;

		case 'getAllSupplies':
		getAllSupplies();
		break;

		case 'getAllChecklistItems':
		getAllChecklistItems();
		break;



		case 'insertSupplyRequest':
		insertSupplyRequest();
		break;

		case 'modifyChecklistStatus':
			modifyChecklistStatus();
			break;

		default:
			# code...
		break;
	}
}

function modifyChecklistStatus() {
    include 'connect.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "saligver_construction";
    $db = new mysqli($servername,$username,$password,$dbname);

	$accountId = $_POST['account_id'];
	$pin_code = $_POST['pin_code'];
	$check_id = $_POST['check_id'];
	$stmt = $conn->prepare("SELECT * FROM `account_tbl` WHERE `account_id`=:account_id AND `pincode`=:pincode");
	$stmt->bindParam("account_id", $accountId);
	$stmt->bindParam("pincode", $pin_code);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC); 
	$count=$stmt->rowCount();
	$data=$stmt->fetch();
	if($count)
	{	
		$stmt = $conn->prepare("SELECT * FROM `checklist_tbl` WHERE `check_id`=:checkid");
		$stmt->bindParam("checkid", $check_id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC); 
		$checkData=$stmt->fetch();
		$project_id = $checkData['project_id'];
        $percentage = $checkData['percentage'];
        
        
        $q = $db->query("SELECT * FROM project_tbl WHERE project_id = '$project_id'");
        $row = $q->fetch_object();
        $project_progress = $row->project_progress;
		
		
		if($checkData["task_status"] == 1) {
			$currDate = date('Y-m-d');
			$stmt = $conn->prepare("UPDATE `checklist_tbl` SET `task_status`=0,`end`=:endDate WHERE `check_id`=:check_id");
			$stmt->bindParam("check_id", $check_id);
			$stmt->bindParam("endDate", $currDate);
			$stmt->execute();
            $db->query("UPDATE project_tbl SET project_progress = $project_progress + $percentage WHERE project_id = $project_id");

		} elseif($checkData["task_status"] == 0){
		   
			$zeroDate = "0000-00-00";
			$query = $db->query("UPDATE checklist_tbl SET task_status = 1, end = '0000-00-00'  WHERE check_id = $check_id");
            if($query) {
                $db->query("UPDATE project_tbl SET project_progress = $project_progress - $percentage WHERE project_id = $project_id");
            }
			
		}
		echo json_encode(array("success" => true , "message" => 'Task has been updated'));
	}
	else
	{
		echo json_encode(array("success" => false , "message" => "Pincode is incorrect!"));
	}
}

function insertSupplyRequest() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "saligver_construction";
    
    $project_id = $_POST['project_id'];
    $account_id = $_POST['account_id'];
    $supply_id = $_POST['supply_id'];
    $quantity = $_POST['quantity'];
    
    $db = new mysqli($servername,$username,$password,$dbname);
    $query = $db->query("INSERT INTO request_tbl (`project_id`,`account_id`,`supply_id`,`quantity`,`request_status`) VALUES ($project_id,$account_id,$supply_id,$quantity,1)");
    echo json_encode(array("success" => true , "message" => "Supply successfully requested"));

}

function getAllSupplies() {
     $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "saligver_construction";
	$response = array();
	
	$db = new mysqli($servername,$username,$password,$dbname);
	
	$sql = "SELECT * FROM supply_tbl WHERE `supply_status` = 1";
	$query = $db->query($sql);
	foreach($query as $row) {
		array_push($response, array(
			"supply_id" => utf8_encode($row['supply_id']),
			"item" => utf8_encode($row['item']),
			"unit" => utf8_encode($row['unit']),
			"supplier" => utf8_encode($row['description']),
			"stocks" => utf8_encode($row['stocks'])
		));
	}
	echo json_encode($response);


}


function getAllChecklistItems() {
	$accountId  = $_POST['account_id'];
	$project_id  = $_POST['project_id'];
	
	include 'connect.php';
	$response = array();
	$sql = "SELECT `check_id`,project_tbl.`project_id`,`task`, `percentage`,`task_status`,`start`,`end` FROM `checklist_tbl`
	INNER JOIN project_tbl 
	ON project_tbl.project_id = checklist_tbl.project_id
	WHERE (project_tbl.first_ea = :first 
	OR project_tbl.second_ea = :second 
	OR project_tbl.third_ea = :third)
	AND project_tbl.`project_id`=:project_id
	ORDER BY `task_status` ASC";
	$news = $conn->prepare($sql);
	$params = array(":first" => $accountId , ":second" => $accountId, ":third" => $accountId, ":project_id" => $project_id);
	$news->execute($params);
	while ($row = $news->fetch(PDO::FETCH_ASSOC)) {
		array_push($response, array(
			"check_id" => $row["check_id"],
			"project_id" => $row["project_id"],
			"task" => $row["task"],
			"percentage" => $row["percentage"],
			"task_status" => $row["task_status"],
			"start" => date_format(date_create($row["start"]) ,"M d, Y"),
			"end" => date_format(date_create($row["end"]),"M d, Y")
		));
	}
	echo json_encode($response);
}


function getAllProjectsByEAId() {
	$eaId = $_POST['account_id'];

	include 'connect.php';
	$response = array();
	$sql = "SELECT `project_id`,
	(SELECT CONCAT(`firstname`, ' ', `middlename`, ' ', `surname`) FROM account_tbl WHERE `account_id`=pr.`first_ea`) as `FirstEA`,
	(SELECT CONCAT(`firstname`, ' ', `middlename`, ' ', `surname`) FROM account_tbl WHERE `account_id`=pr.`second_ea`) as `SecondEA`,
	(SELECT CONCAT(`firstname`, ' ', `middlename`, ' ', `surname`) FROM account_tbl WHERE `account_id`=pr.`third_ea`) as `ThirdEA`,
	(SELECT `photo` FROM `photo_tbl` as pt WHERE pt.`project_id`=pr.`project_id` ORDER BY `photo_id` DESC LIMIT 1) as `Image`, 
	 `project_budget`, `project_name`, `project_startdate`, `project_enddate`,`project_status` FROM `project_tbl` as pr WHERE `project_status` = '0' AND `first_ea`=:first_ea OR `second_ea`=:second_ea OR `third_ea`=:third_ea";
	$news = $conn->prepare($sql);
	$params = array(':first_ea' => $eaId , ':second_ea' => $eaId, ':third_ea' => $eaId );
	$news->execute($params);
	while ($r = $news->fetch(PDO::FETCH_ASSOC)) {
		
		$sql = "SELECT SUM(`percentage`) as `taskpercent` FROM checklist_tbl as pt WHERE pt.`project_id` = :dpp AND pt.task_status=0";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":dpp", $r['project_id']);
		$stmt->execute();
		$data=$stmt->fetch();

		array_push($response, 
			array(	
				'project_id' => $r['project_id'],
				'budget'  => $r['project_budget'],
				'project_name'=> $r['project_name'], 
				'start_date' => $r['project_startdate'],
				'end_date' => $r['project_enddate'],
				'project_progress'=> $data['taskpercent'],
				'engineers_architects'=> "\n".$r['FirstEA']."\n".$r['SecondEA']."\n".$r['ThirdEA'],
				'project_image' => ($r['Image'] != "") ? "http://saligveraconstruction.com/assets/uploads/".$r['Image'] : "http://saligveraconstruction.com/mobileapp/images/noimg.jpg"
				//'project_image' => $r['Image']
			));
	}
	echo json_encode($response);
}

function getAllProjectImages() {
	$project_id = $_POST['project_id'];
	include 'connect.php';
	$response = array();
	$sql = "SELECT * FROM `photo_tbl` WHERE `project_id`=:projid ORDER BY `photo_id` DESC";
	$news = $conn->prepare($sql);
	$params = array(':projid' => $project_id);
	$news->execute($params);
	while ($r = $news->fetch(PDO::FETCH_ASSOC)) {
		array_push($response, 
			array(	
				'photo_id' => $r['photo_id'],
				'project_id'  => $r['project_id'],
				'photo'=> "http://saligveraconstruction.com/assets/uploads/".$r['photo'], 
				'date_uploaded' => date_format(date_create($r['date_uploaded']), 'g:ia \o\n l jS F Y')
			));
	}
	echo json_encode($response);
}

function addBookmark(){
	$response = array();
	include 'connect.php';
	$newsid = $_POST['newsid'];
	$userid = $_POST['userid'];
	$accounttype = $_POST['accounttype'];


	$stmt = $conn->prepare("SELECT * FROM `tblbookmarks` WHERE newsid=:newsid AND userid=:userid AND accounttype=:type");
	$stmt->bindParam("newsid", $newsid) ;
	$stmt->bindParam("userid", $userid) ;
	$stmt->bindParam("type", $accounttype);
	$stmt->execute();

	$stmt->setFetchMode(PDO::FETCH_ASSOC); 
	$count=$stmt->rowCount();
	$data=$stmt->fetch();

	if($count)
	{


	}else{
		$stmt = $conn->prepare("INSERT INTO `tblbookmarks`(`newsid`, `userid`, `accounttype`) VALUES (:newsid, :userid, :type)");
		$stmt->bindParam("newsid", $newsid) ;
		$stmt->bindParam("userid", $userid) ;
		$stmt->bindParam("type", $accounttype);
		$stmt->execute();

	}

	$code = "add_success";
	$message = "Bookmark Added!";
	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}

function removeBookmark(){
	$response = array();
	include 'connect.php';
	$newsid = $_POST['newsid'];
	$userid = $_POST['userid'];
	$accounttype = $_POST['accounttype'];

	$stmt = $conn->prepare("DELETE FROM `tblbookmarks` WHERE `newsid`=:newsid AND `userid`=:userid AND `accounttype`=:accounttype" );
	$stmt->bindParam("newsid", $newsid);
	$stmt->bindParam("userid", $userid);
	$stmt->bindParam("accounttype", $accounttype);
	$stmt->execute();
	
	$code = "remove_success";
	$message = "Bookmark Deleted!";
	array_push($response, array("code"=>$code, "message"=>$message));
	echo json_encode($response);
}
