<?php
//====================== INFO ===========================
// Program Name : result.php
// Description :  게임 시작 및 진행 시 버튼 클릭 처리하고 전송
// Path : ./pj/result.php
//
//========================================================

    require_once "./dbConnect.php";         // DB 연결
    require_once "./score/calcScore.php";   // 점수 계산 프로그램

    // 게임 전체 공통 : 게임 시작 시 content.php에서 POST로 넘어온 값
    $status = $_POST['status'];			    // 버튼 클릭 시 확인할 상태
    $cnt = $_POST['cnt']; 				    // 플레이어 수
    $playerName = $_POST['playerName'];     // 플레이어명 (배열)
    $hdp = $_POST['hdp']; 				    // 핸디캡점수 (배열)

    const MAX_FRAME = 10;                   // 최대 프레임 번호
    const MAX_PIN = 10;                     // 최대 핀 점수
    const END_GAME = 11;                    // 게임 종료시 프레임 번호 설정
    const STRIKE_PIN = 10;                  // 스트라이크 핀 점수
    const SPARE_PIN = 10;                   // 스페어 핀 점수


// ================= S : 게임 시작 버튼 클릭 ===========================

    if ($status == 's') {

        // 핀 상태 초기화
        $setPinStatus = "1_1_1";

        // 직전 게임 번호 불러오기
        $sql = "SELECT MAX(gseq) as gseq FROM NGJANG_SAVEDGAME";
        $result = mysqli_query($dbConn, $sql);
        $row = mysqli_fetch_array($result);
        $gseq = $row['gseq'] + 1;

        if(!$result){
            echo $sql;
            return 0;
        }
        // 게임 테이블 INSERT (게임번호, 플레이어명, 핸디캡점수, 스코어, 총 점수 초기화)
        for($i = 0; $i < $cnt; $i++){

            // 빈 플레이어명 자동 입력
            if($playerName[$i] == null){
                $playerName[$i] = "플레이어".($i+1);
            }
            $playerNameKr[$i] = $playerName[$i]; // 한글 플레이어명 인코딩
            if ($hdp[$i] == ''){
                $hdp[$i] = 0;
            }
            $sql = "INSERT INTO NGJANG_SAVEDGAME(gseq, playerName, hdp, score, total)
                    VALUES('$gseq','$playerNameKr[$i]','$hdp[$i]','0','0')";
            $result = mysqli_query($dbConn, $sql);
            if(!$result){
                echo $sql;
                return 0;
            }
        }

        // 마스터 테이블 INSERT (게임번호, 플레이어숫자, 대표 플레이어명, 시작일시, 최종일시, 게임상태, 핀 상태 초기화)
        $firstPlayer = $playerName[0];  // 한글 플레이어명 인코딩
        $sql = "INSERT INTO NGJANG_MASTER(seq, userNumber, firstPlayer, startDate, endDate, gameStatus, pinstatus)
                VALUES('$gseq','$cnt','$firstPlayer',NOW(),NOW(),'N','$setPinStatus')";
        $result = mysqli_query($dbConn, $sql);

        if(!$result){
            echo $sql;
            return 0;
        }

        // DB 입력 완료 후 페이지 이동 (GET 게임번호)
        $url = "../play.php?gseq=".$gseq;
        echo "<script> document.location.href='$url';</script>";
    }

