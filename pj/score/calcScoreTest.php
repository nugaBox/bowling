<?php
//====================== INFO ===========================
// Program Name : calcScoreTest.php
// Description :  볼링 점수 계산 테스트
// Path : /bowling/pj/calcScoreTest.php
//
//========================================================

    require 'calcScore.php';

class calcScoreTest extends PHPUnit_Framework_TestCase
{
    private $play;

    // 점수 계산 클래스 설정
    public function setUp() {
        $this->play = new calcScore;
    }

    /**
     * GutterGame : 전부 0점일 때
     * @test
     */
    public function testGutterGame() {
        $this->play->rollMany(20, 0);
        $this->assertEquals(0, $this->play->score());
    }

    /**
     * AllOneGame : 전부 1점일 때
     * @test
     */
    public function testAllOneGame() {
        $this->play->rollMany(20, 1);
        $this->assertEquals(20, $this->play->score());
    }

    /**
     * OneSpareGame : 1번의 스페어 처리
     * @test
     */
    public function testOneSpareGame() {
        $this->play->rollSpare();
        $this->play->roll(3);
        $this->play->rollMany(17, 0);
        $this->assertEquals(16, $this->play->score());
    }

    /**
     * OneStrikeGame : 1번의 스트라이크 처리
     * @test
     **/
    public function testOneStrikeGame() {
        $this->play->rollStrike();
        $this->play->roll(3);
        $this->play->roll(4);
        $this->play->rollMany(16, 0);
        $this->assertEquals(24, $this->play->score());
    }

    /**
     * PerfectGame : 전부 스트라이크 처리
     * @test
     **/
    public function testPerfectGame() {
        $this->play->rollMany(12, 10);
        $this->assertEquals(300, $this->play->score());
    }

    /**
     * AllSpareGame : 전부 스페어 처리
     * @test
     **/
    public function testAllSpareGame() {
        $this->play->rollMany(21, 5);
        $this->assertEquals(150, $this->play->score());
    }

    /**
     * RandomGame : 랜덤 플레이
     * @test
     **/
    public function testRandomGame() {
        $this->play->roll(5);
        $this->play->roll(3);
        $this->play->roll(5);
        $this->play->roll(5);
        $this->play->rollStrike();
        $this->play->roll(8);
        $this->play->roll(2);
        $this->play->roll(4);
        $this->play->roll(3);
        $this->play->roll(1);
        $this->play->roll(5);
        $this->play->roll(0);
        $this->play->roll(0);
        $this->play->roll(0);
        $this->play->roll(4);
        $this->play->roll(5);
        $this->play->roll(3);
        $this->play->roll(8);
        $this->play->roll(2);
        $this->play->roll(9);
        $this->assertEquals(106, $this->play->score());
    }
}