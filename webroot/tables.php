<?php 
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php'; 



// Prepare the page content
$app->theme->setVariable('title', "Hello World Pagecontroller")
           ->setVariable('main', "
    <h1>Hello World Pagecontroller</h1>
    <p>This is a sample pagecontroller that shows how to use Anax.</p>
");

$app->theme->addStylesheet("css/tables.css");

$app->theme->setTitle("Demonstration of tables in HTML");

    $headers = array(
        "Header 1", "Header 2", "Header 3", "Header 4",
        );



    $rows = array(
        array("Row 1 value 1", "Row 1 value 2", "Row 1 value 3", "Row 1 value 4",),
        array("Row 2 value 1", "Row 2 value 2", "Row 2 value 3", "Row 2 value 4",),
        array("Row 3 value 1", "Row 3 value 2", "Row 3 value 3", "Row 3 value 4",),
        array("Row 4 value 1", "Row 4 value 2", "Row 4 value 3", "Row 4 value 4",),
        array("Row 5 value 1", "Row 5 value 2", "Row 5 value 3", "Row 5 value 4",),
        );

    $classes = array(
        "someClass",
        "anotherClass",
        );

    $caption = "Important data";

    $id = "table01";

    $table = new \Vesihiisi\CTable\CTable([
        'rows' => $rows,
        'headers' => $headers,
        'class' => $classes,
        'id' => $id,
        'caption' => $caption,
        ]);

    $table->addRow(["Extra row value 1", "Extra row value 2", "Extra row value 3", "Extra row value 4"]);

    $table->setFooters(["Footer 1", "Footer 2", "Footer 3", "Footer 4"]);


    $app->views->add('default/page', [
        'content' => $table->View(),
        'title' => "Demonstration of tables in HTML"
    ]);



// Render the response using theme engine.
$app->theme->render();
