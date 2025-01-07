<?php
// ====================== INFO ==========================
// Program Name : printTable.php
// Description :  스코어보드 점수 테이블
// Path : /bowling/pj/playing/printTable.php
//
// ======================================================
?>

<table class="table-score" border="1" width="100%">
    <tbody>
    <!-- ============== 1번째 행 : 프레임 번호  ============== -->
    <tr>
        <?php for($i = 1; $i < MAX_FRAME; $i++) { ?>
            <th colspan="2"><?= $i ?></th>
        <?php } ?>
        <th colspan="3">10</th>
        <th colspan="2">HDP</th>
    </tr>

    <!--  ==============  2번째 행 : 핀 점수   ============== -->
    <tr>
        <?php

        /* 테이블 각 칸에 부여하는 ID에 사용하는 변수 */
        $tablePinNum = 0;           // 테이블 핀 순서 (1~21번)
        $tableFrameNum = 0;         // 테이블 프레임 번호
        $tablePinNum = 0;           // 테이블 볼 번호

        for ($tablePinNum = 1; $tablePinNum < 22; $tablePinNum++) {

            // 홀수번째 핀의 프레임, 볼 번호 설정
            if ($tablePinNum % 2 == 1) {
                $tableFrameNum = intval($tablePinNum / 2) + 1;
                $tableBallNum = $tablePinNum % 2;
            } // 짝수번째 핀의 프레임, 볼 번호 설정
            else {
                $tableFrameNum = intval($tablePinNum / 2);
                $tableBallNum = $tablePinNum % 2 + 2;
            }

            // 각 칸에 ID 부여 및 핀에 따라 클래스 설정
            if ($tablePinNum != 21) {
                // 스트라이크인 칸
                if ($tableBallNum == 1 && $row['ball_' . $tableFrameNum . '_' . $tableBallNum] == STRIKE_PIN)
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'strike'></td>";
                // 10프레임 스트라이크인 칸
                else if ($tableFrameNum == 10 && $row['ball_' . $tableFrameNum . '_' . $tableBallNum] == STRIKE_PIN)
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'strike'></td>";
                // 1~9프레임 스페어인 칸
                else if ($row['ball_' . $tableFrameNum . '_1'] != STRIKE_PIN && $tableBallNum == 2 && $row['ball_' . $tableFrameNum . '_1'] + $row['ball_' . $tableFrameNum . '_2'] == SPARE_PIN)
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'spare'></td>";
                // 점수가 0인 칸
                else if ($row['ball_' . $tableFrameNum . '_1'] != STRIKE_PIN && $row['ball_' . $tableFrameNum . '_' . $tableBallNum] == '0')
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'reset'>-</td>";
                // 점수가 Null 값인 칸 (아직 입력 안 되었거나 || 스트라이크로 인해 2구 Null)
                else if ($row['ball_' . $tableFrameNum . '_' . $tableBallNum] == NULL)
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'reset'></td>";
                // 이외에 점수 입력된 칸 (1~9점)
                else
                    echo "<td id = 'p" . $thisPlayerNum . "b" . $tableFrameNum . '_' . $tableBallNum . "' class = 'reset'>" . $row['ball_' . $tableFrameNum . '_' . $tableBallNum] . "</td>";
            }

            // 10프레임 3구 (마지막 21번째 칸)
            else {
                // 스트라이크
                if ($row['ball_10_3'] == STRIKE_PIN)
                    echo "<td id = 'p".$thisPlayerNum."b10_3' class = 'strike'></td>";
                // 3구에 2구의 스페어 처리
                else if($row['ball_10_2'] != 10 && $row['ball_10_1'] + $row['ball_10_2'] != 10 && $row['ball_10_2']+$row['ball_10_3'] == 10)
                    echo "<td id = 'p".$thisPlayerNum."b10_3' class = 'spare'></td>";
                // 3구 점수가 0일 때
                else if($row['ball_10_1']+$row['ball_10_2'] > 10 && $row['ball_10_3'] == '0')
                    echo "<td id = 'p".$thisPlayerNum."b10_3' class = 'reset'>-</td>";
                // 3구 기회 없을 때
                else if($row['ball_10_3'] == NULL)
                    echo "<td id = 'p".$thisPlayerNum."b10_3' class = 'reset'></td>";
                // 이외에 점수 입력
                else
                    echo"<td id = 'p".$thisPlayerNum."b10_3' class = 'reset'>".$row['ball_10_3']."</td>";
            }
        }
        ?>

        <!-- 핸디캡 점수 보여주는 칸 -->
        <td colspan="2" bgcolor="#D6EBF0"><div id="hdp"><?php echo $row['hdp']?></div></td>
    </tr>

    <!--  ============== 3번째 행 : 프레임 점수   ============== -->
    <tr>
        <!-- 1~9프레임 -->
        <?php for($i = 1; $i < MAX_FRAME; $i++) { ?>
            <td id="p<?=$thisPlayerNum?>f<?=$i?>" class="" colspan="2">
                    <span id="player0_<?=${"frame".$i}?>">
                        <?php if($pNum > $thisPlayerNum && $fNum == $i)
                            echo ${"frame".$i};
                        else if($fNum > $i)
                            echo ${"frame".$i};
                        else {};?>
                    </span>
            </td>
        <?php }?>

        <!-- 10프레임 -->
        <td id="p<?=$thisPlayerNum?>f10" colspan="3">
                <span id="player0_frame10">
                    <?php if($pNum > $thisPlayerNum && $fNum == 10)
                        echo $frame10;
                    else if($fNum > 10)
                        echo $frame10;
                    else {};?>
                </span>
        </td>

        <!-- 총 점수 보여주는 칸 -->
        <td colspan="2" bgcolor="#D6EBF0"><b>
                <span id="score">
                    <?php if($total > 300)
                        $total = 300;
                    echo $total?>
                </span></b>
        </td>
    </tr>
    </tbody>
</table><br>