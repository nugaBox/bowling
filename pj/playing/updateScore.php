<?php
//====================== INFO ===========================
// Program Name : updateScore.php
// Description :  플레이어의 프레임 점수, 총 점수 업데이트
// Path : /bowling/pj/playing/updateScore.php
//
//========================================================
    $s = new calcScore;

    // 프레임 점수 초기화
    for($i = 1; $i <= MAX_FRAME; $i++){
        ${"frame".$i} = null;
    }

    // 각 프레임별 점수 입력 (calcScore 클래스 -> rolls 배열 -> score 함수)
    $s->roll($row['ball_1_1']);
    if($row['ball_1_1'] != STRIKE_PIN) { $s->roll($row['ball_1_2']); }
    $frame1 = $s->score();

    $s->roll($row['ball_2_1']);
    if($row['ball_2_1'] != STRIKE_PIN) { $s->roll($row['ball_2_2']); }
    $frame2 = $s->score();

    $s->roll($row['ball_3_1']);
    if($row['ball_3_1'] != STRIKE_PIN) { $s->roll($row['ball_3_2']); }
    $frame3 = $s->score();

    $s->roll($row['ball_4_1']);
    if($row['ball_4_1'] != STRIKE_PIN) { $s->roll($row['ball_4_2']); }
    $frame4 = $s->score();

    $s->roll($row['ball_5_1']);
    if($row['ball_5_1'] != STRIKE_PIN) { $s->roll($row['ball_5_2']); }
    $frame5 = $s->score();

    $s->roll($row['ball_6_1']);
    if($row['ball_6_1'] != STRIKE_PIN) { $s->roll($row['ball_6_2']); }
    $frame6 = $s->score();

    $s->roll($row['ball_7_1']);
    if($row['ball_7_1'] != STRIKE_PIN) { $s->roll($row['ball_7_2']); }
    $frame7 = $s->score();

    $s->roll($row['ball_8_1']);
    if($row['ball_8_1'] != STRIKE_PIN) { $s->roll($row['ball_8_2']); }
    $frame8 = $s->score();

    $s->roll($row['ball_9_1']);
    if($row['ball_9_1'] != STRIKE_PIN) { $s->roll($row['ball_9_2']); }
    $frame9 = $s->score();

    $s->roll($row['ball_10_1']);
    $s->roll($row['ball_10_2']);
    $s->roll($row['ball_10_3']);
    $frame10 = $s->score();

    // 핸디캡 점수 합산하여 총 점수 도출
    $total = $frame10 + $row['hdp'];
    if($total > 300) {
        $total = 300;
    }

    // 게임 테이블 UPDATE (점수, 총 점수)
    $sqlUpdateScore = "update NGJANG_SAVEDGAME set score ='".$frame10."', total ='".$total."' where seq = '".$thisPlayerSeq."'";
    mysqli_query($dbConn, $sqlUpdateScore);
?>