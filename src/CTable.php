<?php

/**
 * Class that generates a table in HTML from array data.
 *
 * @author Alicia Fagerving <alicia@fagerving.se>
 */

namespace Vesihiisi\Ctable;

class Ctable
{
    private $html;
    private $headers;
    private $footers;
    private $rows;
    private $caption;
    private $class;
    private $id;

    /**
     * Output an html representation of a table row.
     * 
     * @param  array $row the values that are supposed to be in the row
     * @return string $html      the html code representing the row
     */
    private function generateTableRow($row)
    {
        $html = '';
        $html .= "<tr>";
        foreach ($row as $rowItem) {
            $html .= "<td>$rowItem</td>";
        }
        $html .= "</tr>";
        return $html;
    }

    /**
     * Output an html representation of a table header.
     * 
     * @param  array $headers the values that are supposed to be in the header row
     * @return string $html          the html code representing the header
     */
    private function generateTableHead($headers)
    {
        $html = '';
        $html .= "<thead>";
        $html .= $this->generateTableRow($headers);
        $html .= "</thead>";
        return $html;
    }

    /**
     * Output an html representation of a table footer.
     * @param  array $footers the values that are supposed to be in the footer row
     * @return string $html          the html code representing the footer
     */
    private function generateTableFoot($footers)
    {
        $html = "";
        $html .= "<tfoot>";
        $html .= $this->generateTableRow($footers);
        $html .= "</tfoot>";
        return $html;
    }

    /**
     * Output an html representation of a table body,
     * contained within <tbody> tags and containing a number
     * of rows.
     * @param  array $rows the rows that are supposed to be contained by the table body
     * @return string $html the html code representing the table body
     */
    private function generateTableBody($rows)
    {
        $html = '';
        $html .= '<tbody>';
        foreach ($rows as $row) {
            $html .= $this->generateTableRow($row);
        }
        $html .= '</tbody>';
        return $html;
    }

    /**
     * Output an html representation
     * of a table caption.
     * @param  string $text the string that is supposed to be the table caption
     * @return string       the html code representing the table caption
     */
    private function generateTableCaption($text)
    {
        return "<caption>$text</caption>";
    }

    /**
     * Output the opening <table> tag to initate a table.
     * It can look in different ways depending on whether there are any
     * class or id attributes.
     * @return string the html code representing the opening <table> tag
     */
    private function openTable()
    {
        $addons = array();
        if (count($this->class) > 0) {
            $classes = implode(" ", $this->class);
            $addons[] = "class = '$classes'";
        }
        if (!empty($this->id) && strlen($this->id) > 0) {
            $id = $this->id;
            $addons[] = "id = '$id'";
        }
        $addonsString = implode(" ", $addons);
        return "<table $addonsString>";
    }

    /**
     * Output the html code that represents a table
     * consisting of a body and a header as well as, optionally, a footer and/or
     * a caption.
     * @return string $html the html representation of a table
     */
    private function generateTable()
    {
        $html = '';
        $html .= $this->openTable();
        if ($this->caption != null) {
            $html .= $this->generateTableCaption($this->caption);
        }
        $html .= $this->generateTableHead($this->headers);
        $html .= $this->generateTableBody($this->rows);
        if (!empty($this->footers) && count($this->footers) > 0) {
            $html .= $this->generateTableFoot($this->footers);
        }
        $html .= "</table>";
        return $html;
    }

    /**
     * Initiate the object and save the data as inside parameters of the class.
     * @param array $data the array containing the data that are needed
     * to create the table
     */
    public function __construct($data)
    {
        $this->setRows($data['rows']);
        if (!empty($data['headers'])) {
            $this->setHeaders($data['headers']);
        } else {
            $this->setHeaders($data['rows'][0]);
            array_shift($this->rows);
        }
        if (!empty($data['footers'])) {
            $this->setFooters($data['footers']);
        }
        if (!empty($data['caption'])) {
            $this->caption = $data['caption'];
        }
        if (!empty($data['class'])) {
            $this->setClass($data['class']);
        }
        if (!empty($data['id'])) {
            $this->setId($data['id']);
        }
        if (!empty($data['caption'])) {
            $this->setCaption($data['caption']);
        }
    }

    /**
     * Save an array with rows as a property of the class.
     * @param array $array an array containing rows
     */
    public function setRows($array)
    {
        $this->rows = $array;
    }

    /**
     * Save an array with headers as a property of the class.
     * @param array $array an array containing table headers
     */
    public function setHeaders($array)
    {
        $this->headers = $array;
    }

    /**
     * Save an array with footers as a property of the class.
     * @param array $array an array containing table footers
     */
    public function setFooters($array)
    {
        $this->footers = $array;
    }

    /**
     * Save a table caption as a property of the class.
     * @param string $string a value that is supposed to be used as the table caption
     */
    public function setCaption($string)
    {
        $this->caption = $string;
    }

    /**
     * Save some CSS classes that are supposed to be assigned to the table
     * as a property of the class.
     * @param array $array an array that is a list of CSS classes
     */
    public function setClass($array)
    {
        $this->class = $array;
    }

    /**
     * Save a CSS id that is supposed to be assigned to the table
     * as a property of the class.
     * @param string $text a CSS id that is supposed to be assigned
     */
    public function setId($text)
    {
        $this->id = $text;
    }

    /**
     * Add one row of data to the existing array of
     * rows of data that is a property of the class.
     * @param array $data a row of data values
     */
    public function addRow($data)
    {
        $this->rows[] = $data;
    }

    /**
     * Tell me how many rows of data this table has.
     * @return integer a number representing how many rows of data this table has
     */
    public function getNumberOfRows()
    {
        return count($this->rows);
    }

    /**
     * Output the generated html table.
     * @return string complete HTML code representing a table
     */
    public function View()
    {
        return $this->generateTable();
    }
}
