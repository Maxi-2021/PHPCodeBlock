class TokenTruncateTest extends PHPUnit_Framework_TestCase {
  public function testBasic() {
    $this->assertEquals("1 3 5 7 9 ",
      tokenTruncate("1 3 5 7 9 11 14", 10));
  }

  public function testEmptyString() {
    $this->assertEquals("",
      tokenTruncate("", 10));
  }

  public function testShortString() {
    $this->assertEquals("1 3",
      tokenTruncate("1 3", 10));
  }

  public function testStringTooLong() {
    $this->assertEquals("",
      tokenTruncate("toooooooooooolooooong", 10));
  }

  public function testContainingNewline() {
    $this->assertEquals("1 3\n5 7 9 ",
      tokenTruncate("1 3\n5 7 9 11 14", 10));
  }
}
