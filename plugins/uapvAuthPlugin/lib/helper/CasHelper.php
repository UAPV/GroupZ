<?php

function link_to_cas_login ($label)
{
  return link_to ($label, url_for_cas_login ());
}

function url_for_cas_login ($url = null)
{
  if ($url === null)
    $url = sfContext::getInstance()->getRequest()->getUri();
  
  $casUrl[] = 'https://'.sfConfig::get ('app_cas_server_host', 'localhost').':'.sfConfig::get ('app_cas_server_port', 443);

  if (strlen (sfConfig::get ('app_cas_server_path', '')) > 0)
    $casUrl[] = trim (sfConfig::get ('app_cas_server_path', ''), '/');

  $casUrl[] = 'login?service='.urlencode ($url);

  return implode ('/', $casUrl);
}

function detect_cas_session ()
{
  $iframeUrl = url_for('uapvAuthCAS/detect');

  return <<<HTML

<script type="text/javascript">
function uapvAuthCASSessionDetected ()
{
  alert ('CAS Detected');
}</script><iframe src="$iframeUrl" width="1px" height="1px" style="visibility: hidden;"></iframe>
HTML
    ;
}