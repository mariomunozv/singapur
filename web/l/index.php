<?php

require_once 'lib/limonade.php';

function configure()
{
  option('base_uri', '/app');
}

dispatch('/', 'hello');
    function hello()
    {
        return 'Hello world!';
    }

dispatch('/hello/', 'hello2');
  function hello2()
  {
    return 'Hello ooooo!';
  }
run();
