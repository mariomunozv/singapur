<?php

require_once 'lib/limonade.php';
dispatch('/', 'hello');
    function hello()
    {
        return 'Hello world!';
    }
dispatch('/hello/:who', 'hello2');
  function hello2()
  {
    set_or_default('name', params('who'), "everybody");
    return 'Hello ooooo!';
  }
run();
