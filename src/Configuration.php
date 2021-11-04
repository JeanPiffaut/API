<?php

namespace Library;

class Configuration extends Structure
{
    #region Basic Config
    /**
     * Defines the default time zone to be used in the project.
     * This will allow to have generalized time zones and defined by the configuration, without having to be
     * configuring it in each use of a datetime.
     * @param $timezone
     * @return bool
     */
    public function setDateTimeZone($timezone): bool
    {
        return date_default_timezone_set($timezone);
    }

    /**
     * Configures the project header to return the type of data it needs as API
     */
    public function setHeaders(): void
    {
        header('Content-Type: application/json');
    }
    #endregion Basic Config

    // Functions in charge of obtaining and storing the project configuration.
    #region Configuration Params
    /**
     * Returns the configuration defined in the general file.
     * @param $key
     * @param $sub_key
     * @return mixed
     */
    public static function getConfig($key, $sub_key): mixed
    {
        // Loads the global variable $CONFIG
        global $CONFIG;

        // Validates if the requested configuration exists in the global variable and returns it.
        if (isset($CONFIG[$key]) === true && isset($CONFIG[$key][$sub_key]) === true) {

            return $CONFIG[$key][$sub_key];
        } else {

            // If the variable is not found, it returns a FALSE.
            return false;
        }
    }

    /**
     * Loads the configuration file and stores it in a global variable.
     * @param $config_file
     * @return bool
     */
    public function setConfig($config_file): bool
    {
        // Loads the global variable $CONFIG
        global $CONFIG;

        // Validates if the route sent by parameter exists.
        if (file_exists($config_file)) {

            try {

                // Opens the configuration file and stores it in the cache.
                $json = file_get_contents($config_file);

                if (empty($CONFIG) === true) {

                    $CONFIG = array();
                }

                // Decodes the json as an array and stores it in the global variable
                $CONFIG += json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {

                // If an error occurs in the opening or transformation of the configuration file, the generated
                // error is stored.
                $this->setErrors($e->getMessage(), "001");
            }

            return true;
        } else {

            // If the sent configuration file does not exist, it stores the generated error.
            $this->setErrors("The configuration file does not exist.", "002");
            return false;
        }
    }
    #endregion Configuration Params
}
