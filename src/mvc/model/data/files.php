<?php
/*
 * Describe what it does!
 *
 **/

/** @var $this \bbn\mvc\model*/
if ( isset($model->data['data_path']) ){
  clearstatcache();
  $has_active = is_file($model->inc->cron->get_status_path('active'));
  $has_cron = is_file($model->inc->cron->get_status_path('cron'));
  $has_poll = is_file($model->inc->cron->get_status_path('poll'));
  $crontime = false;
  $cronid = false;
  $polltime = false;
  $pollid = false;
  if ( $has_cron &&is_file($model->inc->cron->get_pid_path(['type' => 'cron'])) ){
    $tmp = explode('|', file_get_contents($model->inc->cron->get_pid_path(['type' => 'cron'])));
    [$cronid, $crontime] = $tmp;
  }
  if ( $has_poll && is_file($model->inc->cron->get_pid_path(['type' => 'poll'])) ){
    $tmp = explode('|', file_get_contents($model->inc->cron->get_pid_path(['type' => 'poll'])));
    [$pollid, $polltime] = $tmp;
  }
  return [
    'active' => $has_active,
    'cron' => $has_cron,
    'poll' => $has_poll,
    'cronid' => $cronid,
    'crontime' => $crontime,
    'polltime' => $polltime,
    'pollid' => $pollid
  ];
}
return ['success' => false];