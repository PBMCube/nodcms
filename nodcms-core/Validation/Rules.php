<?php
/**
 * NodCMS
 *
 * Copyright (c) 2020.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *  @author     Mojtaba Khodakhah
 *  @copyright  2016-2020 Mojtaba Khodakhah
 *  @license    https://opensource.org/licenses/MIT	MIT License
 *  @link       https://nodcms.com
 *  @since      Version 3.0.0
 *  @filesource
 *
 */

namespace NodCMS\Core\Validation;

/**
 * Class Rules
 * @package NodCMS\Validation
 */
class Rules
{
    /**
     * Phone number format function
     *
     * @param $text
     * @return bool
     */
    public function validPhone(string $text): bool
    {
        if($text=='' || preg_match('/^(([\+]|0|00)[1-9][0-9][\s\/\-]?)?[0-9]{1,12}?$/',$text)==TRUE){
            return TRUE;
        }else{
            $this->setError('validPhone', _l("The {field} field must be a valid phone number such as the bellow examples.",  $this).' (+12 1234567, 012 1234567, +123456789, 0123456789, +12-1234567, +12/1234567)');
            return false;
        }
    }

    /**
     * Validation time format function
     *
     * @param $text
     * @return bool
     */
    public function regexMatch24Hours(string $text): bool
    {
        if(preg_match('/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/',$text)==TRUE){
            return TRUE;
        }else{
            $this->setError('regexMatch24Hours', _l("The {field} field is not in the correct time format.",  $this));
            return false;
        }
    }

    /**
     * Validation multi time format function
     *
     * @param $text
     * @return bool
     */
    public function formRulesMultiTime(string $text): bool
    {
        if(preg_match('/^([0-1][0-9]|2[0-4]):[0-5][0-9](-([0-1][0-9]|2[0-4]):[0-5][0-9])*$/',$text)==TRUE){
            return TRUE;
        }else{
            $this->setError('formRulesMultiTime', _l("The {field} field is not in the correct time format.",  $this));
            return false;
        }
    }

    /**
     * Validation multi date format function
     *
     * @param $text
     * @return bool
     */
    public function formRulesMultiDate(string $text): bool
    {
        if(preg_match('/^([0-9]{13})(\,[0-9]{13})*$/',$text)==TRUE){
            return TRUE;
        }else{
            $this->setError('formRulesMultiTime', _l("The {field} field is not in the correct time format.",  $this));
            return false;
        }
    }

    /**
     * Validation multi date&time format function
     *
     * @param $text
     * @return bool
     */
    public function formRulesMultiDateTime(string $text): bool
    {
        if($text=='')
            return true;
        if(preg_match('/^([0-9]{13}\-((([0-1][0-9]|2[0-4])\:[0-5][0-9])+|0))(\,[0-9]{13}\-((([0-1][0-9]|2[0-4])\:[0-5][0-9])+|0))*$/',$text)){
            return true;
        }else{
            $this->setError('formRulesMultiTime', _l("The {field} field is not in the correct time format.",  $this));
            return false;
        }
    }

    /**
     * Validation time format function
     *
     * @param $text
     * @return bool
     */
    public function formRulesTimeRange(string $text): bool
    {
        if(preg_match('/^([0-1][0-9]|2[0-4]):[0-5][0-9]-([0-1][0-9]|2[0-4]):[0-5][0-9]$/',$text)==TRUE){
            return TRUE;
        }else{
            $this->setError('formRulesTimeRange', _l("The {field} field is not in the correct time format.",  $this));
            return false;
        }
    }

    /**
     * Validation password format function
     *
     * @param $value
     * @return bool
     */
    public function formRulesPassword(string $value): bool
    {
        if ($value=='' || preg_match('/^.{6,18}$/', $value) == TRUE) {
            return TRUE;
        }else{
            $this->setError('formRulesPassword', _l("The {field} field must be at least 6 and cannot exceed 18 characters in length.", $this));
            return FALSE;
        }
    }

