<?php
//====================== INFO ===========================
// Program Name : listRanking.php
// Description :  스코어 랭킹 리스트
// Path : ./pj/list/listNoQuitGame.php
//
//========================================================

// DB 쿼리 : 스코어 1등만 불러오기
$sql = "SELECT S.score, S.hdp, S.total, S.playerName, M.seq FROM NGJANG_SAVEDGAME AS S LEFT OUTER JOIN NGJANG_MASTER AS M ON S.gseq=M.seq ORDER BY S.total DESC, S.hdp ASC, M.endDate DESC LIMIT 1";
$result = mysqli_query($dbConn, $sql);
$row = mysqli_fetch_array($result);

    // 출력할 내용
    $playerName = $row['playerName'];       // 1. 플레이어명
    $score = $row['score'];                                         // 2. 점수
    $hdp = $row['hdp'];                                             // 3. 핸디캡 점수
    $total = $row['total'];                                         // 4. 총 점수
    $gseq = $row['seq'];                                            // 5. 게임번호
    $url = "./play.php?gseq=".$gseq;                         // 6. 링크주소
    $perfect = "";                                                  // 7. 퍼펙트 게임 여부

    // 퍼펙트 게임 뱃지 (핸디캡 점수 제외하고 300점일 때)
    if($score == 300)
        $perfect = "<span class=\"badge badge-dark\" style='margin-left: 20px;'>Perfect</span>";

    // 출력할 리스트
    $listRanking = "<li class=\"blinking\" style='list-style: none; line-height: 1.8em;'> <span class=\"badge badge-primary\" style='margin-right: 10px;'>1등</span>
    <a href='".$url."' style='text-decoration: none;'><b>"."$total"."점 <span style='margin-left: 20px;'data-toggle=\"tooltip\" data-placement=\"right\" data-original-title=\"GameNo.".$gseq."\">".$playerName." 님</b></span></a>".$perfect."</li>";


// DB 쿼리 : 스코어 1~5등 불러오고 1등 제외
$sql = "SELECT S.score, S.hdp, S.total, S.playerName, M.seq FROM NGJANG_SAVEDGAME AS S LEFT OUTER JOIN NGJANG_MASTER AS M ON S.gseq=M.seq ORDER BY S.total DESC, S.hdp ASC, M.endDate DESC LIMIT 5";
$result = mysqli_query($dbConn, $sql);
$row = mysqli_fetch_array($result);
unset($row[0]);            // 1등은 목록에서 제외
$rank = 2;                 // 랭킹은 2등부터 시작

    // 출력할 내용
    while ($row = mysqli_fetch_array($result)) {
        $playerName = $row['playerName'];       // 1. 플레이어명
        $score = $row['score'];                                         // 2. 점수
        $hdp = $row['hdp'];                                             // 3. 핸디캡 점수
        $total = $row['total'];                                         // 4. 총 점수
        $gseq = $row['seq'];                                            // 5. 게임번호
        $url = "./play.php?gseq=".$gseq;                         // 6. 링크주소
        $perfect = "";                                                  // 7. 퍼펙트 게임 여부

        // 퍼펙트 게임 뱃지 (핸디캡 점수 제외하고 300점일 때)
        if($score == 300)
            $perfect = "<span class=\"badge badge-dark\" style='margin-left: 20px;'>Perfect</span>";

        // 출력할 리스트
        $listRanking = $listRanking."<li style='list-style: none; line-height: 1.8em;'><span class=\"badge badge-secondary\" style='margin-right: 10px;'>".$rank."등</span>
        <a href='".$url."' style ='color: gray; text-decoration: none;'>"."$total"."점 <span style='margin-left: 20px;'data-toggle=\"tooltip\" data-placement=\"right\" data-original-title=\"GameNo.".$gseq."\">".$playerName." 님</a>".$perfect."<br></li>";

        $rank++;
    }