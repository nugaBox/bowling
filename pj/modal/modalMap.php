<!-- 모달 : 주변 볼링장 찾아보기 -->
<div class="modal fade" id="modalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-map-pin" style="padding-right: 10px;"></i><b>내 주변 볼링장</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- iframe : 모바일 네이버지도 -->
                <iframe src="https://m.map.naver.com/search2/search.naver?query=%EB%B3%BC%EB%A7%81%EC%9E%A5&sm=hty&style=v4#/map/1" frameborder="0" scrolling="auto" align="center" width="100%" height="500px">주변 볼링장 찾아보기</iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()"><i class="fas fa-angle-left"></i></button> <!-- 뒤로가기 버튼 -->
                <button type="button" class="btn btn-outline-secondary" onclick="history.forward()"><i class="fas fa-angle-right"></i></button> <!-- 앞으로가기 버튼 -->
            </div>
        </div>
    </div>
</div>