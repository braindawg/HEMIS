<?php
use Illuminate\Support\Facades\Storage;
use App\Models\Semester;
use App\Models\Setting;

function userPhoto($user, array $atributes = [])
{
	if($user->photo_url and Storage::exists(str_replace("/storage/","public/", $user->photo_url))) {
		$src = url($user->photo_url);
    } else {
    	$src = url("/images/avatar-placeholder.png");
    }
        
   	$attr = "";
   	if ($atributes) {
   		foreach($atributes as $key => $value) {
   			$attr .= $key."='".$value."' ";
   		}
   	}
   	
   	return  "<img src='$src' ".$attr." />";
}

function teamLogo($team = null, array $atributes = [])
{
    return systemLogo($atributes);
}

function systemLogo(array $atributes = [])
{
    $attr = "";
    if ($atributes) {
      foreach($atributes as $key => $value) {
        $attr .= $key."='".$value."' ";
      }
    }
    
    if(Storage::exists("/public/".config('client')."/logo.jpg")) {
      $src = asset("/storage/".config('client')."/logo.jpg");
    } else {
      $src = asset("/images/logo-placeholder.jpg");
    }
      
    return  "<img src='$src' ".$attr." />"; 
}

function teamName($team = null)
{
    return systemName();
}

function systemName()
{
    $setting = Setting::allTeams()->where(['team_id' => 0, 'key' => 'system_name'])->first();
    
    return $setting ? $setting->value : null;
}

function defaultSemesterId()
{
     $semester = Semester::where('default', 1)->first();

     return $semester ? $semester->id : NULL;
}

function defaultSemesterTitle()
{
     $semester = Semester::where('default', 1)->first();

     return $semester ? $semester->title : NULL;
}

function currentTeamId()
{
     return auth()->user()->current_team_id;
}

function valueOf($key, $teamId = null)
{
    if ($teamId) {
        $setting = Setting::allTeams()->where(['team_id' => $teamId, 'key' => $key])->first();
        return $setting ? $setting->value : null;
    }

    return Setting::value($key);
}

function convertJalaliToMiladi($date ,$miladiFormat = 'Y-m-d H:i:s')
{
    $date = explode("/", $date);
    
    if (isset($date[0]) and isset($date[1]) and isset($date[2])) {
        return date($miladiFormat, jDateTime::mktime(0, 0, 0, $date[1], $date[2], $date[0], true, 'Asia/Kabul'));
    } else {
        return '';
    }
    
}

function jalaliStrtotime($input = null)
{
    if (! $input)
       return;

    $date = explode("/", $input);                     
    return jDateTime::mktime(0, 0, 0, $date[1], $date[2], $date[0]);
}

function jalaliDate($format = 'Y/m/j', $time = null, $persianNumber = false)
{
    $time = $time ? $time : time();
    return jDateTime::date($format, $time, $persianNumber);
}

function weekDays()
{
  return [
      'sa' => trans('general.sa'),
      'su' => trans('general.su'),
      'mo' => trans('general.mo'),
      'tu' => trans('general.tu'),
      'we' => trans('general.we'),
      'th' => trans('general.th'),
      'fr' => trans('general.fr'),
  ];
}

function getGrades()
{
   return  [
            'bachelor' => trans('general.bachelor'),
            'masters' => trans('general.masters')
        ];
}

function getLastActivity($user = null)
{
    $user = $user ? $user : auth()->user();

    $lastActivity = $user->activity->last();

    return $lastActivity ? jalaliDate('Y/n/j H:i', strtotime($lastActivity->created_at)) : trans('general.no_activity');
}

function getStringBetween($string, $start, $end) //used to parse pdf files config
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


function convertNumberToFarsi($number) 
{
    if (is_float($number)) {
        $no = explode('.', $number);

        if (isset($no[0]) and isset($no[1])) {
            return convertNumberToFarsi($no[0])." اعشاری ".convertNumberToFarsi($no[1]);    
        }        
    }   

    $ones = array("", "یک",'دو&nbsp;', "سه", "چهار", "پنج", "شش", "هفت", "هشت", "نه", "ده", "یازده", "دوازده", "سیزده", "چهارده", "پانزده", "شانزده", "هفده", "هجده", "نونزده");
    $tens = array("", "", "بیست", "سی", "چهل", "پنجاه", "شصت", "هفتاد", "هشتاد", "نود");
    $tows = array("", "صد", "دویست", "سیصد", "چهار صد", "پانصد", "ششصد", "هفتصد", "هشت صد", "نه صد");

    if (($number < 0) || ($number > 999999999)) {
        throw new Exception("Number is out of range");
    }
    $Gn = floor($number / 1000000);
    /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000);
    /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);
    /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);
    /* Tens (deca) */
    $n = $number % 10;
    /* Ones */
    $res = "";
    if ($Gn) {
        $res .= convertNumberToFarsi($Gn) .  " میلیون و ";
    }
    if ($kn) {
        $res .= (empty($res) ? "" : " ") .convertNumberToFarsi($kn) . " هزار و";
    }
    if ($Hn) {
        $res .= (empty($res) ? "" : " ") . $tows[$Hn] . " و ";
    }
    if ($Dn || $n) {
        if (!empty($res)) {
            $res .= "";
        }
        if ($Dn < 2) {
            $res .= $ones[$Dn * 10 + $n];
        } else {
            $res .= $tens[$Dn];
            if ($n) {
                $res .= " و " . $ones[$n];
            }
        }
    }
    if (empty($res)) {
        $res = "صفر";
    }
    $res=rtrim($res," و");
    return $res;
}


