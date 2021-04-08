/* =============== 시작 화면 ==================*/

var userCnt = 1;        // 플레이 인원

/* 플레이어 추가 버튼 */
$(document).ready(function() {
    $('.userAdd').click(function() {
        if (userCnt > 5) {
            alert("플레이어를 더 이상 추가할 수 없습니다");
            return 0;
        }
        document.getElementById('userDel').disabled = false;

        userCnt = $('.user').length;
        userCnt++;
        // 추가 표시할 영역
        var user = '<div style="display: flex; height: 45px">';
        user += '<div class="col-sm-4 user" style="padding-left: 0px; padding-right: 5px">';
        user += '<div class="input-group">';
        user += '<div class="input-group-prepend">';
        user += '<div class="input-group-text"><i class="fas fa-user-plus"></i></div>';
        user += '</div>';
        user += '<input type="text" class="form-control" id="playerName'+userCnt+'" name="playerName[]" placeholder="플레이어'+userCnt+'">';
        user += '</div>';
        user += '</div>';
        user += '<input class="form-control mr-sm-1" type="number" min="0" max="300" id="hdp'+userCnt+'" name="hdp[]" style="width:120px;" placeholder="핸디캡 점수">';
        user += '</div>';

        $('#userForm'+userCnt).append(user); // #userForm 자리에 넣어주기
    });
});

/* 플레이어 삭제 버튼 */
function removeBtn() {
    // var formNum = val;

    document.getElementById('userForm'+userCnt).innerHTML="";
    if(userCnt == 2){
        document.getElementById('userDel').disabled = 'disabled';
    }
    userCnt--;
}

/* 게임시작 버튼 클릭 시 폼 체크 */
function gameStart(form) {

    // 실패 : 대표 플레이어명(1번) 없을 때
    if(form.playerName1.value == ''){
        alert('대표 플레이어 이름은 필수입니다');
        form.playerName1.focus();
        return false;
    }
    // 성공 : 폼으로 값 전송
    else {
        form.cnt.value = userCnt;
        return true;
    }
}

/* =============== 버튼 관련 ==================*/

const MAX_FRAME = 10;                      // 최대 프레임 번호
const MAX_PIN = 10;                        // 최대 핀 점수
const END_GAME = 11;                       // 게임 종료시 프레임 번호 설정
const STRIKE_PIN = 10;                     // 스트라이크 핀 점수
const SPARE_PIN = 10;                      // 스페어 핀 점수

/* 점수 숫자 입력 버튼 */
function insertBtn(val){
    var point = val;
    var data = {"gseq":gseq, "point":point, "status":'c', "pinstatus":pinstatus, "startSeq":startSeq, "endSeq":endSeq};
    $.ajax({
        url:"./pj/result.php",
        type:'POST',
        data: data,
        success:function(data){
            // alert("완료!"+data);
            // $('#card').html(data); // card div만 로드
            document.location.reload(true); // 캐시 해제하고 리로드
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            self.close();
        }
    });
}

/* 점수 지우기 버튼 */
function deleteBtn(){
    var data = {"gseq":gseq, "status":'d', "pinstatus":pinstatus, "startSeq":startSeq, "endSeq":endSeq};
    $.ajax({
        url:"./pj/result.php",
        type:'POST',
        data: data,
        success:function(data){
            // alert("완료!"+data);
            // $('#card').html(data); // card div만 로드
            document.location.reload(true); // 캐시 해제하고 리로드
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            self.close();
        }
    });
}

/* 자동 게임 버튼 (퍼펙트 게임, 올스페어 게임) */
function gameBtn(val){
    var point = val;

    // 플레이어가 1명일 때
    if (userNumber != 1)
        var ok = confirm("모든 플레이어에게 자동게임이 진행됩니다");
    // 플레이어가 여러 명일 때
    else
        var ok = confirm("자동게임을 진행합니다");

    if(ok == false)
        return 0;

    var data = {"gseq": gseq, "status": 'g', "point": point, "pinstatus":pinstatus, "startSeq":startSeq, "endSeq":endSeq};
    $.ajax({
        url: "./pj/result.php",
        type: 'POST',
        data: data,
        success: function (data) {
            document.location.reload(true); // 캐시 해제하고 리로드
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            self.close();
        }
    });
}

