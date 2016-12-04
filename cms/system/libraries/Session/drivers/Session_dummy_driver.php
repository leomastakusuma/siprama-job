<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Session_dummy_driver extends CI_Session_driver implements SessionHandlerInterface
{

        public function __construct(&$params)
        {
                // DO NOT forget this
                parent::__construct($params);

                // Configuration & other initializations
        }

        public function open($save_path, $name)
        {
		return TRUE;
                // Initialize storage mechanism (connection)
        }

        public function read($session_id)
        {
		return '';
                // Read session data (if exists), acquire locks
        }

        public function write($session_id, $session_data)
        {
                // Create / update session data (it might not exist!)
		return TRUE;
        }

        public function close()
        {
                // Free locks, close connections / streams / etc.
		return TRUE;
        }

        public function destroy($session_id)
        {
                // Call close() method & destroy data for current session (order may differ)
		return TRUE;
        }

        public function gc($maxlifetime)
        {
                // Erase data for expired sessions
		return TRUE;
        }

}
