<?php

require_once(__DIR__ . '/../../config.php');
global $DB;

$PAGE->set_url(new moodle_url('/local/featured_course/manage.php'));

$PAGE->set_context(\context_system::instance());
$PAGE->set_title("Manage Featured Course");

echo $OUTPUT->header();

$query = "SELECT mc.fullname
FROM mdl_course mc, mdl_local_featured_course mlfc 
WHERE mc.id = mlfc.courseid";

$featuredcourses = $DB->get_records_sql($query);

$featuredcourses = array_values($featuredcourses);

$templatecontext = (object)[
    'featuredcourses' => $featuredcourses,
];

// var_dump($featuredcourses);die;

echo $OUTPUT->render_from_template('local_featured_course/manage', $templatecontext);

echo $OUTPUT->footer();