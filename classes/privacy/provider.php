<?php
// This file is part of Moodle - http://moodle.org/ //

namespace block_student_info\privacy;

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

use core_privacy\local\metadata\collection;
use core_privacy\local\metadata\provider as metadata_provider;

class provider implements metadata_provider {
    public static function get_metadata(collection $collection): collection {
        $collection->add_external_location_link('example', [
            'name' => 'Example External System',
            'description' => 'An example external data integration.',
        ]);
        return $collection;
    }

    public static function get_reason(): string {
        return 'This plugin does not store any personal data.';
    }
}