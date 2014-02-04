<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Olaoye Adeyemi for Zeko Team
 * Date: 7/29/13
 * Time: 2:05 PM
 * To change this template use File | Settings | File Templates.
 */


// The Util class contains all the utility functions used in this project
// Feel free to use and add more functions as needed
// Signed : Olaoye Adeyemi
class Util
{
    /**
     * encrypt password in $_REQUEST
     */
    static function encryptRequestPassword()
    {
        $arr = str_split(sha1($_REQUEST[User_Auth::PASSWORD]), 5);
        $new = array();
        $last = count($arr) - 1;
        $new[] = $arr[3];
        for ($i = $last; $i >= 0; --$i) {
            $new[] = $arr[$i];
        }
        $new[] = $arr[6];
        $_REQUEST[User_Auth::PASSWORD] = join('', $new);
    }

    /**
     * @param $params
     * @return bool
     * check if the parameters contained in the array params are set in $_REQUEST
     */
    static function isRequestParamsSet($params)
    {
        if (count($params) > count($_REQUEST)) {
            return false;
        }
        for ($i = 0; $i < count($params); $i++) {
            if ($_REQUEST[$params[$i]] == "") {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $placeholders
     * @return array
     * strips the parameters corresponding to values in $placeholders in $_REQUEST
     */
    static function stripRequestParams($placeholders)
    {
        $params = array();
        for ($i = 0; $i < count($placeholders); $i++) {
            $params[$i] = $_REQUEST[$placeholders[$i]];
        }
        return $params;
    }

    /**
     * @param $response
     * @param bool $status
     * returns a status, response or error message as applicable in json
     */
    static function returnResponse($response, $status = true)
    {
        $result = array();
        $result["status"] = $status;
        $result[$status ? "response" : "error_message"] = $response;
        echo(json_encode($result));

    }

    static function returnStatus($status)
    {
        $result = array();
        $result['status'] = $status;
        echo(json_encode($result));
    }

    /**
     * @param $error
     * logs Errors into a file
     */
    static function logError($error)
    {

        file_put_contents('./logs/pdo_errors.txt', DATE('H:i:s, D, d M Y') . ' >>>> ' . $error . "\n", FILE_APPEND);
        exit();
    }

    /**
     * @param $data
     * @return mixed
     * splits a CSV into an array
     */
    static function splitCSV($data)
    {
        preg_match_all("/[0-9|A-Z|a-z|.]+/", $data, $result);
        $arr = $result[0];
        return ($arr > 1) ? $arr : $arr[0];

    }

    /**
     * @param $item
     * @param $key
     * @param $column
     * @return boolean
     * convert a boolean value [0,1]  in an array to [false, true]
     */
    static function convertToBoolean(&$item, $key, $column)
    {
        $item[$column] = ($item[$column] == 0) ? false : true;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     * compares two arrays a and b and sorts them with respect to 'modified_time'
     */
    static function cmp($a, $b)
    {
        return strtotime($a['modified_time']) < strtotime($b['modified_time']) ? 1 : -1;
    }

    /**
     * @param $username
     * @return bool
     * ensures that the username matches the acceptable convention
     */
    static function validateUsername($username)
    {
        preg_match_all("/[0-9|A-Z|a-z|_|-|.]+/", $username, $result);
        return (count($result[0]) > 0) ? true : false;


    }

    /**
     * @param $length
     * @return string
     * generates a random string of length corresponding to $length
     */
    static function random_string_($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < ($length / 2); $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;

    }

    static function random_string($length)
    {
        $str = Util::encryptPassword(Util::getCurrentDateTime());
        return substr($str, 0, $length);
    }

    /**
     * @param $password
     * @return string
     * encrypts a password using sha1 encryption scheme
     * also uses an extra method to implement the encryption
     * needs to be upgraded to sha2
     */
    static function encryptPassword($password)
    {
        $arr = str_split(sha1($password), 5);
        $new = array();
        $last = count($arr) - 1;
        $new[] = $arr[3];
        for ($i = $last; $i >= 0; --$i) {
            $new[] = $arr[$i];
        }
        $new[] = $arr[6];
        return join('', $new);

    }

    public static function getCurrentDateTime()
    {
        $curr_date = date('Y-m-d H:i:s');
        return $curr_date;
    }

    /**
     * @param $filepath
     * @return string
     * gets the mime type of file in the specified path
     */
    static function getMimeType($filepath)
    {
        if (!preg_match('/\.[^\/\\\\]+$/', $filepath)) {
            mime_content_type($filepath);
        }
        switch (strtolower(preg_replace('/^.*\./', '', $filepath))) {
            // START MS Office 2007 Docs
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            case 'docm':
                return 'application/vnd.ms-word.document.macroEnabled.12';
            case 'dotx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
            case 'dotm':
                return 'application/vnd.ms-word.template.macroEnabled.12';
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            case 'xlsm':
                return 'application/vnd.ms-excel.sheet.macroEnabled.12';
            case 'xltx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
            case 'xltm':
                return 'application/vnd.ms-excel.template.macroEnabled.12';
            case 'xlsb':
                return 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
            case 'xlam':
                return 'application/vnd.ms-excel.addin.macroEnabled.12';
            case 'pptx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
            case 'pptm':
                return 'application/vnd.ms-powerpoint.presentation.macroEnabled.12';
            case 'ppsx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
            case 'ppsm':
                return 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12';
            case 'potx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.template';
            case 'potm':
                return 'application/vnd.ms-powerpoint.template.macroEnabled.12';
            case 'ppam':
                return 'application/vnd.ms-powerpoint.addin.macroEnabled.12';
            case 'sldx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.slide';
            case 'sldm':
                return 'application/vnd.ms-powerpoint.slide.macroEnabled.12';
            case 'one':
                return 'application/msonenote';
            case 'onetoc2':
                return 'application/msonenote';
            case 'onetmp':
                return 'application/msonenote';
            case 'onepkg':
                return 'application/msonenote';
            case 'thmx':
                return 'application/vnd.ms-officetheme';
            //END MS Office 2007 Docs

        }
        return mime_content_type($filepath);
    }

    /**
     * @param $datetime
     * @return string
     * returns the relative time corresponding to the given time
     */
    public static function prettyRelativeTime($datetime)
    {
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
//        $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

        $curr_date = date('Y-m-d H:i:s');
        $curr_date = date_parse($curr_date);
        $datetime = date_parse($datetime);


        $curr_year = $curr_date['year'];
        $curr_month = $curr_date['month'];
        $curr_day = $curr_date['day'];
        $curr_hour = $curr_date['hour'];
        $curr_minute = $curr_date['minute'];
        $curr_seconds = $curr_date['second'];
        $year = $datetime['year'];
        $month = $datetime['month'];
        $day = $datetime['day'];
        $hour = $datetime['hour'];
        $minute = $datetime['minute'];
        $seconds = $datetime['second'];

        if ($curr_year == $year) {
            if ($curr_month == $month) {
                if ($curr_day == $day) {
                    if ($curr_hour == $hour) {
                        if ($curr_minute == $minute) {
                            if ($curr_seconds == $seconds) {
                                return "Just now";
                            } else {
                                if ($curr_seconds > $seconds) {
                                    $diff = $curr_seconds - $seconds;
                                    return ($diff > 1) ? "$diff seconds ago" : "A second ago";
                                } else {
                                    $diff = $seconds - $curr_seconds;
                                    return ($diff > 1) ? "$diff seconds from now" : "A second from now";
                                }
                            }
                        } else {
                            if ($curr_minute > $minute) {
                                $diff = $curr_minute - $minute;
                                return ($diff > 1) ? "$diff minutes ago" : "A minute ago";
                            } else {
                                $diff = $minute - $curr_minute;
                                return ($diff > 1) ? "$diff minutes from now" : "A minute from now";
                            }
                        }
                    } else {
                        if ($hour > 12) {
                            return "Today at " . ($hour - 12) . ":" . $minute . "pm";
                        } else {
                            return "Today at " . $hour . ":" . $minute . "am";
                        }
                    }
                } else {
                    $diff = ($curr_day > $day) ? $curr_day - $day : $day - $curr_day;

                    if ($diff < 7) {
                        return ($diff == 1) ? ("yesterday at " . (($hour > 12) ? ($hour - 12) . ":" . $minute . "pm" : $hour . ":" . $minute . "am")) : "$diff days ago";
                    } else {
                        $month = $months[$month - 1];
                        return $month . " " . $day;
                    }
                }
            } else {
                $month = $months[$month - 1];
                return $month . " " . $day;
            }
        } else {
            if ($curr_year > $year) {
                $diff = $curr_year - $year;
                return ($diff > 1) ? "$diff years ago" : "A year ago";
            } else {
                $diff = $year - $curr_year;
                return ($diff > 1) ? "$diff years from now" : "A year from now";
            }
        }
    }

    /**
     * @param $date
     * @return string
     * returns date in a formal format
     * e.g Wednesday, Oct 1 at 6:20am
     */
    static function prettyDate($date)
    {

        //$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
        $datetime = date_parse($date);

        $year = $datetime['year'];
        $month = $datetime['month'];
        $day = $datetime['day'];
        $hour = $datetime['hour'];
        $minute = $datetime['minute'];
        $seconds = $datetime['second'];

        if ($month != 0) {
            date_default_timezone_set('UTC');
            $minute = $minute < 10 ? "0" . $minute : $minute;
            $hour = $hour < 10 ? "0" . $hour : $hour;
            $timeOfDay = ($hour > 12) ? "PM" : "AM";
            $hour = ($hour > 12) ? $hour - 12 : $hour;
            $result = $day . " " . $months[$month - 1] . " $year ";
            return $result;
        } else {
            return $date;
        }

    }

    /**
     * @param $number
     * @return string
     * returns a number with it's ordinal suffix
     */
    static function ordSuffix($number)
    {
        $str = "$number";
        $t = $number > 9 ? substr($str, -2, 1) : 0;
        $u = substr($str, -1);
        if ($t == 1) return $str . 'th';
        else switch ($u) {
            case 1:
                return $str . 'st';
            case 2:
                return $str . 'nd';
            case 3:
                return $str . 'rd';
            default:
                return $str . 'th';
        }
    }

    //checks if the latitude and longitude falls within a specified bound

    public static function verifyLatLong($lat, $long)
    {
        //bound is nigeria
        $top = 13.36;
        $bottom = 4.31;
        $left = 2.40;
        $right = 14.67;

        if ($top > $lat && $lat > $bottom && $long > $left && $long < $right) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendMail($message, $address, $name)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "yemexx1@gmail.com";
        $mail->Password = "0Olamide0";
        $mail->SetFrom('admin@efficacy.com', 'Efficacy');
        $mail->AddReplyTo("admin@efficacy.com", "Efficacy");
        $mail->Subject = "Efficacy Registration";
        $mail->AddAddress($address, $name);
        $mail->MsgHTML($message);
//        if (
//        !
        $mail->Send();
//        ) {
//            echo "Mailer Error: " . $mail->ErrorInfo;
//        } else {
//            echo "Message sent!";
//        }
    }

    /**
     * @param $date
     * @param $interval
     * @return string
     * Add or subtract from a date's year
     */
    public static function incrementYear($date, $interval)
    {
        $date = new DateTime($date);
        if ($interval >= 0) {
            $date->add(new DateInterval('P' . $interval . 'Y'));
        } else {
            $date->sub(new DateInterval('P' . $interval * -1 . 'Y'));
        }
        return $date->format('Y-m-d H:i:s');
    }

    public static function checkImageSize($image_filename, $min_height, $min_width)
    {
        $img_info = getimagesize($image_filename);
        $height = $img_info[1];
        $width = $img_info[0];
        if ($min_height > $height || $min_width > $width) {
            return false;
        }
        return true;
    }

    public static function sendSMS($sender, $to, $msg)
    {
//        $url = sprintf('http://smsc.xwireless.net/API/WebSMS/Http/v3.0/?method=compose&username=%s&password=%s&sender=%s&to=%s&message=%s&international=1&format=json', urlencode('oregroup'), urlencode('20142495'), urlencode($sender), urlencode($to), urlencode($msg));

        $url = sprintf('http://bestlinksms.com/components/com_smsreseller/smsapi.php?username=oregroup&password=20142495&sender=%s&recipient=%s&message=%s', urlencode($sender), urlencode($to), urlencode($msg));

        $data = @file_get_contents($url);
        if (strpos($data, "OK")) {
            return true;
        } else {
            return false;
        }

    }

    public static function validateFacebookProfileUrl($url)
    {
        Requests::register_autoloader();
        $request = Requests::get($url);
        if (strpos(strtolower($url), "facebook.com") == false || filter_var($url, FILTER_VALIDATE_URL) == false) {
            return false;
        }
        if ($request->status_code == 200) {
            return true;
        } else {
            return false;
        }

    }


}