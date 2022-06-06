<?php

function dateFormat($date)
{
   return date('Y-m-d H:i:s',strtotime($date));
}