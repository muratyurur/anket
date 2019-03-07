<?php

function convertToSEO($deger)
{
    $turkce = array("ş", "Ş", "ı", "(", ")", "'", "&#39;", " - ", "ü", "Ü", "ö", "Ö", "ç", "Ç", "!", " ", "/", "*", "?", "ş", "Ş", "ı", "ğ", "Ğ", "İ", "ö", "Ö", "Ç", "ç", "ü", "Ü");
    $duzgun = array("s", "s", "i", "", "", "-", "-", "-", "u", "u", "o", "o", "c", "c", "", "-", "-", "-", "", "s", "s", "i", "g", "g", "i", "o", "o", "c", "c", "u", "u");
    $deger = str_replace($turkce, $duzgun, trim($deger));
    $deger = preg_replace("@[^a-z0-9\-_]+@i", "", $deger);
    return mb_convert_case($deger, MB_CASE_LOWER);
}

function get_readable_date($date)
{
    setlocale(LC_ALL, "tr_TR.UTF-8");
    return strftime('%d.%m.%Y %H:%M:%S', strtotime($date));
}

function change_date_format_for_db($date)
{
    setlocale(LC_ALL, "tr_TR.UTF-8");
    return strftime('%Y-%d-%m', strtotime($date));
}

function get_readable_onlydate($date)
{
    setlocale(LC_ALL, "tr_TR.UTF-8");
    return strftime('%d/%m/%Y', strtotime($date));
}

function get_readable_fulldate($date)
{
    setlocale(LC_ALL, "tr_TR.UTF-8");
    return strftime('%d/%m/%Y %A', strtotime($date));
}

function rrmdir($src)
{
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $full = $src . '/' . $file;
            if (is_dir($full)) {
                rrmdir($full);
            } else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);

    return true;
}

function get_active_user()
{
    $t = &get_instance();

    $user = $t->session->userdata("user");

    if ($user)
        return $user;
    else
        return false;
}

function get_person_name($id)
{
    $t = &get_instance();

    $t->load->model("secmen_model");

    $person = $t->secmen_model->get_person(
        array(
            "id" => $id
        )
    );

    return ($person->Kisi);
}

function get_streetname($id)
{
    $t = &get_instance();

    $t->load->model("sokak_model");

    $street = $t->sokak_model->get(
        array(
            "id"    => $id
        )
    );

    return ($street->tanim);
}

function get_teamName($id)
{
    $t = &get_instance();

    $t->load->model("ekip_model");

    $team = $t->ekip_model->get(
        array(
            "id"    => $id
        )
    );

    return ($team->tanim);
}

function get_departmentName($id)
{
    $t = &get_instance();

    $t->load->model("mudurluk_model");

    $department = $t->mudurluk_model->get(
        array(
            "id"    => $id
        )
    );

    return ($department->tanim);
}

function get_secmenName($id)
{
    $t = &get_instance();

    $t->load->model("secmen_model");

    $secmen = $t->secmen_model->get(
        array(
            "id"    => $id
        )
    );

    return ($secmen->adi . " " . $secmen->soyadi);
}

function sourcename($id)
{
    $t = &get_instance();

    $t->load->model("talep_kaynak_model");

    $source = $t->talep_kaynak_model->get(
        array(
            "id"    => $id
        )
    );

    return ($source->title);
}

function get_townname($id)
{
    $t = &get_instance();

    $t->load->model("mahalle_model");

    $town = $t->mahalle_model->get(
        array(
            "id"    => $id
        )
    );

    return ($town->tanim);
}

function get_username($id)
{
    $t = &get_instance();

    $t->load->model("user_model");

    $user = $t->user_model->get(
        array(
            "id" => $id
        )
    );

    return ($user->full_name);
}

function get_speaker($id)
{
    $t = &get_instance();

    $t->load->model("hatip_model");

    $speaker= $t->hatip_model->get(
        array(
            "id" => $id
        )
    );

    return ($speaker->adisoyadi);
}

function get_statement($id)
{
    $t = &get_instance();

    $t->load->model("talep_durumu_model");

    $statement = $t->talep_durumu_model->get(
        array(
            "id" => $id
        )
    );

    return ($statement->title);
}

function get_userRoleName($id)
{
    $t = &get_instance();

    $t->load->model("user_role_model");

    $department = $t->user_role_model->get(
        array(
            "id" => $id,
            "isActive" => 1
        )
    );

    return ($department->title);
}

