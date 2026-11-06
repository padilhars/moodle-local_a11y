<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Capability definitions for local_a11y.
 *
 * @package    local_a11y
 * @author     Rodrigo Padilha Silveira <padilhars@gmail.com>
 * @author     Jerônimo Medina Madruga <jeronimo.madruga@gmail.com>
 * @copyright  Universidade Federal de Pelotas - UFPel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      0.1.0
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    // Can see and use the accessibility FAB/panel. Allowed by default for
    // everyone, including guests, so the plugin is useful before login.
    'local/a11y:view' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => [
            'guest' => CAP_ALLOW,
            'user' => CAP_ALLOW,
            'frontpage' => CAP_ALLOW,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
        ],
    ],

    // DECISION: local/a11y:configure removed (dead-code/security audit) -
    // it was declared here but never checked via has_capability() anywhere
    // in the plugin; settings.php is already protected by Moodle's own
    // standard mechanism (admin tree / moodle/site:config), so the
    // capability controlled nothing and would only confuse an admin who
    // assigned it expecting some effect. See version.php - the version
    // bump there is required for admin/cli/upgrade.php to actually remove
    // the orphaned capability from the database (update_capabilities()
    // only runs on upgrade when the version changes).

    // Can view the aggregate usage-stats report (admin/stats.php, D47).
    // Deliberately narrower than moodle/site:config: at the user's explicit
    // request, granted by default only to the 'manager' archetype - neither
    // editingteacher nor admin appear here on purpose (site admins always
    // pass has_capability() anyway, via is_siteadmin(), so they don't need
    // an entry of their own).
    'local/a11y:viewstats' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => [
            'manager' => CAP_ALLOW,
        ],
    ],
];
