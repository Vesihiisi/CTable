# CTable

## Introduction

Ctable is a PHP class for generating HTML tables out of data in arrays. It was created as part of the course DV1486 Databased Web Applications with PHP and MVC framework at Blekinge Institute of Technology, Sweden.

It is intended to be used with [Anax MVC](https://github.com/mosbth/Anax-MVC).

## License
----------------------------------

This software is free software and carries a MIT license.


## How to use

### How to create a table

The data that you want to display in a table should be an array of arrays. Each inside array corresponds to one table row. Together, all the rows are collected in an outside array:

    $rows = array(
        array("Row 1 value 1", "Row 1 value 2", "Row 1 value 3", "Row 1 value 4",),
        array("Row 2 value 1", "Row 2 value 2", "Row 2 value 3", "Row 2 value 4",),
        array("Row 3 value 1", "Row 3 value 2", "Row 3 value 3", "Row 3 value 4",),
        array("Row 4 value 1", "Row 4 value 2", "Row 4 value 3", "Row 4 value 4",),
        array("Row 5 value 1", "Row 5 value 2", "Row 5 value 3", "Row 5 value 4",),
        );

Then you might want to add the table headings, also as an array. It is not necessary, though – if you fail to do so, the first row of your data will be used as headings.

    $headers = array(
        "Header 1", "Header 2", "Header 3", "Header 4",
        );

You can now create the table object and feed it in your data. This is how it would be done in Anax MVC:

    $table = new \Vesihiisi\CTable\CTable([
        'rows' => $rows,
        'headers' => $headers,
        ]);

Once the object is created, you can also add new rows one by one:

    $table->addRow(["Extra row value 1", "Extra row value 2", "Extra row value 3", "Extra row value 4"]);

Finally, in order to actually render the table, you must use the object's View() method and display the result in your view:

        $app->views->add('default/page', [
        'content' => $table->View(),
        'title' => "Demonstration of tables in HTML"
    ]);
