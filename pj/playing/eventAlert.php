<?php
//====================== INFO ===========================
// Program Name : eventAlert.php
// Description :  스트라이크, 스페어 등 이벤트 알림 표시
// Path : /bowling/pj/playing/eventAlert.php
//
//========================================================

    $beforeFirstPin = $row['ball_'.($fNum-1).'_1'];     // 이전 프레임 1구
    $beforeSecondPin = $row['ball_'.($fNum-1).'_2'];    // 이전 프레임 2구
    $thisFirstPin = $row['ball_'.$fNum.'_1'];           // 현재 프레임 1구
    $thisSecondPin = $row['ball_'.$fNum.'_2'];          // 현재 프레임 2구

    // 플레이어 1명일 때
    if($userNumber == 1 && $fNum != END_GAME && $bNum == 1) {
        // 스트라이크
        if ($beforeFirstPin == STRIKE_PIN )
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 스트라이크!</b></span>\";</script>";
        // 스페어
        else if($beforeFirstPin != STRIKE_PIN && $beforeFirstPin + $beforeSecondPin == SPARE_PIN)
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span style='color:gray;'><b> 🎉 스페어!</b></span>\";</script>";
    }
    // 플레이어 1명 이상일 때
    else if($userNumber != 1 && $fNum != END_GAME) {
        // 이전 프레임 표시
        // 현재 플레이어 턴일 때 : 1구에서만 표시
        if($pNum == $recent && $bNum == 1){
            // 스트라이크
            if($beforeFirstPin == STRIKE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 스트라이크!</b></span>\";</script>";
            // 스페어
            else if($beforeFirstPin != STRIKE_PIN && $beforeFirstPin + $beforeSecondPin == SPARE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span style='color:gray;'><b> 🎉 스페어!</b></span>\";</script>";
        }
        // 현재 플레이어 턴 아닐 때 : 계속 표시
        else if ($pNum != $thisPlayerNum) {
            // 스트라이크
            if($beforeFirstPin == STRIKE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 스트라이크!</b></span>\";</script>";
            // 스페어
            else if($beforeFirstPin != STRIKE_PIN && $beforeFirstPin + $beforeSecondPin == SPARE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span style='color:gray;'><b> 🎉 스페어!</b></span>\";</script>";
        }

        // 이번 프레임 표시
        // 현재 플레이어 턴일 때 : 내용 없음
        if ($pNum == $thisPlayerNum) {
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"\";</script>";
        }
        // 현재 플레이어 턴 아닐 때 : 계속 표시
        else if($pNum != $thisPlayerNum) {
            // 스트라이크
            if($thisFirstPin == STRIKE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 스트라이크!</b></span>\";</script>";
            // 스페어
            else if($thisFirstPin != STRIKE_PIN && $thisFirstPin + $thisSecondPin == SPARE_PIN)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span style='color:gray;'><b> 🎉 스페어!</b></span>\";</script>";
            // 이외
            else
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"\";</script>";
        }
    }

    // 10프레임
    if($fNum == MAX_FRAME) {
        // 스트라이크
        if ($row['ball_10_1'] == STRIKE_PIN || $row['ball_10_2'] == STRIKE_PIN || $row['ball_10_3'] == STRIKE_PIN)
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 보너스 프레임 스트라이크! 한 번 더!!</b></span>\";</script>";
        // 1구 스트라이크 이후 2구 스트라이크 아닐 때
        if ($row['ball_10_1'] == STRIKE_PIN && $row['ball_10_2'] != STRIKE_PIN && $bNum == 3)
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"\";</script>";
        // 2구 스페어 처리
        else if ($row['ball_10_1'] != STRIKE_PIN && $row['ball_10_1'] + $row['ball_10_2'] == SPARE_PIN && $bNum == 3)
            echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span class='blinkEle' style='color:gray;'><b> 🎉 보너스 프레임 스페어! 한 번 더!!</b></span>\";</script>";
        // 경기 종료 여부
        if ($pNum != $thisPlayerNum) {
            if($pNum < $thisPlayerNum)
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"\";</script>";
            else
                echo "<script>document.getElementById(\"player" . $thisPlayerNum . "Alert\").innerHTML = \"<span style='color: gray;'><i class='fas fa-pause' style='padding-right: 10px;'></i><b>잠시 대기하세요</b></span>\";</script>";
        }
    }

    // 경기 종료 후
    if($fNum == END_GAME) {
        if( $row['score'] >= 250)
            echo "<script>document.getElementById(\"player".$thisPlayerNum."Alert\").innerHTML = \"<span class='blinkEle' style='color: #bd4346;'><b>🏆 명예의 전당으로!</b></span>\";</script>";
        else if ($row['score'] > 190 && $row['score'] < 250)
            echo "<script>document.getElementById(\"player".$thisPlayerNum."Alert\").innerHTML = \"<span style='color: #bd4346;'><b>🥇 프로급 실력이세요!</b></span>\";</script>";
        else if ($row['score'] < 100)
            echo "<script>document.getElementById(\"player".$thisPlayerNum."Alert\").innerHTML = \"<span style='color: gray;'><b>Game Over</b></span>\";</script>";
        else
            echo "<script>document.getElementById(\"player".$thisPlayerNum."Alert\").innerHTML = \"<span style='color: #17a2b8;'><b>🥈 실력을 좀 더 쌓으면 프로!</b></span>\";</script>";
    }
?>