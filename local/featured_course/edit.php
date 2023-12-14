<?php

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/featured_course/classes/form/edit.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/featured_course/edit.php'));

$PAGE->set_context(\context_system::instance());
$PAGE->set_title("Edit");

// the form

$mform = new edit();


if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot. '/local/featured_course/manage.php');
} else if ($fromform = $mform->get_data()) {
    $DB->delete_records('local_featured_course');

    $data = [];

    foreach ($fromform->featuredcourses as $f) {
        $d = new stdClass();
        $d->courseid = $f;
        $data[] = $d;
    }
    $DB->insert_records('local_featured_course', $data);

    redirect($CFG->wwwroot. '/local/featured_course/manage.php');
}

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();