    /**
     * Validation date format function
     *
     * @param $value
     * @return bool
     */
    public function validDate(string $value): bool
    {
        if($value=='')
            return true;
//        $match1 = preg_match('/^([0-9]{4})[\/|\.](0[1-9]|1[0-2])[\/|\.](0[1-9]|[1-2][0-9]|3[0-1])$/',$value);
//        if($match1 == TRUE ||
//            checkdate(substr($value, 3, 2), substr($value, 0, 2), substr($value, 6, 4)) ||
//            checkdate(substr($value, 0, 2), substr($value, 3, 2), substr($value, 6, 4)))
        $d1 = DateTime::createFromFormat("d.m.Y", $value);
        $d2 = DateTime::createFromFormat("m/d/Y", $value);
        $d3 = DateTime::createFromFormat("Y-m-d", $value);
        if($d1 && $d1->format("d.m.Y") == $value
            || $d2 && $d2->format("m/d/Y") == $value
            || $d3 && $d3->format("Y-m-d") == $value)
            return true;
        else{
            $this->setError('validDate', _l("The {field} field is not in the correct date format.", $this));
            return false;
        }
    }

    /**
     * Validation name format function
     *
     * @param $value
     * @return bool
     */
    public function formRulesName(string $value): bool
    {
        if (preg_match('/[\'\/~`\!@#\$£%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\0-9]/', $value) == true) {
            $this->setError('formRulesName', _l("The {field} field must contain letters and spaces only.", $this));
            $errors[] = 'Name must contain letters and spaces only';
            return false;
        }else{
            return true;
        }
    }