// ================= C : 점수 추가 버튼 클릭 ===========================
    else if ($status == 'c') {

        // playing.php에서 POST로 넘어온 값
        $gseq = $_POST['gseq'];             // 게임번호
        $point = $_POST['point'];           // 점수 버튼 값
        $startSeq = $_POST['startSeq'];     // 시작 플레이어 번호
        $endSeq = $_POST['endSeq'];         // 마지막 플레이어 번호
        $pinstatus = $_POST['pinstatus'];   // 핀 상태

        // 변수 설정
        $userNum = $endSeq - $startSeq + 1;                     // 플레이어 수 (마지막 번호 - 첫 번호 + 1)
        list($pNum, $fNum, $bNum) = explode("_", $pinstatus);   // 핀 상태 분리 (플레이어 번호, 프레임 번호, 볼 번호)
        $s = new calcScore();

        // 이전 볼 점수 구하기
        $beforestatus = "ball_".$fNum."_".($bNum - 1);          // 이전 볼의 핀 상태
        $recentPlayer = $startSeq + $pNum - 1;                  // 이전 플레이어 번호
        $sql = "select ".$beforestatus." from NGJANG_SAVEDGAME where seq = '".$recentPlayer."'";
        $result = mysqli_query($dbConn, $sql);
        $row = mysqli_fetch_array($result);
        $beforeScore = $row[$beforestatus];                     // 이전 볼 점수 (ballNum - 1)

        // 게임번호가 비어있을 때 : 중지
        if ($gseq == '') {
            echo "경고";
            exit;
        }

        // 게임번호가 있을 때 : 게임 진행
        else {
            // 변수 설정
            $pinstatusrow = $pNum."_".$fNum."_".$bNum;  // 핀 상태 문구
            $framerow = "frame_".$fNum;                 // 프레임 번호 문구
            $ballrow = "ball_".$fNum."_".$bNum;         // 볼 번호 문구
            $playerNum = $startSeq + $pNum - 1;         // 현재 플레이어 번호

            // 게임 테이블 UPDATE (핀 점수)
            $sql = "update NGJANG_SAVEDGAME set ".$ballrow."='".$point."' where seq = '".$playerNum."'";
            $result = mysqli_query($dbConn, $sql);

            /* 핀 상태 설정 */

            // 1구일 때
            if($bNum == 1) {
                // 스트라이크 일 때
                if($point == STRIKE_PIN) {
                    // 10프레임 : 볼 번호만
                    if ($fNum == MAX_FRAME)
                        $bNum++;
                    // 1~9프레임
                    else {
                        // 마지막 플레이어일 때 : 프레임 번호만
                        if ($pNum == $userNum) {
                            $pNum = 1;
                            $fNum++;
                            $bNum = 1;
                        } // 마지막 플레이어 아닐 때 : 플레이어 번호만
                        else
                            $pNum++;
                    }
                }
                // 스트라이크 아닐 때 : 2구로
                else
                    $bNum++;
            }

            // 2구일 때
            else {
                // 10프레임 2구
                if($fNum == 10 && $bNum == 2){
                    // '1구의 스페어 처리' 또는 '1구가 스트라이크'
                   if($beforeScore + $point == 10 || $beforeScore == 10) {
                       $bNum++;
                   }
                   // 1구가 스트라이크도 아니고, 스페어 처리도 못함 : 게임 종료
                   else {
                       // 마지막 플레이어일 때 : 게임 종료
                       if ($pNum == $userNum) {
                           $fNum++;
                       }
                       // 마지막 플레이어 아닐 때
                       else {
                           $pNum++;
                           $bNum = 1;
                       }
                   }
                }
                // 10프레임 3구
                else if($fNum == 10 && $bNum == 3) {
                    // 마지막 플레이어일 때 : 게임 종료
                    if ($pNum == $userNum) {
                        $fNum++;
                    }
                    // 마지막 플레이어 아닐 때
                    else {
                        $pNum++;
                        $bNum = 1;
                    }
                }
                // 1~9 프레임
                else {
                    if($beforeScore + $point <= 10) {
                        // 마지막 플레이어일 때
                        if ($pNum == $userNum) {
                            $pNum = 1;
                            $fNum++;
                            $bNum = 1;
                        }
                        // 마지막 플레이어 아닐 때
                        else {
                            $pNum++;
                            $bNum = 1;
                        }
                    }
                    else {
                        echo "2구의 범위가 아닙니다";
                        exit;
                    }
                }
            }

            // 마스터 테이블 UPDATE (핀 상태, 최종일시)
            $pinstatusrow = $pNum."_".$fNum."_".$bNum;
            $sql = "update NGJANG_MASTER set pinstatus ='".$pinstatusrow."', endDate = NOW() where seq = '".$gseq."'";
            $result = mysqli_query($dbConn, $sql);
        }

        // DB 입력까지 완료 후 페이지 이동 (GET 게임번호)
        $url = "/play.php?gseq=".$gseq;
        echo "<script> document.location.href='$url';</script>";
    }

// ================= R : 다시 시작 버튼 클릭 ===========================
    else if ($status == 'r') {

        // playing.php에서 POST로 넘어온 값
        $gseq = $_POST['gseq'];                  // 게임번호

        // 게임 테이블 UPDATE (핀 점수 Null로)
        for ($i = 1; $i <= MAX_FRAME; $i++) {   // 프레임 번호
            for ($j = 1; $j <= 3; $j++) {       // 볼 번호
                $ballrow = 'ball_'.$i.'_'.$j;
                $sql = "update NGJANG_SAVEDGAME set ".$ballrow." = null where gseq = '".$gseq."'";
                mysqli_query($dbConn, $sql);
            }
        }

        // 마스터 테이블 UPDATE (핀 상태, 최종일시)
        $sql = "update NGJANG_MASTER set pinstatus = '1_1_1', endDate = NOW() where seq = '".$gseq."'";
        mysqli_query($dbConn, $sql);
    }

