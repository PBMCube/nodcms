<?php
/*
 * NodCMS
 *
 * Copyright (c) 2015-2021.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *  @author     Mojtaba Khodakhah
 *  @copyright  2015-2021 Mojtaba Khodakhah
 *  @license    https://opensource.org/licenses/MIT	MIT License
 *  @link       https://nodcms.com
 *  @since      Version 3.0.0
 *  @filesource
 *
 */

namespace NodCMS\Core\Models;

class Translations_model extends Model
{
    function __construct()
    {
        $table_name = "translations";
        $primary_key = "translation_id";
        $fields = array(
            'translation_id'=>"int(10) unsigned NOT NULL AUTO_INCREMENT",
            'table_id'=>"int(10) unsigned DEFAULT NULL",
            'table_name'=>"varchar(255) DEFAULT NULL",
            'field_name'=>"varchar(255) DEFAULT NULL",
            'language_id'=>"int(10) unsigned DEFAULT NULL",
            'translated_text'=>"text",
        );
        $foreign_tables = null;
        $translation_fields = null;
        $unique = array(
            'table_id_table_name_field_name_language_id'=>array('table_id','table_name','field_name','language_id'),
        );
        parent::__construct($table_name, $primary_key, $fields, $foreign_tables, $translation_fields);
    }
}