<?php

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    public function definition() {
        global $DB;

        $mform = $this->_form; // Don't forget the underscore!

        $courses = $DB->get_records('course', null, '', 'id, fullname');

        $options = [];

        foreach ($courses as $c) {
            $options[$c->id] = $c->fullname;
        }

        $select = $mform->addElement('select', 'featuredcourses', 'Please Select Featured Courses', $options, ['size' => 30]);
        $select->setMultiple(true);

        $this->add_action_buttons();
    }

    function validation($data, $files) {
        return [];
    }
}

