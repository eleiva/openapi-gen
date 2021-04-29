<?php
use PHPUnit\Framework\TestCase;
use cebe\openapi\Reader;

class OpenApiFileTest extends TestCase
{

    public function testComponentsShema()
    {
        $openapi = Reader::readFromYamlFile(realpath('src/tests/resources/petstore.yaml'));
           
        $result = $openapi->components->validate();
        $this->assertEquals([], $openapi->components->getErrors());
        $this->assertTrue($result);

        $this->assertCount(6, $openapi->components->schemas);

        $this->assertArrayHasKey('Pet', $openapi->components->schemas);
    }


    public function testPaths()
    {
        $openapi = Reader::readFromYamlFile(realpath('src/tests/resources/petstore.yaml'));
           
        $paths = $openapi->paths;
    
        $this->assertTrue($paths->hasPath('/pet'));
        $this->assertTrue(isset($paths['/pet']));    
    }
}