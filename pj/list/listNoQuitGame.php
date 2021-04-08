<?php
//====================== INFO ===========================
// Program Name : listNoQuitGame.php
// Description :  진행 중인 게임 리스트
// Path : /bowling/pj/list/listNoQuitGame.php
//
//========================================================

// DB 쿼리 : 진행 중인 게임 불러오기
$sql = "SELECT * FROM NGJANG_MASTER WHERE gameStatus LIKE '%N%' ORDER BY endDate DESC ";
$result = mysqli_query($dbConn, $sql);
$noQuitGameNum = mysqli_num_rows($result);     // 리스트 행 개수
$listNoQuitGame = '';                         // 출력할 리스트 담는 변수

// 출력할 내용
while ($row = mysqli_fetch_array($result)) {
    $date = date("y-m-d", strtotime($row['endDate']));           // 1. 최종날짜
    $playerName = $row['firstPlayer'];  // 2. 대표 플레이어명
    $gseq = $row['seq'];                                          // 3. 게임번호
    $userNumber = $row['userNumber'] - 1;                         // 4. 총 플레이어 숫자
    $url = "./play.php?gseq=" . $gseq;                     // 5. 링크주소

    // 2명 이상일 때
    if ($userNumber > 0)
        $user = " <span style='font-size: 80%'>외 " . $userNumber . "명";
    // 1명 일 때
    else
        $user = " ";

    // 출력할 리스트
    $listNoQuitGame = $listNoQuitGame . "<li style='list-style: none; line-height: 1.8em;'><span class=\"badge badge-light\">
       " . $date . "</span>&nbsp;&nbsp;<a href='" . $url . "' style ='color: #343a40; text-decoration: none;'>&nbsp;&nbsp;<span style='font-size:12pt' data-toggle=\"tooltip\" data-placement=\"right\" data-original-title=\"GameNo.".$gseq."\"><b>" . $playerName ."</b> 님</span> ". $user . "</a></li>";
}
?>
