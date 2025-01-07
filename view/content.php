<!-- ================== INFO ===========================
페이지명 : content.php (게임 시작 전 CONTENT 영역 페이지)
경로 : ./view/content.php
=====================================================-->

<script type="text/javascript" src="./js/jquery1.11.2.min.js"></script>
<div class="container" style="margin-bottom: 2em; position:relative">
    <!-- FORM : POST 방식으로 result.php로 넘겨줌 -->
    <form name="form" method="post" action="./pj/result.php" onsubmit="return gameStart(this);">
        <div class="row">
        <!-- 왼쪽 영역 -->
        <div class="col-md-8" style="height: 480px; padding-top: 40px; padding-right: 2em; background-image: url('./img/content_bg.png'); background-size: 95%; background-position: left bottom; background-repeat: no-repeat;">
            <h2><b>Score Board</b></h2>
            <p>플레이어를 추가하고 게임시작 버튼을 클릭하세요</p>
            <!-- 플레이어 입력 영역 -->
            <div style="display: flex; height: 45px">
                <div class="col-sm-4 user" style="padding-left: 0px; padding-right: 5px">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user-plus"></i></div>
                        </div>
                        <input type="text" class="form-control" id="playerName1" name="playerName[]" placeholder="대표 플레이어">
                    </div>
                </div>
                <input class="form-control mr-sm-1" type="number" min="0" max="300" id="hdp1" name="hdp[]" style="width:120px;" placeholder="핸디캡 점수">
                <button class="btn btn-warning userAdd" type="button" style="height:38px; width: 38px;"><i class="fas fa-plus"></i></button>
                <button class="btn btn-danger" id="userDel" onclick="removeBtn()" type="button" style="margin-left: 5px; height:38px; width: 38px;" disabled="disabled"><i class="fas fa-minus"></i></button>
                <input type="hidden" name="status" value="s">
                <input type="hidden" name="cnt" value="">
            </div>
            <?php for($i = 2; $i < 7; $i++) {
            echo "<div id='userForm".$i."' style='background-color: white'></div>"; } ?>
            <br><br><br>
            <div class="row" style="position:absolute; bottom:5px; left:30px; margin-left: 10px; margin-right: 10px">
                <span style="color:gray"><b>
                    <i class="fas fa-angle-double-right" style="padding-right: 10px;"></i>대표 플레이어의 이름은 필수입니다<br>
                    <i class="fas fa-angle-double-right" style="padding-right: 10px;"></i>최대 6명까지 플레이 할 수 있습니다</b></span>
            </div>
            <div class="row" style="position:absolute; bottom:0px; right:30px; margin-left: 10px; margin-right: 10px">
                <button class="btn btn-warning btn-lg" id="btnStart" type="submit" ><i class="fas fa-angle-double-right" style="padding-right: 10px;"></i><b>게임시작</b></button>
            </div>
        </div>
        <!-- 오른쪽 영역 -->
        <div class="col-md-4" id="scoreInput">
            <div style="text-align: left; margin-left: 15px; margin-right: 15px;">
                <br><h4><b><i class="fas fa-save" style="padding-right: 10px;"></i>이전 게임 불러오기</b></h4>
                <p>저장된 게임을 불러올 수 있습니다</p>
                <?php require_once './pj/list/listNoQuitGame.php'; ?>
                <?php require_once './pj/list/listQuitGame.php'; ?>
                <ul class="tabs" style="width : 100%">
                    <li class="active" rel="tab1">진행 중 <span class="badge badge-dark"><?= $noQuitGameNum ?></span></li>
                    <li rel="tab2">종료 <span class="badge badge-dark"><?= $quitGameNum ?></span></li>
                </ul>
                <!-- 리스트를 탭으로 보여줌 -->
                <div class="tab_container" style="border-radius: 0px 0px 10px 10px; text-align: left; padding: 20px 20px; width: 100%; height:250px; margin-bottom: 10px; overflow: auto;">
                    <div id="tab1" class="tab_content"><?= $listNoQuitGame ?></div>
                    <div id="tab2" class="tab_content"><?= $listQuitGame ?></div>
                </div>
            </div>
            </div>
        </div>
    </form>
</div>

