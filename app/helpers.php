<?php

use Carbon\Carbon;
use App\models\Notification;
use App\models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (! function_exists('page_title'))
{
    function page_title($title)
    {
        $baseTitle = config('app.name');

        return empty($title) ? $baseTitle : $title . ' | ' .$baseTitle;
    }
}

if (! function_exists('set_active_route'))
{
    function set_active_route($route)
    {
        //index.dec
        $name = Route::currentRouteName();

        $base = strstr($name, '.', true) ?: $name;

        return  $route == $base ? 'active' : '';

    }
}



if (! function_exists('set_valid_form'))
{
    function set_valid_form($field, $old)
    {
        if ($field)
        {
            return 'is-invalid';
        }
        elseif ($old) {

            return 'is-valid';
        }

    }
}

if (!function_exists('msg_flash'))
    {
        function msg_flash($message, $type = "info")
            {
                session()->flash('msg_flash', $message);
                session()->flash('msg_type', $type);

            }
    }


if (!function_exists('set_status_badge'))
{
function set_status_badge($status)
    {
       switch ($status) {

            case 'In process':
                return "info";
            break;

            case 'Pending':
                return "warning";
            break;


           default:
                return "success";
            break;
       }

    }
}


if (!function_exists('set_correct_translate_status'))
{
function set_correct_translate_status($status)
    {
       switch ($status) {

            case 'In process':
                return "En Cours";
            break;

            case 'Pending':
                return "En attente";
            break;

            case 'Finished':
                return "Terminé";
            break;


           default:
                return "";
            break;
       }

    }
}


if (!function_exists('set_correct_translate_type'))
{
function set_correct_translate_type($type)
    {
       switch ($type) {

            case 'Professionnal':
                return "Professionnel";
            break;

            case 'Personal':
                return "Personnel";
            break;

            case 'TP':
                return "TP";
            break;

            case 'Video':
                return "Video";
            break;

            case 'Audio':
                return "Audio";
            break;

            case 'PDF':
                return "PDF";
            break;

            case 'Online':
                return "En ligne";
            break;

            case 'Language':
                return "Langage";
            break;

            case 'Software':
                return "Logiciel";
            break;

            case 'Framework':
                return "Framework";
            break;

            case 'Other':
                return "Autre";
            break;

            case 'other':
                return "Autre";
            break;


           default:
                return "";
            break;
       }

    }
}


if (!function_exists('set_correct_translate_category'))
{
function set_correct_translate_category($category)
    {
       switch ($category) {

            case 'Software':
                return "Logiciel";
            break;

            case 'Website':
                return "Site web";
            break;

            case 'Web app':
                return "Application web";
            break;

            case 'Mobile app':
                return "Application mobile";
            break;

            case 'Other':
                return "Autre";
            break;


           default:
                return "";
            break;
       }

    }
}

if (!function_exists('set_status'))
{
function set_status($status)
    {
       switch ($status) {

            case 'In process':
                $badge = "info";
                $text = "En cours";
                return "<span class='badge badge-". $badge ."'>". $text ."</span>";
            break;

            case 'Pending':
                $badge = "warning";
                $text = "En attente";
                return "<span class='badge badge-". $badge ."'>". $text ."</span>";
            break;


           default:
                $badge = "success";
                $text = "Terminé";
                return "<span class='badge badge-". $badge ."'>". $text ."</span>";
            break;
       }

    }
}


if (!function_exists('set_user_profil_picture'))
{
    function set_user_profil_picture($picture)
        {

            $url = Storage::url($picture);
            
            if ($picture == "user.jpg") 
            {
                return asset(config('app.profil_picture_path'))."/".Auth::user()->picture;
            }
            else {
                return $url;
            }
            

        }
}


if (!function_exists('set_progress_level'))
{
    function set_progress_level($level)
        {
            if ($level >= 0 && $level < 25)
            {
                return 'danger';
            }

            if ($level >= 25  && $level < 50)
            {
                return 'warning';
            }

            if ($level >= 50  && $level < 75)
            {
                return 'info';
            }

            if ($level >= 75)
            {
                return 'success';
            }
        }
}


if (!function_exists('days_remaining'))
{
    function days_remaining($date)
        {
            if ($date != '')
            {
               $now = Carbon::now();
               $days = $now->floatDiffInRealDays($date);
               $days = round($days);

               if ($now->lessThanOrEqualTo($date))
               {
                   if ($days == 0)
                   {
                        return '<b class="text-warning">Dernier jour</b>';
                   }else{
                       return '<b class="text-success">'.$days.'</b>';
                   }
               }else{
                   return '<b class="text-danger"> Delai expiré</b>';
               }

            } else {

                return '';
            }

            //dd($days->lessThanOrEqualTo($now));
        }
}


if (!function_exists('set_progression'))
{
    function set_progression($end, $total)
        {
            $total = $total != 0 ? $total : 1;

            $resultat = ($end*100)  / $total;

            if ($total =! 0)
            {
                return round($resultat, 2); // Arrondi la valeur
            }
            else {
                return 0;
            }

        }
}




if (!function_exists('set_correct_select'))
{
function set_correct_select($type, $value)
    {
        if ($type == $value)
        {
            return 'selected';
        }
    }
}



if (!function_exists('set_correct_icon'))
{
function set_correct_icon($item)
    {
        switch ($item) {
            case 'remind':
                    return 'clock';
                break;

            case 'message':
                    return 'envelope';
                break;

            case 'other':
                    return 'bell';
                break;

            default:
            return '';
                break;
        }
    }
}


if (!function_exists('set_new_notification'))
{
function set_new_notification($id)
    {
        $noti = Notification::where('id', $id)->first();

        if ($noti->read == 0)
        {
            $noti->update(['read' => '1']);
            return "<span class='badge badge-danger'>Nouveau</span>";
        }
    }
}



if (!function_exists('get_new_notification'))
{
function get_new_notification()
    {
        $notis = Notification::where('user_id', Auth::user()->id)->where('read', '0')->get();

        return $notis;
    }
}

if (!function_exists('notification'))
{
function notification($name, $type, $message, $link = null)
    {
        $id = Auth::user()->id;
        Notification::create([
            'user_id' => $id,
            'name' => $name,
            'type' => $type,
            'message' => $message,
            'link' => $link,
        ]);
    }
}

if (!function_exists('set_setting'))
{
function set_setting()
    {
        Setting::create([
            'user_id' => Auth::user()->id,
        ]);
    }
}

if (!function_exists('alert_confirm'))
{
function alert_confirm($form)
    {
        return "event.preventDefault();
        Swal.fire({
            title: 'Etes-vous sûre?',
            text: 'Cette action est irreversible',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Supprimer'
          }).then((result) => {
            if (result.value) {
                document.getElementById('$form').submit();
            }
          });";
    }
}



