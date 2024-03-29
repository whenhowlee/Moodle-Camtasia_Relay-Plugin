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
 * Version info for component 'filter_camtasia_relay'
 *
 * @package   filter_camtasia_relay
 * @copyright 2012 Mark Schall, TechSmith Corporation (link: http://techsmith.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$plugin->version  = 2012031401;   // The (date) version of this module + 2 extra digital for daily versions
                                  // This version number is displayed into /admin/forms.php
                                  // TODO: if ever this plugin get branched, the old branch number
                                  // will not be updated to the current date but just incremented. We will
                                  // need then a $plugin->release human friendly date. For the moment, we use
                                  // display this version number with userdate (dev friendly)
$plugin->requires = 2010112400;  // Requires this Moodle version - at least 2.0
$plugin->cron     = 0;
$plugin->release = 'Camtasia Relay Notification Plugin (Build: 2012020101)';
$plugin->maturity = MATURITY_STABLE;