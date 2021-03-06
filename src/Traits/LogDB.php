<?php
/**
 * LogDB.php
 * Created by @rn on 1/3/2017 4:19 PM.
 */

namespace App\Components\LogDB\Traits;


trait LogDB
{
    /**
     * @param        $type
     * @param string $message
     * @param array  $param
     */
    protected function fireLog($type, $message = '', array $param = [])
    {
        switch ($type) {
            case 'emergencyOrError':
                $this->logEmergency($message, $param);
                break;
            case 'alertOrError':
                $this->logAlert($message, $param);
                break;
            case 'criticalOrError':
                $this->logCritical($message, $param);
                break;
            case 'error':
                $this->logError($message, $param);
                break;
            case 'warningOrError':
                $this->logWarning($message, $param);
                break;
            case 'noticeOrError':
                $this->logNotice($message, $param);
                break;
            case 'infoOrError':
                $this->logInfo($message, $param);
                break;
            case 'debugOrError':
                $this->logDebug($message, $param);
                break;
            default:
                $this->logInfo($message, $param);
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logEmergency($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.emergency'))) {
                \Event::fire('event.emergency', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logAlert($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.alert'))) {
                \Event::fire('event.alert', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logCritical($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.critical'))) {
                \Event::fire('event.critical', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logError($message = 'Error', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logWarning($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.warning'))) {
                \Event::fire('event.warning', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logNotice($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.notice'))) {
                \Event::fire('event.notice', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logInfo($message = 'Success', array $param = [])
    {
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.info'))) {
                \Event::fire('event.info', [['message' => $message]]);
            }
        }
    }

    /**
     * @param string $message
     * @param array  $param
     */
    private function logDebug($message = 'Success', array $param = [])
    {
        $table     = (isset($param['table'])) ? $param['table'] : 'N/A';
        $condition = (isset($param['condition'])) ? $param['condition'] : 'N/A';
        $construct = (isset($param['construct'])) ? $param['construct'] : '';
        $message   = (isset($param['message'])) ? $param['message'] : $message;

        if (is_array($message)) {
            $this->logInfo('Values of string expected but array given.', $param);
            $message = implode(", ", $message);
        }
        if ((isset($param['status'])) && (!$param['status'])) {
            if ((config('logdb.logActivity')) && (config('logdb.error'))) {
                \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
            }
        } else {
            if ((config('logdb.logActivity')) && (config('logdb.debug'))) {
                if (isset($param['construct'])) {
                    $query      = $construct->toSql();
                    $queryCount = $construct->count();

                    \Event::fire('event.debug', [
                        ['message' => 'Success get data from ' . $table . ' table, count records "' . $queryCount . '", with query : "' . $query . '"']
                    ]);
                } else {
                    \Event::fire('event.debug', [['message' => $message]]);
                }
            }
        }
    }
}