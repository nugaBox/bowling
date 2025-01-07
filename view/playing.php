<?php
//====================== INFO ===========================
// Program Name : playing.php
// Description :  게임 진행 시 CONTENT 영역 내용
// Path : ./view/playing.php
//
//========================================================

    // 변수 설정
    require "./pj/playing/setPlaying.php"; ?>

<!-- CONTENT 영역 내용 -->
<div class="container" style="margin-bottom: 2em;">
	<form id="syForm" name="syForm" method="post">
        <div class="row">
            <!-- 왼쪽 영역 : 스코어 보드 -->
            <div class="col-md-8" style="padding-top: 40px; padding-right: 2em;">
                <h2><b>Score Board</b></h2>
                <p>점수를 클릭하여 기록하고 스코어를 확인할 수 있습니다</p><br>
                <!-- 스코어보드 출력 영역 -->
                <article>
                    <div class="card" id="card">
                        <div class="card-body">
                            <?php
                                /* 각 플레이어별 스코어보드 출력 반복 시작 */
                                for($thisPlayerNum = 1; $thisPlayerNum <= $userNumber; $thisPlayerNum++){
                                    $thisPlayerSeq = $startSeq + $thisPlayerNum - 1; // 각 스코어보드 플레이어 고유번호

                                    // 각 스코어보드의 게임 정보 가져오기
                                    $sql = "SELECT S.*, M.* FROM NGJANG_SAVEDGAME AS S LEFT OUTER JOIN NGJANG_MASTER AS M ON S.gseq=M.seq
                                            WHERE S.seq=".$thisPlayerSeq." ORDER BY S.seq ASC";
                                    $result = mysqli_query($dbConn, $sql);
                                    $row = mysqli_fetch_array($result);
                            ?>

                            <!-- 각 스코어보드의 점수 계산 및 업데이트 -->
                            <?php require './pj/playing/updateScore.php'; ?>
                            <div style="display:flex; margin-top:15px; margin-bottom: 10px; padding-left: 10px">
                                <!-- 플레이어 이름 영역 -->
                                <div style="flex:1; text-align: left;">
                                    <i class="fas fa-user" style="padding-right: 10px;"></i><b><span id="player0_name"><?php echo $row['playerName']?></span></b>
                                </div>
                                <!-- 플레이어 이벤트 알림 영역 -->
                                <div id="player<?=$thisPlayerNum?>Alert" style="flex:1; text-align: right;"></div>
                                <?php require "./pj/playing/eventAlert.php";?>
                            </div>
                            <!-- 테이블 영역 -->
                            <?php require "./pj/playing/printTable.php";?>
                            <!-- 스코어보드에 필요한 Javascript 변수 -->
                            <script>
                                var thisPlayerNum = "<?php echo $thisPlayerNum ?>";
                                var tenFrame1 = "<?php echo $row['ball_10_1']?>";
                                var tenFrame2 = "<?php echo $row['ball_10_2']?>";
                                var tenFrame3 = "<?php echo $row['ball_10_3']?>";
                                recentFrame(); // 현재
                            </script>
                            <?php /* 스코어보드 출력 끝 */ }?>
                        </div>
                    </div>
                </article>
            </div>

            <?php
                /* 각 프레임 1구 이후 버튼 비활성화 설정 */

                // 10프레임 3구
                if ($fNum == MAX_FRAME && $bNum == 3)
                    $recentFirstPin = 0;
                // 경기종료
                else if ($fNum == END_GAME)
                    $recentFirstPin = 11;
                // 그외 : 각 프레임 1구
                else
                    $recentFirstPin = $recentplayerRow['ball_'.$fNum.'_1'];
            ?>

            <!-- 오른쪽 영역 : 점수 입력 관련 버튼 / 위치 화면 고정 -->
            <div class="col-md-4" id="scoreInput" style="position: relative">
                <div style = "position: fixed; ">
                    <!-- 알림창 -->
                    <div class="alert alert-info" id="alert1" role="alert" style="height: 50px"><span id="recentPlayerName" style="color:#353A3F"><i class="fas fa-running" style="padding-right: 10px;"></i><b><?php echo $recentplayerName; ?></b> 님 PLAY BALL!</span></div>
                    <div style="display: flex; margin-top: 5px; margin-bottom: 5px;">
                        <div style="flex: 1; text-align: left; color: gray;"><b>GameNo.<?= $row['gseq'] ?></b></span></div>
                        <div style="flex: 1; text-align: right; margin-bottom: 10px;"><a href="#" onclick="deleteBtn()" style="text-decoration: none;"><i class="fas fa-backspace" style="padding-right: 10px;"></i>지우기</a></div>
                    </div>
                    <!-- 숫자 버튼 -->
                    <div>
                        <?php for ($i = 0; $i < MAX_PIN; $i++){ ?>
                        <button class="btn btn-danger btn-sm" id="btn<?= $i?>" value="<?= $i?>" type="button" onclick="insertBtn(this.value)"><?=$i?></button>
                        <?php } ?>
                        <button class="btn btn-danger btn-sm" id="btn10" value="10" type="button" onclick="insertBtn(this.value)" data-toggle="tooltip" data-placement="right" data-original-title="스트라이크">X</button>
                        <!-- 버튼 비활성화 -->
                        <script>btnDisabled(<?= $recentFirstPin ?>);</script>
                    </div>
                    <!-- 자동 게임 버튼 -->
                    <div style="margin-top: 8px;">
                        <button class="btn btn-dark btn-group-sm" id="btnRandom" type="button" style="width: 32%" onclick="randomBtn()" data-toggle="tooltip" data-placement="bottom" data-original-title="랜덤으로 점수 생성">Random</button>
                        <button class="btn btn-dark btn-group-sm" id="btnPerfect" type="button" style="width: 32%" onclick="gameBtn(10)" data-toggle="tooltip" data-placement="bottom" data-original-title="모든 프레임 스트라이크">Perfect</button>
                        <button class="btn btn-dark btn-group-sm" id="btnAllSpare" type="button" style="width: 32%" onclick="gameBtn(5)" data-toggle="tooltip" data-placement="bottom" data-original-title="모든 프레임 스페어 처리">All Spare</button>
                    </div>
                    <br><br>
                    <!-- 게임 설정 버튼 -->
                    <div class="row" style="margin-left: 0px; margin-right: 0px">
                        <button class="btn btn-warning my-1" id="btnReset" type="button" style="width: 48%; margin-right: 5px;" onclick="resetBtn()" ><i class="fas fa-trash-alt" style="padding-right: 10px;"></i>다시 시작</button>
                        <button class="btn btn-success my-1" id="btnHome" type="button" style="width: 48%; margin-left: 5px;" onclick="homeBtn()" ><i class="fas fa-home" style="padding-right: 10px;"></i>첫 화면</button>
                    </div>
                </div>
            </div>
        </div>
	</form>
</div>
<?php
    /* 게임 종료 */
    if($fNum == END_GAME){
        echo "<script>document.getElementById(\"alert1\").className = \"alert alert-warning\"</script>";
        echo "<script>document.getElementById(\"alert1\").innerHTML = \"<i class=\'fas fa-trophy\' style=\'padding-right: 10px;\'></i>게임이 종료되었습니다</span>\";</script>";

        $sql = "update NGJANG_MASTER set gameStatus ='Y' where seq = '".$gseq."'";
        $result = mysqli_query($dbConn, $sql);
    }
?>