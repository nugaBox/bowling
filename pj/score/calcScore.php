<?php
//====================== INFO ===========================
// Program Name : calcScore.php
// Description :  볼링 점수 계산
// Path : /bowling/pj/calcScore.php
//
//========================================================

 class calcScore {
    public $rolls = array();    // 핀 점수를 담는 배열
    const MAX_PIN = 10;         // 최대 핀 값
    const MAX_FRAME = 10;       // 최대 프레임 값

    // 입력한 핀의 값을 rolls에 입력
    public function roll($pins) {
        $this->rolls[] = $pins;
    }

    // 점수 계산 함수 : rolls 배열에 담겨 있는 값으로 계산
    public function score() {
        $score = 0;             // 최종 점수
        $ballNum = 0;           // 투구 번호

        // 각 프레임 별로 계산 (두 번의 기회를 가짐)
        for ($frame = 0; $frame < self::MAX_FRAME; $frame++) {

            // 스트라이크 : 10점 + 보너스 점수 (다음 첫번째, 두번째 핀 점수)
            if ($this->isStrike($ballNum)) {
                $score += self::MAX_PIN + $this->rolls[$ballNum + 1] + $this->rolls[$ballNum + 2];;
                $ballNum++;
            }
            // 스페어 : 10점 + 보너스 점수 (다음 프레임 첫번째 핀 점수)
            else if ($this->isSpare($ballNum)) {
                $score += self::MAX_PIN + $this->rolls[$ballNum + 2];;
                $ballNum += 2;
            }
            // 일반적인 투구 : 두 번의 핀 점수
            else {
                $score += $this->rolls[$ballNum] + $this->rolls[$ballNum + 1];
                $ballNum += 2;
            }
        }
        return $score;
    }

     private function isStrike($ballNum) {
         return $this->rolls[$ballNum] == self::MAX_PIN;
     }

     private function isSpare($ballNum) {
         return $this->rolls[$ballNum] + $this->rolls[$ballNum+1] == self::MAX_PIN;
     }


    /* 실제 핀 점수를 입력하는 함수 */

        public function rollSpare() {
            $this->roll(5);
            $this->roll(5);
        }

        public function rollStrike() {
            $this->roll(10);
        }

        public function rollMany($n, $pins) {
            for ($i = 0; $i < $n; $i++) {
                $this->roll($pins);
            }
        }
}
