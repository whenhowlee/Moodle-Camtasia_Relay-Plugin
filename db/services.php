<?php

// This file is part of Moodle-Camtasia_Relay-Plugin
//
// Moodle-Camtasia_Relay-Plugin is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle-Camtasia_Relay-Plugin is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle-Camtasia_Relay-Plugin.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Service definition file for component 'filter_camtasia_relay'
 *
 * @package   filter_camtasia_relay
 * @copyright 2012 Mark Schall, TechSmith Corporation (link: http://techsmith.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'local_camtasia_relay_add_discussion' => array(
                'classname'   => 'local_camtasia_relay_external',
                'methodname'  => 'add_discussion',
                'classpath'   => 'local/camtasia_relay/externallib.php',
                'description' => 'Adds a Relay Presentation discussion to a course',
                'type'        => 'write',
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'Camtasia Relay Notification Service' => array(
                'functions' => array ('local_camtasia_relay_add_discussion'),
                'restrictedusers' => 0,
                'enabled'=>1,
        )
);
