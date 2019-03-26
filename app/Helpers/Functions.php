<?php

function tr_num($str,$mod='en'){
    $num_a=array('0','1','2','3','4','5','6','7','8','9');
    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
    return ($mod=='en') ? str_replace($key_a,$num_a,$str) : str_replace($num_a,$key_a,$str);
}
function getLocale()
{
    if(session()->has('locale'))
        return session('locale');
    return config('app.locale');
}