function get_statementName($durum)
{
    if ($durum === 'G') {
        $durumName = "Görüşüldü";
        return ($durumName);
    } else if ($durum === 'B') {
        $durumName = "Evde Bulunamadı";
        return ($durumName);
    } else if ($durum === 'R') {
        $durumName = "Görüşmeyi Reddetti";
        return ($durumName);
    } else if ($durum === "A") {
        $durumName = "Adres Bulunamadı";
        return ($durumName);
     }else if ($durum === NULL || $durum === '') {
        $durumName = "Henüz Görüşülmedi";
        return ($durumName);
    }
}

function get_tuzlakartStatementName($durum)
{
    if ($durum === 'E') {
        $durumName = "Teslim Edildi";
        return ($durumName);
    } else if ($durum === 'B') {
        $durumName = "Evde Bulunamadı";
        return ($durumName);
    } else if ($durum === 'A') {
        $durumName = "Adres Bulunamadı";
        return ($durumName);
    } else if ($durum === 'T') {
        $durumName = "Belediyede Teslim Edildi";
        return ($durumName);
    } else if ($durum === "H") {
        $durumName = "Teslim Edilemedi";
        return ($durumName);
    }else if ($durum === NULL || $durum === '') {
        $durumName = "Henüz Görüşülmedi";
        return ($durumName);
    }
}

function get_statementIcon($durum)
{
    if ($durum === 'G') {
        $durumIcon = "fa fa-check";
        return ($durumIcon);
    } else if ($durum === 'B' || $durum === 'A') {
        $durumIcon = "fa fa-times";
        return ($durumIcon);
    } else if ($durum === 'R') {
        $durumIcon = "fa fa-ban";
        return ($durumIcon);
    } else if ($durum === NULL || $durum === '') {
        $durumIcon = "fa fa-clock-o";
        return ($durumIcon);
    }
}

function get_statementColor($durum)
{
    if ($durum === 'G') {
        $durumColor = "#00C568";
        return ($durumColor);
    } else if ($durum === 'B' || $durum === 'A') {
        $durumColor = "#FFC54E";
        return ($durumColor);
    } else if ($durum === 'R') {
        $durumColor = "#FF515A";
        return ($durumColor);
    } else if ($durum === NULL || $durum === '') {
        $durumColor = "#00B9E0";
        return ($durumColor);
    }
}

function get_opinionName($durum)
{
    if ($durum === 'E') {
        $durumName = "Olumlu";
        return ($durumName);
    } else if ($durum === 'H') {
        $durumName = "Olumsuz";
        return ($durumName);
    } else if ($durum === 'K') {
        $durumName = "Kararsız";
        return ($durumName);
    } else if ($durum === 'N') {
        $durumName = "Küskün";
        return ($durumName);
    } else if ($durum === NULL || $durum === '') {
        $durumName = "Henüz Görüşülmedi";
        return ($durumName);
    }
}

function get_opinionIcon($durum)
{
    if ($durum === 'E') {
        $durumIcon = "fa fa-smile-o";
        return ($durumIcon);
    } else if ($durum === 'H') {
        $durumIcon = "fa fa-frown-o";
        return ($durumIcon);
    } else if ($durum === 'K') {
        $durumIcon = "fa fa-meh-o";
        return ($durumIcon);
    } else if ($durum === 'N') {
        $durumIcon = "fa fa-thumbs-o-down";
        return ($durumIcon);
    } else if ($durum === NULL || $durum === '') {
        $durumIcon = "fa fa-clock-o";
        return ($durumIcon);
    }
}

function get_opinionColor($durum)
{
    if ($durum === 'E') {
        $durumColor = "#00C568";
        return ($durumColor);
    } else if ($durum === 'H') {
        $durumColor = "#FFC54E";
        return ($durumColor);
    } else if ($durum === 'K') {
        $durumColor = "#FF515A";
        return ($durumColor);
    } else if ($durum === 'N') {
        $durumColor = "#FF515A";
        return ($durumColor);
    } else if ($durum === NULL || $durum === '') {
        $durumColor = "#00B9E0";
        return ($durumColor);
    }
}

function send_email($toEmail = "", $subject = "", $message = "")
{
    $t = get_instance();

    $t->load->model("email_model");

    $email_settings = $t->email_model->get(
        array(
            "isActive" => 1
        )
    );

    $config = array(
        "protocol" => $email_settings->protocol,
        "smtp_host" => $email_settings->host,
        "smtp_port" => $email_settings->port,
        "smtp_user" => $email_settings->user,
        "smtp_pass" => $email_settings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n",
    );

    $t->load->library("email", $config);

    $t->email->from($email_settings->from, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();
}

?>