// ============ G : 자동 게임 (퍼펙트, 올스페어) 버튼 클릭 ===================
    else if ($status == 'g') {

        // playing.php에서 POST로 넘어온 값
        $gseq = $_POST['gseq'];                 // 게임번호
        $point = $_POST['point'];               // 점수 버튼 값 (퍼펙트 게임 : 10 / 올 스페어 : 5)
        $startSeq = $_POST['startSeq'];         // 첫번째 플레이어 번호
        $endSeq = $_POST['endSeq'];             // 마지막 플레이어 번호

        for ($fNum = 1; $fNum <= MAX_FRAME; $fNum++) {
            // 1~9프레임
            if($fNum < MAX_FRAME) {
                // 퍼펙트 게임 : 핀 점수 모두 10점
                if ($point == 10) {
                    for ($bNum = 1; $bNum <= 2; $bNum++) {
                        $ballrow = 'ball_' . $fNum . '_'.$bNum;
                        // 게임 테이블 UPDATE (핀 점수)
                       if ($bNum == 1)
                            $sql = "update NGJANG_SAVEDGAME set " . $ballrow . " = " . $point . " where gseq = '" . $gseq . "'";
                       else
                            $sql = "update NGJANG_SAVEDGAME set " . $ballrow . " = null where gseq = '" . $gseq . "'";
                        mysqli_query($dbConn, $sql);
                    }
                }
                // 올스페어 게임 : 핀 점수 모두 5점
                else if ($point == 5) {
                    for ($bNum = 1; $bNum <= 2; $bNum++) {
                        $ballrow = 'ball_' . $fNum . '_' . $bNum;
                        // 게임 테이블 UPDATE (핀 점수)
                        $sql = "update NGJANG_SAVEDGAME set " . $ballrow . " = " . $point . " where gseq = '" . $gseq . "'";
                        mysqli_query($dbConn, $sql);
                    }
                }
            }
            // 10프레임
            else if($fNum == MAX_FRAME){
                // 게임 테이블 UPDATE (핀 점수)
                for($bNum = 1; $bNum <= 3; $bNum++) {
                    $ballrow = 'ball_' . $fNum . '_' . $bNum;
                    $sql = "update NGJANG_SAVEDGAME set " . $ballrow . " = " . $point . " where gseq = '" . $gseq . "'";
                    mysqli_query($dbConn, $sql);
                }
            }
        }
        // 마스터 테이블 UPDATE (핀 상태, 최종일시)
        $userNum = $endSeq - $startSeq + 1;
        $sql = "update NGJANG_MASTER set pinstatus = '".$userNum."_".END_GAME."_3', endDate = NOW() where seq = '".$gseq."'";
        mysqli_query($dbConn, $sql);
    }

