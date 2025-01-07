<!-- Navbar : 네비게이션 바 (메뉴) -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <!-- 큰 제목 -->
    <a class="navbar-brand" href="index.php"><img src="img/title_white.png" width="200px" alt="가민볼링장 스코어 프로그램"></a>

    <!-- 왼쪽 영역 -->
    <ul class="navbar-nav mr-auto">
        <!-- 메뉴 버튼 (활성화) -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <!-- 메뉴 드롭다운 버튼 -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">볼링 관련 링크</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" target="_blank" href="https://ko.wikipedia.org/wiki/볼링">볼링이란</a>
                <a class="dropdown-item" target="_blank" href="http://www.bowling.or.kr/">대한볼링협회</a>
                <a class="dropdown-item" target="_blank" href="http://sports.koreanpc.kr/">생활체육정보센터</a>
            </div>
        </li>
    </ul>
</nav>
<!-- Header : 메인 상단 영역 -->
<header>
    <div class="indexpage" style="padding-bottom: 20px; padding-top: 30px">
        <div class="container">
            <div class="row">
                <!-- 왼쪽 영역 : -->
                <div class="col-md-8">
                    <br><br><h1 class="display-5"><b>가민볼링장에 오신 걸 환영합니다</b></h1>
                    <p>볼링 스코어를 쉽게 기록하고 친구들과 비교해보세요</p>
                    <!-- 모달 : 주변 볼링장 찾아보기 -->
                    <p><!<?php require_once './pj/modal/modalMap.php'?>
                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalMap">
                            <i class="fas fa-map-pin" style="padding-right: 10px;"></i>주변 볼링장 찾아보기
                        </button>
                    </p>
                </div>
                <!-- 오른쪽 영역 : 점수별 랭킹 -->
                <div class="col-md-4">
                    <br><h3><b>스코어 TOP 5</b><a href="#" onClick='top.location="javascript:location.reload()"' style="text-decoration: none; color: gray;">
                    <i class="rotate fas fa-sync-alt" style="font-size: 15pt"></i></a></h3>
                    <p><?php require_once './pj/list/listRanking.php'; echo $listRanking ?></p>
                </div>
            </div>
        </div>
    </div>
</header>
