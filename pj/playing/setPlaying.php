<?php
//====================== INFO ===========================
// Program Name : setPlaying.php
// Description :  게임 진행 페이지(Playing.php) 변수 설정
// Path : /bowling/pj/playing/setPlaying.php
//
//========================================================

    require "./pj/score/calcScore.php";   // 점수 계산 프로그램

    const MAX_FRAME = 10;                      // 최대 프레임 번호
    const MAX_PIN = 10;                        // 최대 핀 점수
    const END_GAME = 11;                       // 게임 종료시 프레임 번호 설정
    const STRIKE_PIN = 10;                     // 스트라이크 핀 점수
    const SPARE_PIN = 10;                      // 스페어 핀 점수

    // result.php에서 GET으로 넘어온 값
    $gseq = $_GET['gseq'];                     // 현재 게임 번호

    /* 플레이어 고유 번호 관련 */
    $sql = "select MIN(seq) as startSeq, MAX(seq) as endSeq from NGJANG_SAVEDGAME WHERE gseq=".$gseq;
    $result = mysqli_query($dbConn, $sql);
    $row = mysqli_fetch_array($result);

    $startSeq = $row['startSeq'];               // 시작 플레이어 번호
    $endSeq = $row['endSeq'];                   // 마지막 플레이어 번호

    /* 스코어보드에 필요한 정보 불러오기 */
    $sql = "SELECT S.*, M.* FROM NGJANG_SAVEDGAME AS S LEFT OUTER JOIN NGJANG_MASTER AS M ON S.gseq=M.seq
                WHERE S.gseq=".$gseq." ORDER BY S.seq ASC";
    $result = mysqli_query($dbConn, $sql);
    $row = mysqli_fetch_array($result);

    /* 스코어보드에 필요한 변수 */
    $userNumber = $row['userNumber'];           // 플레이 인원
    $pinstatus = $row['pinstatus'];
    list($pNum, $fNum, $bNum) = explode("_",$row['pinstatus']);
    $recentplayerSeq = $startSeq + $pNum - 1;   // 현재 턴 플레이어 번호
    // $pNum : 현재 플레이어 순서, $fNum : 프레임 번호, $bNum : 볼 번호

    /* 현재 턴 플레이어의 정보 불러오기 */
    $recentplayerSql = "SELECT * FROM NGJANG_SAVEDGAME WHERE seq=".$recentplayerSeq;
    $recentplayerResult = mysqli_query($dbConn, $recentplayerSql);
    $recentplayerRow = mysqli_fetch_array($recentplayerResult);
    $recentplayerName = $recentplayerRow['playerName'];

?>

<!-- Javascript 변수 설정 -->
<script>
    var gseq = "<?php echo $gseq?>";
    var pinstatus = "<?php echo $pinstatus?>";
    var startSeq = "<?php echo $startSeq?>";
    var endSeq = "<?php echo $endSeq?>";
    var userNumber = "<?php echo $userNumber?>";
    var pNum = "<?php echo $pNum ?>";
    var fNum = "<?php echo $fNum ?>";
    var bNum = "<?php echo $bNum ?>";
</script>