// ================= M : 랜덤 게임 버튼 클릭 ===========================
    else if ($status == 'm') {

        // playing.php에서 POST로 넘어온 값
        $gseq = $_POST['gseq'];                 // 게임번호
        $startSeq = $_POST['startSeq'];         // 첫번째 플레이어 번호
        $endSeq = $_POST['endSeq'];             // 마지막 플레이어 번호

        $userNum = $endSeq - $startSeq + 1;     // 플레이어 인원

        for ($i = 0; $i < $userNum; $i++) {
            $recentUser = $startSeq + $i;       // 현재 플레이어

            // 1~9프레임
            for ($fNum = 1; $fNum < MAX_FRAME; $fNum++) {
                $ball1row = 'ball_' . $fNum . '_1';    // 해당 프레임 1구 컬럼명
                $ball2row = 'ball_' . $fNum . '_2';    // 해당 프레임 2구 컬럼명
                $firstRandom = mt_rand(0, MAX_PIN);    // 1구 랜덤 값

                // 스트라이크일 때 : 1구 - 랜덤 값, 2구 - NULL
                if ($firstRandom == STRIKE_PIN) {
                    $sql = "update NGJANG_SAVEDGAME set " . $ball1row . " = " . $firstRandom . ", " . $ball2row . " = null where seq = '" . $recentUser ."'";
                    mysqli_query($dbConn, $sql);
                }
                // 스트라이크 아닐 때 : 1구 - 랜덤 값, 2구 - 랜덤 값
                else {
                    $secondRandom = mt_rand(0, MAX_PIN - $firstRandom); // 2구 랜덤 값 : 1구 고려하여 최대값 지정
                    $sql = "update NGJANG_SAVEDGAME set " . $ball1row . " = " . $firstRandom . ", " . $ball2row . " = " . $secondRandom . " where seq = '" . $recentUser ."'";
                    mysqli_query($dbConn, $sql);
                }
            }

            // 10프레임
            $fNum = MAX_FRAME;
            for ($bNum = 1; $bNum <= 3; $bNum++){
                // 1구 - 랜덤 값
                $firstRandom = mt_rand(0, MAX_PIN);
                $sql = "update NGJANG_SAVEDGAME set ball_10_1 = " . $firstRandom . " where seq = '" . $recentUser ."'";
                mysqli_query($dbConn, $sql);

                // 1구 스트라이크일 때
                if($firstRandom == STRIKE_PIN) {
                    // 2구 - 랜덤 값
                    $secondRandom = mt_rand(0, MAX_PIN);
                    $sql = "update NGJANG_SAVEDGAME set ball_10_2 = " . $secondRandom . " where seq = '" . $recentUser ."'";
                    mysqli_query($dbConn, $sql);

                        // 2구 스트라이크일 때 - 3구 랜덤 값 후 게임 종료
                        if($secondRandom == STRIKE_PIN)
                            $thirdRandom = mt_rand(0, MAX_PIN);
                        // 2구 스트라이크 아닐 때 : 2구 랜덤 값 고려하여 3구 랜덤 값 후 게임 종료
                        else
                            $thirdRandom = mt_rand(0, MAX_PIN - $secondRandom);
                    $sql = "update NGJANG_SAVEDGAME set ball_10_3 = " . $thirdRandom . " where seq = '" . $recentUser ."'";
                    mysqli_query($dbConn, $sql);
                }

                // 1구 스트라이크 아닐 때
                else {
                    // 1구 고려하여 2구 랜덤 값
                    $secondRandom = mt_rand(0, MAX_PIN - $firstRandom);
                    $sql = "update NGJANG_SAVEDGAME set ball_10_2 = " . $secondRandom . " where seq = '" . $recentUser ."'";
                    mysqli_query($dbConn, $sql);

                    // 2구 스페어 처리 - 3구 랜덤 값 후 게임 종료
                    if($firstRandom + $secondRandom == SPARE_PIN) {
                        $thirdRandom = mt_rand(0, MAX_PIN);
                        $sql = "update NGJANG_SAVEDGAME set ball_10_3 = " . $thirdRandom . " where seq = '" . $recentUser ."'";
                        mysqli_query($dbConn, $sql);
                    }
                    // 2구 스페어 아닐 때 - 3구 Null 후 게임 종료
                    else{
                        $sql = "update NGJANG_SAVEDGAME set ball_10_3 = null where seq = '" . $recentUser ."'";
                        mysqli_query($dbConn, $sql);
                    }
                }
            }
        }

        // 마스터 테이블 UPDATE (핀 상태, 최종일시)
        $sql = "update NGJANG_MASTER set pinstatus = '".$userNum."_".END_GAME."_3', endDate = NOW() where seq = '".$gseq."'";
        mysqli_query($dbConn, $sql);
    }