/* 랜덤 게임 버튼 */
function randomBtn(){

    // 플레이어가 1명일 때
    if (userNumber != 1)
        var ok = confirm("모든 플레이어에게 자동게임이 진행됩니다");
    // 플레이어가 여러 명일 때
    else
        var ok = confirm("자동게임을 진행합니다");

    if(ok == false)
        return 0;

    var data = {"gseq": gseq, "status": 'm', "startSeq":startSeq, "endSeq":endSeq};
    $.ajax({
        url: "./pj/result.php",
        type: 'POST',
        data: data,
        success: function (data) {
            document.location.reload(true); // 캐시 해제하고 리로드
            // alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            self.close();
        }
    });
}

/* 게임 리셋 */
function gameClear(){
    var data = {"gseq": gseq, "status": 'r'};
    $.ajax({
        url: "./pj/result.php",
        type: 'POST',
        data: data,
        success: function (data) {
            document.location.reload(true); // 캐시 해제하고 리로드
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            self.close();
        }
    });
}

/* 다시 시작 버튼 */
function resetBtn(){
    var ok = confirm("현재 게임을 다시 시작하시겠습니까?");
    if(ok == true) {
        gameClear();
    }
}

/* 홈 화면 버튼 */
function homeBtn() {
    var ok = confirm("현재 게임을 저장하고 홈 화면으로 돌아갑니다");
    if(ok == true){
        location.href='./index.php';
    }
}

/* 버튼 비활성화 */
function btnDisabled(pin) {
    // 첫번째 투구 후 두번째에 칠 수 있는 핀 수
    var secondPin = Number(10 - pin + 1);

    if (pin != 10) {
        while (secondPin <= 10) {
            document.getElementById('btn'+secondPin).className = "btn btn-outline-secondary btn-sm";
            document.getElementById('btn'+secondPin).disabled = 'disabled';
            secondPin++;
        }
    }
}

/* ============================================*/

/* 현재 진행 중인 프레임 표시 */
function recentFrame(){

    if(pNum == thisPlayerNum) {

        // 게임 종료 시
        if(fNum == END_GAME)
            return 0;

        // 1~9프레임
        document.getElementById('p' + thisPlayerNum + 'f' + fNum).className = "recent";            // 프레임 점수 칸
        document.getElementById('p' + thisPlayerNum + 'b' + fNum + '_1').className = "recent";     // 1번째 볼 칸
        document.getElementById('p' + thisPlayerNum + 'b' + fNum + '_2').className = "recent";     // 2번째 볼 칸

        //10프레임
        if(fNum == MAX_FRAME) {
            document.getElementById('p' + thisPlayerNum + 'f10').className = "recent";             // 10프레임 점수 칸
            document.getElementById('p' + thisPlayerNum + 'b10_1').className = "recent";           // 1번째 볼 칸
            document.getElementById('p' + thisPlayerNum + 'b10_2').className = "recent";           // 2번째 볼 칸
            document.getElementById('p' + thisPlayerNum + 'b10_3').className = "recent";           // 3번째 볼 칸

            // 1번째 볼 스트라이크
            if(tenFrame1 == STRIKE_PIN)
                document.getElementById('p' + thisPlayerNum + 'b10_1').className = "recent strike";

            // 2번째 볼 스트라이크
            if(tenFrame2 == STRIKE_PIN)
                document.getElementById('p' + thisPlayerNum + 'b10_2').className = "recent strike";

            // 2번째 볼 스페어
            if(tenFrame1 != STRIKE_PIN && tenFrame1 + tenFrame2 > SPARE_PIN)
                document.getElementById('p' + thisPlayerNum + 'b10_2').className = "recent spare";
        }
    }
}

/* 탭 메뉴 관련 */
$(function () {
    $(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active").css("color", "#333");
        //$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
        $(this).addClass("active").css("color", "primary");
        $(".tab_content").hide()
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn()
    });
});

/* 깜박이는 효과 */
setInterval(function(){
    $(".blinkEle").toggle();
}, 400);