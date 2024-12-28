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

class block_student_info extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_student_info');
    }

    public function get_content() {
        global $USER, $COURSE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        // Verifica se o usuário está logado e inscrito no curso.
        if (isloggedin() && !isguestuser() && isset($COURSE->id)) {
            // Obtém o nome do estudante.
            $firstname = html_writer::tag('strong', $USER->firstname);

            // Busca grupos do usuário no curso atual.
            $groups = groups_get_all_groups($COURSE->id, $USER->id);

            if (!empty($groups)) {
                $groupnames = array_map(function($group) {
                    return html_writer::tag('strong', $group->name);
                }, $groups);
                $groupname = implode(', ', $groupnames);
            } else {
                $groupname = html_writer::tag('strong', get_string('nogroup', 'block_student_info'));
            }

            // Gera a mensagem formatada.
            $this->content->text = html_writer::tag('p', get_string('welcome', 'block_student_info', $firstname))
                                . html_writer::tag('p', get_string('groupname', 'block_student_info', $groupname));
        } else {
            $this->content->text = get_string('notloggedin', 'block_student_info');
        }

        return $this->content;
    }
}

// Strings de idioma.
defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Identificação';
$string['welcome'] = 'Olá, {$a} 👋';
$string['nogroup'] = 'Nenhum grupo atribuído';
$string['groupname'] = 'Seu grupo: {$a}';
$string['notloggedin'] = 'Você precisa estar logado para visualizar estas informações.';

// Adiciona version.php
$file_version = "<?php
// Este arquivo é parte do Moodle - http://moodle.org/
//
// O Moodle é um software livre: você pode redistribuí-lo e/ou modificá-lo
// sob os termos da Licença Pública Geral GNU conforme publicada pela
// Free Software Foundation, seja na versão 3 da Licença ou
// (a seu critério) qualquer versão posterior.
//
// O Moodle é distribuído na esperança de que seja útil,
// mas SEM QUALQUER GARANTIA; sem mesmo a garantia implícita de
// COMERCIABILIDADE ou ADEQUAÇÃO A UM DETERMINADO FIM. Consulte a
// Licença Pública Geral GNU para mais detalhes.
//
// Você deve ter recebido uma cópia da Licença Pública Geral GNU
// junto com este programa. Se não, veja <http://www.gnu.org/licenses/>.

/**
 * Detalhes da versão
 *
 * @package    block_student_info
 * @category   blocks
 * @copyright  2024 Carlos Andre
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 ou posterior
 */

defined('MOODLE_INTERNAL') || die();

\$plugin->version   = 2024111100;        // A versão atual do plugin (Data: YYYYMMDDXX).
\$plugin->requires  = 2023042500;        // Requer esta versão do Moodle.
\$plugin->component = 'block_student_info'; // Nome completo do plugin (usado para diagnósticos).
";

