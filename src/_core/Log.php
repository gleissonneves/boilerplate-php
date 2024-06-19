<?php

if (!function_exists('dd')) {
  /**
   * Dump the passed variables and end the script.
   *
   * @param  mixed  ...$vars
   * @return void
   */
  function dd(...$vars)
  {
    echo '<style>
      .dd-wrapper {
          background-color: #f0f0f0;
          border: 1px solid #ccc;
          padding: 10px;
          margin: 10px;
          font-family: Arial, sans-serif;
          font-size: 14px;
          color: #333;
          border-radius: 5px;
      }
      .dd-wrapper pre {
          background-color: #2b2b2b;
          color: #42FF20;
          padding: 10px;
          border-radius: 5px;
          overflow: auto;
      }
    </style>';
    echo '<div class="dd-wrapper">';
    foreach ($vars as $var) {
      echo '<pre>';
      var_dump($var);
      echo '</pre>';
    }
    echo '</div>';
    die(1);
  }
}