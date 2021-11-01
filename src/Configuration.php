<?php

namespace Library;

class Configuration extends Structure
{
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

                // Decodes the json as an array and stores it in the global variable
                $CONFIG = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {

                // If an error occurs in the opening or transformation of the configuration file, the generated
                // error is stored.
                $this->setErrors($e->getMessage(), $e->getCode());
            }

            return true;
        } else {

            // If the sent configuration file does not exist, it stores the generated error.
            $this->setErrors("The configuration file does not exist.");
            return false;
        }

    }
}
