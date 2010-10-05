<?php

function link_to_cas_login ($label)
{
  return link_to ($label, url_for_cas_login ());
}

function url_for_cas_login ($url = null)
{
  if ($url === null)
    $url = sfContext::getInstance()->getRequest()->getUri();
  
  $casUrl = 'https://'.
    sfConfig::get ('app_cas_server_host', 'localhost').':'.
    sfConfig::get ('app_cas_server_port', 443).'/'.
    sfConfig::get ('app_cas_server_path', '').
    'login?service='.urlencode ($url);
}
