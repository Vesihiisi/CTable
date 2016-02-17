<?php



use Vesihiisi\Ctable\Ctable;

class CTableTest extends PHPUnit_Framework_TestCase
{

    private $data = array(
        array("Row 1 value 1", "Row 1 value 2", "Row 1 value 3", "Row 1 value 4",),
        array("Row 2 value 1", "Row 2 value 2", "Row 2 value 3", "Row 2 value 4",),
        );

    private $headers = array(
        "Header 1", "Header 2", "Header 3", "Header 4",
        );

    private $footers = array(
        "Footer 1", "Footer 2", "Footer 3", "Footer 4",
        );

    public function testGenerateTableBasic()
    {
        $expectedResult = "<table><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableNoHeadersGiven()
    {
        $expectedResult = "<table><thead><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr></thead><tbody><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableWithClasses()
    {
        $expectedResult = "<table class = 'someClass anotherClass'><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        'class' => array(
        'someClass',
        'anotherClass',
        ),
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableWithId()
    {
        $expectedResult = "<table id = 'table01'><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        'id' => "table01",
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableWithClassesAndId()
    {
        $expectedResult = "<table class = 'someClass anotherClass' id = 'table01'><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        'class' => array(
        'someClass',
        'anotherClass'),
        'id' => 'table01',
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableWithCaption()
    {
        $expectedResult = "<table><caption>Important data</caption><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        'caption' => "Important data",
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGenerateTableWithFooter()
    {
        $expectedResult = "<table><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr></tbody><tfoot><tr><td>Footer 1</td><td>Footer 2</td><td>Footer 3</td><td>Footer 4</td></tr></tfoot></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        'footers' => $this->footers,
        ]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testAddNewRow()
    {
        $expectedResult = "<table><thead><tr><td>Header 1</td><td>Header 2</td><td>Header 3</td><td>Header 4</td></tr></thead><tbody><tr><td>Row 1 value 1</td><td>Row 1 value 2</td><td>Row 1 value 3</td><td>Row 1 value 4</td></tr><tr><td>Row 2 value 1</td><td>Row 2 value 2</td><td>Row 2 value 3</td><td>Row 2 value 4</td></tr><tr><td>Row 3 value 1</td><td>Row 3 value 2</td><td>Row 3 value 3</td><td>Row 3 value 4</td></tr></tbody></table>";
        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        ]);
        $table->addRow(["Row 3 value 1", "Row 3 value 2", "Row 3 value 3", "Row 3 value 4"]);
        $result = $table->View();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetNumberOfRows()
    {
        $expectedResult = 2;

        $table = new CTable([
        'rows' => $this->data,
        'headers' => $this->headers,
        ]);
        $result = $table->getNumberOfRows();
        $this->assertEquals($expectedResult, $result);
    }


}
