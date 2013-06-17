<?php

namespace Webforge\Common;

class ClassUtilTest extends \Webforge\Code\Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Webforge\\Common\\ClassUtil';
    parent::setUp();
  }

  /**
   * @dataProvider provideGetNamespace
   */
  public function testGetNamespaceTestsAreConciseWithPHP($className, $namespace) {
    $refl = new \ReflectionClass($className);

    $this->assertEquals($namespace, $refl->getNamespaceName());
  }

  /**
   * @dataProvider provideGetClassName
   */
  public function testGetClassNameTestsAreConciseWithPHP($fqn, $expectedClassName) {
    $refl = new \ReflectionClass($fqn);

    $this->assertEquals($expectedClassName, $refl->getShortName());
  }

  /**
   * @dataProvider provideGetClassName
   */
  public function testGetClassName($fqn, $expectedClassName) {
    $this->assertEquals(
      $expectedClassName,
      ClassUtil::getClassName($fqn)
   );
  }

  /**
   * @dataProvider provideGetNamespace
   */
  public function testGetNamespace($className, $expectedNamespace) {
    $this->assertEquals(
      $expectedNamespace,
      ClassUtil::getNamespace($className)
   );
  }


  /**
   * @dataProvider provideExpandNamespace
   */
  public function testExpandNamespace($className, $namespace, $expectedFQN) {
    $this->assertEquals(
      $expectedFQN,
      ClassUtil::expandNamespace($className, $namespace)
    );
  }

  public static function provideExpandNamespace() {
    $tests = array();
  
    $test = function() use (&$tests) {
      $tests[] = func_get_args();
    };
  
    $test('ClassUtil', 'Webforge\Common', 'Webforge\Common\ClassUtil');
    $test('\ClassUtil', 'Webforge\Common', 'Webforge\Common\ClassUtil');
    $test('ClassUtil', 'Webforge\Common\\', 'Webforge\Common\ClassUtil');
    $test('ClassUtil', '\Webforge\Common\\', 'Webforge\Common\ClassUtil');
    $test('ClassUtil', '\Webforge\Common', 'Webforge\Common\ClassUtil');
    $test('\ClassUtil', '\Webforge\Common', 'Webforge\Common\ClassUtil');

    $test('Webforge\Common\ArrayUtil', '\Webforge\Common', 'Webforge\Common\ArrayUtil');
    $test('\Webforge\Common\ArrayUtil', '\Webforge\Common', 'Webforge\Common\ArrayUtil');
    $test('\Webforge\Common\ArrayUtil', 'Webforge\Common', 'Webforge\Common\ArrayUtil');
    $test('Webforge\Common\ArrayUtil', 'Webforge\Common', 'Webforge\Common\ArrayUtil');

    return $tests;
  }

  public static function provideGetNamespace() {
    $tests = array();
  
    $test = function() use (&$tests) {
      $tests[] = func_get_args();
    };

    // unfortunately classes do have to exist for php reflection
  
    $test('Webforge\Common\ClassUtil', 'Webforge\Common');
    $test('Traversable', NULL);

    // exception?
    $test('\Webforge\Common\ClassUtil', 'Webforge\Common');
    $test('\\Traversable', NULL);

    // undefined! (phpReflection throws error)
    //$test('\Webforge\Common\ClassUtil\\', 'Webforge\Common\ClassUtil');

  
    return $tests;
  }

  public static function provideGetClassName() {
    $tests = array();
  
    $test = function() use (&$tests) {
      $tests[] = func_get_args();
    };

    // unfortunately classes do have to exist for php reflection
  
    $test('Webforge\Common\ClassUtil', 'ClassUtil');
    $test('Traversable', 'Traversable');

    $test('\Webforge\Common\ClassUtil', 'ClassUtil');
    $test('\\Traversable', 'Traversable');

    // undefined! (phpReflection throws error)
    //$test('\Webforge\Common\ClassUtil\\', 'Webforge\Common\ClassUtil');

  
    return $tests;
  }
}