    /**
     * Validation username type function
     *
     * @param $value
     * @return bool
     */
    public function validateUsernameType(string $value): bool
    {
        if (preg_match('/^[A-Za-z0-9_]*$/', $value) == FALSE) {
            $this->setError('validateUsernameType', _l("The {field} field must contain just English letters and underline only.", $this));
            return FALSE;
        }
        if ($value=='' || preg_match('/^.{3,18}$/', $value) == FALSE) {
            $this->setError('validateUsernameType', _l("The {field} field must be between 3 und 18 characters in length.", $this));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Validation username function (check unique with DB)
     *
     * @param $value
     * @param int $except_user_id
     * @return bool
     */
    public function validateUsername($value, $except_user_id = 0): bool
    {
        if (preg_match('/^[A-Za-z0-9_]*$/', $value) == FALSE) {
            $this->setError('validateUsername', _l("The {field} field must contain just English letters and underline only.", $this));
            return FALSE;
        }
        if ($value=='' || preg_match('/^.{3,18}$/', $value) == FALSE) {
            $this->setError('validateUsername', _l("The {field} field must be between 3 und 18 characters in length.", $this));
            return FALSE;
        }
        if($this->Nodcms_admin_model->checkUserUnique(array('username'=>$value), $except_user_id)){
            $this->setError('validateUsername', _l("The {field} field must be unique in the system.", $this));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Form validation
     *  - unique email
     *
     * @param $value
     * @param int $except_user_id
     * @return bool
     */
    public function emailUnique($value, $except_user_id = 0): bool
    {
        if($this->Public_model->isUnique($value, "users", "email", "user_id", $except_user_id)!=0){
            $this->setError('emailUnique', _l("The {field} field must be unique in the system.", $this));
            return false;
        }else{
            return true;
        }
    }

    /**
     * Validation email unique function
     *
     * @param $value
     * @return bool
     */
    public function validCaptcha(string $value): bool
    {
        if(!isset($_SESSION[$this->captcha_session_name])){
            $this->setError('validCaptcha', _l("Did't set find captcha session.", $this));
            return false;
        }
        if($_SESSION[$this->captcha_session_name]!=$value){
            $this->setError('validCaptcha', _l("The {field} field wasn't correct.", $this));
            return false;
        }
        return true;
    }

    /**
     * Validation field an a table unique function
     *
     * @param $value
     * @param $args
     * @return bool
     */
    public function isUnique($value,string $args): bool
    {
        $args = explode(',', $args);
        $args_count = count($args);
        if($args_count!=2 && $args_count!=4 && $args_count!=5){
            $this->setError('isUnique', _l("Missing some arguments for validation rules.", $this));
            return false;
        }
        $table = $args[0];
        $filed = $args[1];

        $except_field = isset($args[2])?$args[2]:null;
        $except_value = isset($args[3])?$args[3]:null;

        $conditions = isset($args[4])?$args[4]:null;

        if($value=="")
            return true;
        $count = $this->Public_model->isUnique($value,$table,$filed,$except_field, $except_value,$conditions);
        if($count==0){
            return true;
        }
        $this->setError('isUnique', _l("This {field} is already exists.", $this));
        return false;
    }

    public function validURI(string $value): bool
    {
        if($value=="")
            return true;
        if(preg_match('/^[a-z]+[a-z0-9\-\_]*$/', $value) == FALSE){
            $this->setError('validURI', _l("The {field} field must contain just English letters, dash and underline only. The first character must be English letter only.", $this));
            return false;
        }
        return true;
    }

    /**
     * Form validation callback
     *  - Input mask
     *
     * @param $value
     * @param $mask
     * @return bool
     */
    public function validMask($value, string $mask): bool
    {
        if($value=="")
            return true;
        $replacement = array(
            '!'=>'\!',
            '@'=>'\@',
            '#'=>'\#',
            '-'=>'\-',
            '_'=>'\_',
            '$'=>'\$',
            '€'=>'\€',
            '%'=>'\%',
            '^'=>'\^',
            '&'=>'\&',
            '*'=>'\*',
            '('=>'\(',
            ')'=>'\)',
            '/'=>'\/',
            '['=>'\[',
            ']'=>'\]',
            ','=>'\,',
            '.'=>'\.',
            ';'=>'\;',
            ':'=>'\:',
            '9'=>'[0-9]',
        );
        $patter = str_replace(array_keys($replacement),$replacement,$mask);
        if(!preg_match('/^'.$patter.'$/', $value)){
            $this->setError('validMask', _l("The {field} has not contain correct value.", $this));
            return false;
        }
        return true;
    }

    /**
     * Validate a value with multi line email addresses
     *
     * @param $value
     * @return bool
     */
    public function validEmails(string $value): bool
    {
        if($value=="")
            return true;
        if(!preg_match('/^([A-Za-z0-9]+([\_\.\-][A-Za-z0-9]+)*[\@][A-Za-z0-9]+([\_\.\-][A-Za-z0-9]+)*\.[A-Za-z0-9]+)(\n[A-Za-z0-9]+([\_\.\-][A-Za-z0-9]+)*[\@][A-Za-z0-9]+([\_\.\-][A-Za-z0-9]+)*\.[A-Za-z0-9]+)*\n*/', $value)){
            $this->setError('validEmails', _l("The {field} has not contain valid emails.", $this));
            return false;
        }
        return true;
    }

    /**
     * Form validation of currency format (float with the 2 fix)
     *
     * @param $value
     * @return bool
     */
    public function validCurrency(string $value): bool
    {
        if($value=="")
            return true;
        if(!preg_match('/^[0-9]+(\.[0-9]{2})?$/', $value)){
            $this->setError('validCurrency', _l("The {field} has not contain valid currency.", $this));
            return false;
        }
        return true;
    }

    /**
     * Form validations of range of number
     *
     * @param $value
     * @param $args
     * @return bool
     */
    public function validRange($value,string $args): bool
    {
        if($value=="")
            return true;

        $args = explode(',', $args);
        $args_count = count($args);
        if($args_count!=2 ){
            $this->setError('validRange', _l("Missing some arguments for validation rules.", $this));
            return false;
        }
        $min = $args[0];
        $max = $args[1];

        if(!preg_match('/^[0-9]+\-[0-9]+$/', $value)){
            $this->setError('validRange', _l("The {field} has not contain valid number range.", $this));
            return false;
        }

        $numbers = explode('-', $value);
        if($numbers[0]<$min || $numbers[0]>$max){
            $this->setError('validRange', _l("The minimum selected of {field} is out of range.", $this));
            return false;
        }
        if($numbers[1]<$min || $numbers[1]>$max){
            $this->setError('validRange', _l("The maximum selected of {field} is out of range.", $this));
            return false;
        }
        if($numbers[0]>$numbers[1]){
            $this->setError('validRange', _l("The minimum selected of {field} is bigger than minimum.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validation of a range date
     *
     * @param $value
     * @return bool
     */
    public function validRangeDate(string $value): bool
    {
        if($value=="")
            return true;

        if(!preg_match('/^[0-9]{10}000\,[0-9]{10}000$/', $value)){
            $this->setError('validRangeDate', _l("The {field} has not contain valid date range.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validations of a valid currency 3-digit code
     *
     * @param $value
     * @return bool
     */
    public function validCurrencyCode(string $value): bool
    {
        if($value=="")
            return true;

        if(!preg_match('/^[A-Z]{3}$/', $value)){
            $this->setError('validCurrencyCode', _l("The {field} has not contain valid currency code.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validation of a list of numbers
     *
     * @param $value
     * @return bool
     */
    public function validNumberList(string $value): bool
    {
        if($value=="")
            return true;
        // Format validation
        if(!preg_match('/^[1-9][0-9]*(\,[1-9][0-9]*)*$/', $value)){
            $this->setError('validNumberList', _l("The {field} has not contain valid values.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validation of google map iframe
     *
     * @param $value
     * @return bool
     */
    public function validGoogleMapIframe(string $value): bool
    {
        if($value=="")
            return true;
        // Format validation
        if(!preg_match('/^\<iframe\s([\w]+\=\"[^\s]+\"[\s])*src\=\"[^\s]+\"([\s][\w]+\=\"[^\s]+\")*([\s][\w]+)*\>\<\/iframe\>$/', $value)){
            $this->setError('validGoogleMapIframe', _l("The {field} has not contain valid values.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validation of existence a list of numbers in a table of database
     *  - This method is using a Model class to check the values existence
     *  - You should pass two argument in the form validation callback function:
     *      1. Model class: The name of a model class that already loaded
     *      2. Model method: A method of the class that will accept a the $value as text and return a list if finds numbers
     *          just like $value but as an array
     *
     * @param $value
     * @param $args
     * @return bool
     */
    public function validNumberListExists($value, string $args): bool
    {
        if($value=="")
            return true;

        $args = explode(',', $args);
        $args_count = count($args);
        if($args_count!=2 ){
            $this->setError('validNumberListExists', _l("Missing some arguments for 'validNumberListExists' validation rules.", $this));
            return false;
        }
        $model_class = $args[0];
        $model_method = $args[1];

        // Format validation
        if(!preg_match('/^[1-9][0-9]*(\,[1-9][0-9]*)*$/', $value)){
            $this->setError('validNumberListExists', _l("The {field} has not contain valid values.", $this));
            return false;
        }

        $values = explode(',', $value);
        $result = call_user_func_array(array($this->$model_class, $model_method),array($value));
        $array_diff = array_diff($values,$result);
        if(count($array_diff)!=0){
            $this->setError('validNumberListExists', str_replace("{diff}", join(',',$array_diff),_l("The values '{diff}' of {field} are not exists.", $this)));
            return false;
        }

        return true;
    }

    /**
     * Form validation of the Terms & Conditions accept
     *
     * @param $value
     * @return bool
     */
    public function acceptTermsAndConditions(string $value): bool
    {
        if($value!=1){
            $this->setError('acceptTermsAndConditions', _l("Accept the {field} is required.", $this));
            return false;
        }

        return true;
    }

    /**
     * Form validation of making required field if other field is filled
     *
     * @param $value
     * @param $args
     * @return bool
     */
    public function validateRequiredIf($value, string $args): bool
    {
        $args = explode(',', $args);
        $args_count = count($args);
        if($args_count!=2){
            $this->setError('validateRequiredIf', "Missing some arguments for 'validateRequiredIf' validation rules.");
            return false;
        }

        $field = $args[0];
        $field_value = $args[1];

        if(!isset($_POST[$field]) || $_POST[$field] != $field_value || $value!="" || $value!=NULL){
            return true;
        }
        $this->setError('validateRequiredIf', _l("The {field} is required.", $this));
        return false;
    }

    /**
     * Form validations of google invisible reCaptcha
     *
     * @param $value
     * @return bool
     */
    public function validGoogleInvisibleReCaptcha(string $value): bool
    {
        if($value=="")
            return true;

        if(!isset($this->settings["google_captcha_secret_key"]) || $this->settings["google_captcha_secret_key"]==""){
            $this->setError('validGoogleInvisibleReCaptcha', _l("Google captcha secret key has not set.", $this));
            return false;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $post_data = array(
            'secret'=>$this->settings["google_captcha_secret_key"],
            'response'=>$value,
        );

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//        curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0' );

        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';

        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $data = curl_exec( $ch );
        curl_getinfo( $ch,CURLINFO_HTTP_CODE );
        curl_close( $ch );

        $response = json_decode( $data, true );

        // * Check response format
        if(!isset($response['success'])){
            $this->setError('validGoogleInvisibleReCaptcha', _l("Invalid response form google.", $this));
            return false;
        }

        // * Check success status
        if($response['success']==false){
            $message = str_replace("{error_code}",$response['error-codes'],_l("The google response for the reCaptcha was false with the error code: {error_code}.", $this));
            $this->setError('validGoogleInvisibleReCaptcha', $message);
            return false;
        }
        // * Check hostname
        if($response['hostname']!=CONFIG_BASE_URL){
            $search = array('{response_hostname}','{current_hostname}');
            $replace = array($response['hostname'],CONFIG_BASE_URL);
            $message = str_replace($search, $replace,_l("The solve hostname({response_hostname}) shall be equal to {current_hostname}.", $this));
            $this->setError('validGoogleInvisibleReCaptcha', $message);
            return false;
        }

        return true;
    }

    /**
     * Form validation not equal to the value or list
     *
     * @param $value
     * @param $param
     * @return bool
     */
    public function validateNotEqual($value, string $param): bool
    {
        if($value=="" || !in_array($value, explode(',', $param)))
            return true;

        $this->setError('validateNotEqual', _l("The content of {field} is not allowed.", $this));
        return false;
    }

    /**
     * Form validation: check a file path
     *
     * @param $value
     * @param string $param
     * @return bool
     */
    public function validateFileExists($value, $param = "string "): bool
    {
        if($value=="")
            return true;

        if($param != "") {
            $_param = explode(',', $param);
            // Has prefix
            if(count($_param) == 1) {
                if(file_exists($_param[0].$value))
                    return true;
            }

            // Has prefix and postfix
            if(count($_param) == 2) {
                if(file_exists($_param[0].$value.$_param[1]))
                    return true;
            }
            if(count($_param) > 2) {
                $this->setError('validateFileExists', "{field} has incorrect validation inputs.");
                return false;
            }

            $this->setError('validateFileExists', _l("The entered path in {field} is not exists.", $this));
            return false;
        }

        // Check without prefix and postfix
        if(file_exists($value))
            return true;

        $this->setError('validateFileExists', _l("The entered path in {field} is not exists.", $this));
        return false;
    }

    /**
     * Form validation: validate a database name
     *
     * @param $value
     * @return bool
     */
    public function validDatabaseName(string $value): bool
    {
        if (preg_match('/^[A-Za-z0-9_\.\-\@]*$/', $value) == FALSE) {
            $this->setError('validDatabaseName', _l("The {field} field must contain just English letters and underline only.", $this));
            return false;
        }
        return true;
    }

    public function validHostName(string $value): bool
    {
        if (preg_match('/^[A-Za-z0-9_\.\-\@]*$/', $value) == FALSE) {
            $this->setError('validHostName', _l("The {field} field must contain just English letters and underline only.", $this));
            return false;
        }
        return true;
    }
}