// ================= D : 지우기 버튼 클릭 ===========================
    else if ($status == 'd') {

        // playing.php에서 POST로 넘어온 값
        $gseq = $_POST['gseq'];                 // 게임번호
        $startSeq = $_POST['startSeq'];         // 첫번째 플레이어 번호
        $endSeq = $_POST['endSeq'];             // 마지막 플레이어 번호
        $pinstatus = $_POST['pinstatus'];       // 핀 상태

        // $pNum : 현재 플레이어 순서, $fNum : 프레임 번호, $bNum : 볼 번호
        list($pNum, $fNum, $bNum) = explode("_", $pinstatus);
        $userNum = $endSeq - $startSeq + 1;     // 플레이어 인원 (마지막 플레이어 순서도 됨)
        $playerNum = $startSeq + $pNum - 1;     // 현재 플레이어 번호

        $recentBall = 'ball_'.$fNum.'_'.$bNum;  // 현재 볼 컬럼명

        // 게임 시작 시 실행 안함
        if($pNum == 1 && $fNum == 1 && $bNum == 1){
            exit;
        }

        // 게임 진행 시 : 핀 상태와 볼 컬럼명을 상황에 맞게 설정
        else if($fNum != END_GAME) {

            // 1구 : 이전 플레이어로 돌아가야 함
            if ($bNum == 1) {

                // 1번 플레이어 : 앞 프레임 마지막 플레이어로
                if($pNum == 1) {
                    $fNum--;
                    $pNum = $userNum;
                    $beforeThrowFirstBallrow = 'ball_'.$fNum.'_1';  // 앞 프레임 1구

                    if($fNum != MAX_FRAME) {
                    // 마지막 플레이어의 앞 프레임 1구 불러오기
                    $sql = "select ".$beforeThrowFirstBallrow." from NGJANG_SAVEDGAME where seq = '" . $endSeq."'";
                    mysqli_query($dbConn, $sql);
                    $result = mysqli_query($dbConn, $sql);
                    $row = mysqli_fetch_array($result);
                    $beforeThrowFirstBall = $row[$beforeThrowFirstBallrow];

                    // 앞 프레임 1구가 스트라이크 일때 : 1구로 가야함
                    if($beforeThrowFirstBall == STRIKE_PIN)
                        $bNum = 1;
                    // 앞 프레임 1구가 스트라이크 아닐 때 : 2구로 가야함
                    else
                        $bNum = 2;
                    }
                }
                // 1번 플레이어 아닐때 : 현재 프레임 이전 플레이어로
                else {
                    $pNum--;
                    $beforeThrowFirstBallrow = 'ball_' . $fNum . '_1';  // 앞 프레임 1구
                    $beforePlayerNum = $playerNum - 1;              // 이전 플레이어

                    if ($fNum != MAX_FRAME) {
                        // 이전 플레이어의 앞 프레임 1구 불러오기
                        $sql = "select " . $beforeThrowFirstBallrow . " from NGJANG_SAVEDGAME where seq = '" . $beforePlayerNum . "'";
                        mysqli_query($dbConn, $sql);
                        $result = mysqli_query($dbConn, $sql);
                        $row = mysqli_fetch_array($result);
                        $beforeThrowFirstBall = $row[$beforeThrowFirstBallrow];

                        // 앞 프레임 1구가 스트라이크 일때 : 1구로 가야함
                        if ($beforeThrowFirstBall == STRIKE_PIN)
                            $bNum = 1;
                        // 앞 프레임 1구가 스트라이크 아닐 때 : 2구로 가야함
                        else
                            $bNum = 2;
                    }
                    else if($fNum == MAX_FRAME) {
                        // 이전 플레이어의 10프레임 3구 불러오기
                        $sql = "select ball_10_3 from NGJANG_SAVEDGAME where seq = '" . $beforePlayerNum ."'";
                        mysqli_query($dbConn, $sql);
                        $result = mysqli_query($dbConn, $sql);
                        $row = mysqli_fetch_array($result);

                        // 이전 플레이어의 10프레임 3구가 NULL일 때 : 2구로 가야 함
                        if($row['ball_10_3'] == NULL)
                            $bNum = 2;
                        // 이전 플레이어의 10프레임 3구가 NULL 아닐 때 : 3구로 가야 함
                        else
                            $bNum = 3;
                    }
                }
            }
            // 현재가 2 또는 3구일 때
            else {
                $bNum--;
            }
        }

        // 게임 종료 시 : 마지막 플레이어의 마지막 구를 지운다.
        else if ($fNum == END_GAME){
            $fNum = MAX_FRAME;
        }

        // 설정 완료 시
            $playerNum = $startSeq + $pNum - 1;          // 수정할 플레이어 번호
            $ballrow = 'ball_'.$fNum.'_'.$bNum;          // 수정할 볼 컬럼명
            $pinstatusrow = $pNum."_".$fNum."_".$bNum;   // 수정할 핀 상태

            // 게임 테이블 UPDATE (볼 점수 Null 값)
            $sql = "update NGJANG_SAVEDGAME set " . $ballrow . " = null where seq = '" . $playerNum ."'";
            echo "<script>console.log(".$sql.")</script>";
            mysqli_query($dbConn, $sql);

            // 마스터 테이블 UPDATE (핀 상태, 게임상태, 최종일시)
            $sql2 = "update NGJANG_MASTER set pinstatus = '".$pinstatusrow."', gameStatus = 'N', endDate = NOW() where seq = '".$gseq."'";
            mysqli_query($dbConn, $sql2);
    }
    else
?>
